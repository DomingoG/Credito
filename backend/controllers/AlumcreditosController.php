<?php

namespace backend\controllers;

use Yii;
use yii\helpers\Html;
use backend\models\Alumcreditos;
use backend\models\Administrativo;
use backend\models\AlumcreditosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AlumcreditosController implements the CRUD actions for Alumcreditos model.
 */
class AlumcreditosController extends Controller
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
     * Lists all Alumcreditos models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AlumcreditosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Alumcreditos model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    public function actionIsc(){
           $carrera=1;
           $searchModel = new AlumcreditosSearch();
           
           $dataProvider = $searchModel->searcht(Yii::$app->request->queryParams,$carrera);

        return $this->render('isc', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionCivil(){
           $carrera=2;
           $searchModel = new AlumcreditosSearch();
           
           $dataProvider = $searchModel->searcht(Yii::$app->request->queryParams,$carrera);

        return $this->render('civil', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionAdmon(){
           $carrera=3;
           $searchModel = new AlumcreditosSearch();
           
           $dataProvider = $searchModel->searcht(Yii::$app->request->queryParams,$carrera);

        return $this->render('admon', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
     
    public function actionAmbiental(){
           $carrera=4;
           $searchModel = new AlumcreditosSearch();
           
           $dataProvider = $searchModel->searcht(Yii::$app->request->queryParams,$carrera);

        return $this->render('ambiental', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionIndustrial(){
           $carrera=5;
           $searchModel = new AlumcreditosSearch();
           
           $dataProvider = $searchModel->searcht(Yii::$app->request->queryParams,$carrera);

        return $this->render('industrial', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


     public function actionListaaprobados(){
            $apro='si';
            /*$id=Yii::$app->user->identity->id;
            $al = Administrativo::find()->where(['usuario' => $id])->one();   
            $num=$al->iddepartamento;*/

           $searchModel = new AlumcreditosSearch();
           
           $dataProvider = $searchModel->searcht(Yii::$app->request->queryParams,$apro);

        return $this->render('listaaprobados', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

     public function actionInscritosalumno(){
            $apro='No';
            $id=Yii::$app->user->identity->id;
            $al = Administrativo::find()->where(['usuario' => $id])->one();   
            $num=$al->iddepartamento;

           $searchModel = new AlumcreditosSearch();
           
           $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$num,$apro);

        return $this->render('inscritosalumno', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionActivaralumno(){
            $apro='No';
            $id=Yii::$app->user->identity->id;
            $al = Administrativo::find()->where(['usuario' => $id])->one();   
            $num=$al->iddepartamento;

           $searchModel = new AlumcreditosSearch();
           
           $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$num,$apro);

        return $this->render('activaralumno', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionBajaalumno(){
            $apro='No';
            $id=Yii::$app->user->identity->id;
            $al = Administrativo::find()->where(['usuario' => $id])->one();   
            $num=$al->iddepartamento;

           $searchModel = new AlumcreditosSearch();
           
           $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$num,$apro);

        return $this->render('bajaalumno', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionElimi($id){
       
            if (Yii::$app->request->get("id"))
            {
                $id = Html::encode($_GET["id"]);
               if ((int) $id)
                {
                   if(Alumcreditos::deleteAll("idreporte=:id_reporte", [":id_reporte" => $id]));
                   return $this->redirect(["bajaalumno"]);
               }else{

                    return $this->redirect(["bajaalumno"]);
                
                    }            
            }else
            {
                return $this->redirect(["bajaalumno"]);
            }
    }

    public function actionEditar($id){
       
             if (Yii::$app->request->get("id"))
            {
                $id = Html::encode($_GET["id"]);
               if ((int) $id)
                {
                    $al = Alumcreditos::find()->where(['idreporte' => $id])->one();   
                    $al->aprobado='Si';
                    $al->save();
                   // return $this->redirect(["reportealumnos"]);   
                }
                else
                {
                   // return $this->redirect(["reportealumnos"]);
                }
            }
            else
            {
             //   return $this->redirect(["reportealumnos"]);
            }
            return $this->redirect("activaralumno");

     }

    /**
     * Creates a new Alumcreditos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Alumcreditos();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idreporte]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Alumcreditos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idreporte]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Alumcreditos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Alumcreditos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Alumcreditos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Alumcreditos::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
