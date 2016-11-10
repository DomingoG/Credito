<?php

namespace backend\controllers;

use Yii;
use backend\models\Creditos;
use backend\models\CreditosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadFile;
use yii\web\UploadedFile;
use yii\data\SqlDataProvider;
use yii\helpers\ArrayHelper;

/**
 * CreditosController implements the CRUD actions for Creditos model.
 */
class CreditosController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Creditos models.
     * @return mixed
     */
    public function actionIndex()
    {
        \Yii::$app->language = 'es';
        if(!Yii::$app->user->isGuest && Yii::$app->user->identity->role_id >= 30){
        $searchModel = new CreditosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        }else{
            return $this->redirect(['site/permiso']);
            //return $this->render('site/nopermitido');
       }
    }

    /**
     * Displays a single Creditos model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
         if(!Yii::$app->user->isGuest && Yii::$app->user->identity->role_id >= 30){
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
        }else{
            return $this->redirect(['site/permiso']);
            //return $this->render('site/nopermitido');
       }
    }

    /**
     * Creates a new Creditos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        \Yii::$app->language = 'es';
         if(!Yii::$app->user->isGuest && Yii::$app->user->identity->role_id >= 30){
        $imagen="";
        $model= new Creditos;
        if ($model->load(Yii::$app->request->post())) {
            $rnd = rand(0,9999);
              $imagen = UploadedFile::getInstance($model, 'imagen');

              if($imagen->extension == "jpg" || $imagen->extension == "png" ||
                        $imagen->extension == "jpeg" || $imagen->extencion == "gif")
                    {
                        $fileName = "{$rnd}-{$imagen}";
                        $model->imagen = $fileName;
                        $imagen->saveAs(Yii::$app->basePath.'\imagens\ '.$fileName);
                        $model->save();                                        
                    }
                    return $this->redirect(['view', 'id' => $model->idcredito]);
            
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }

        }else{
            return $this->redirect(['site/permiso']);
            //return $this->render('site/nopermitido');
       }
    }

    /**
     * Updates an existing Creditos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {

        \Yii::$app->language = 'es';
        if(!Yii::$app->user->isGuest && Yii::$app->user->identity->role_id >= 30){
         $model = $this->findModel($id);

         $model->operaciones = \yii\helpers\ArrayHelper::getColumn(
        $model->getCreditosHasSemestres()->asArray()->all(),
        'semestre_idsemestre'
    );
        
        if ($model->load(Yii::$app->request->post()) ) {
            if (!isset($_POST['Creditos']['operaciones'])) {
            $model->operaciones = [];
            }

            $rnd = rand(0,9999);           

            $imagen = UploadedFile::getInstance($model, 'imagen');
            
            if (!is_null($imagen)) {
              $fileName = "{$rnd}-{$imagen}";
              $model->imagen = $fileName;
              //$imagen->saveAs(Yii::$app->basePath.'\imagens\ ' .reset($imagen));
              
                    if ($model->save(false)) 
                    {
                        $imagen->saveAs(Yii::$app->basePath.'\imagens\ ' .$fileName);
                    }
                }else{
                     $image = Creditos::findOne(['idcredito' => $id]);
                     $model->imagen = $image["imagen"];
                }
                $model->save();
            return $this->redirect(['view', 'id' => $model->idcredito]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }

        }else{
            return $this->redirect(['site/permiso']);
            //return $this->render('site/nopermitido');
       }
    }

    /**
     * Deletes an existing Creditos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if(!Yii::$app->user->isGuest && Yii::$app->user->identity->role_id >= 30){
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
        }else{
            return $this->redirect(['site/permiso']);
            //return $this->render('site/nopermitido');
       }
    }

    /**
     * Finds the Creditos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Creditos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Creditos::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
