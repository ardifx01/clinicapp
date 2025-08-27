<?php

namespace app\controllers;

use app\models\DataRegistrasi;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DataRegistrasiController implements the CRUD actions for DataRegistrasi model.
 */
class DataRegistrasiController extends Controller
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
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all DataRegistrasi models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => DataRegistrasi::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DataRegistrasi model.
     * @param int $id_registrasi Id Registrasi
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_registrasi)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_registrasi),
        ]);
    }

    /**
     * Creates a new DataRegistrasi model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new DataRegistrasi();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id_registrasi' => $model->id_registrasi]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing DataRegistrasi model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_registrasi Id Registrasi
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_registrasi)
    {
        $model = $this->findModel($id_registrasi);
        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_registrasi' => $model->id_registrasi]);
        }
        return $this->render('update', ['model' => $model,]);
    }

    /**
     * Deletes an existing DataRegistrasi model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_registrasi Id Registrasi
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_registrasi)
    {
        $model = $this->findModel($id_registrasi);
        $model->is_delete = true;

        if ($model->save(false)) {
            $dataForms = $model->getDataForms()->andWhere(['is_delete' => false])->all();
            foreach ($dataForms as $dataForm) {
                $dataForm->is_delete = true;
                $dataForm->save(false);
            }
            Yii::$app->session->setFlash('success', 'Data registrasi berhasil dihapus secara logis.');
        } else {
            Yii::$app->session->setFlash('error', 'Gagal menghapus data registrasi.');
        }
        return $this->redirect(['index']);
    }


    /**
     * Finds the DataRegistrasi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_registrasi Id Registrasi
     * @return DataRegistrasi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_registrasi)
    {
        if (($model = DataRegistrasi::findOne(['id_registrasi' => $id_registrasi])) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('Halaman yang diminta tidak ditemukan.');
    }
}
