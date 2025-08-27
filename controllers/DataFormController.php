<?php

namespace app\controllers;

use app\models\DataForm;
use app\models\DataRegistrasi;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;
use yii\data\ActiveDataProvider;

class DataFormController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::class,
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Finds the DataForm model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_form_data Id Form Data
     * @return DataForm the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_form_data)
    {
        if (($model = DataForm::findOne(['id_form_data' => $id_form_data])) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('Halaman yang diminta tidak ditemukan.');
    }

    /**
     * Lists all DataForm models.
     * @return string
     */

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => DataForm::find(),
            'pagination' => [
                'pageSize' => 20,
            ],
            'sort' => [
                'defaultOrder' => [
                    'id_form_data' => SORT_DESC,
                ]
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DataForm model.
     * @param int $id_form_data Id Form Data
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDetail($id_form_data)
    {
        $model = $this->findModel($id_form_data);
        $registrasi = $model->registrasi;
        $formData = json_decode($model->data, true);

        return $this->render('detail', [
            'model' => $model,
            'registrasi' => $registrasi,
            'formData' => $formData,
        ]);
    }

    /**
     * Handles input/update of the Nursing Assessment Form (Lampiran 1).
     * @param int $id_registrasi The registration ID this form belongs to.
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the DataRegistrasi record is not found.
     */
    public function actionInput($id_registrasi)
    {
        $registrasi = DataRegistrasi::findOne($id_registrasi);
        if ($registrasi === null) {
            throw new NotFoundHttpException('Data Registrasi tidak ditemukan.');
        }
        $model = DataForm::findOne(['id_registrasi' => $id_registrasi]);
        if ($model === null) {
            $model = new DataForm();
            $model->id_registrasi = $id_registrasi;
            $model->id_form = 1;
            $model->is_delete = false;
        }
        if ($this->request->isPost) {
            $postData = Yii::$app->request->post('FormData');
            $model->data = json_encode($postData);
            $model->create_by = Yii::$app->user->id ?? 0;
            $model->update_by = Yii::$app->user->id ?? 0;

            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Data form berhasil disimpan.');
                return $this->redirect(['data-registrasi/index']);
            } else {
                Yii::$app->session->setFlash('error', 'Gagal menyimpan data form.');
                // echo "<pre>";
                // print_r($model->errors);
                // echo "</pre>";
            }
        }
        return $this->render('input', [
            'model' => $model,
            'registrasi' => $registrasi,
            'formData' => $model->data ? json_decode($model->data, true) : [],
        ]);
    }



    /**
     * Deletes an existing DataForm model by setting is_delete to true.
     * @param int $id_form_data The ID of the form data to be deleted.
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model is not found.
     */
    public function actionDelete($id_form_data)
    {
        $model = $this->findModel($id_form_data);
        $model->is_delete = true;
        $model->update_by = Yii::$app->user->id ?? 0;
        $model->update_time_at = date('Y-m-d H:i:s');

        if ($model->save(false)) {
            Yii::$app->session->setFlash('success', 'Data form berhasil dihapus.');
        } else {
            Yii::$app->session->setFlash('error', 'Gagal menghapus data form.');
        }
        return $this->redirect(['index']);
    }

    public function actionPrint($id_form_data)
    {
        $model = $this->findModel($id_form_data);
        $registrasi = $model->registrasi;
        $formData = json_decode($model->data, true);

        $this->layout = false;
        return $this->render('print', [
            'model' => $model,
            'registrasi' => $registrasi,
            'formData' => $formData
        ]);
    }
}
