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
use kartik\mpdf\Pdf;

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
        if(!Yii::$app->user->isGuest && Yii::$app->user->identity->role_id >= 30){
           $carrera=1;
           $searchModel = new AlumcreditosSearch();
           
           $dataProvider = $searchModel->searcht(Yii::$app->request->queryParams,$carrera);

        return $this->render('isc', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
         }else{
            return $this->redirect(['site/permiso']);
            
       }
    }
    public function actionCivil(){
        if(!Yii::$app->user->isGuest && Yii::$app->user->identity->role_id >= 30){
           $carrera=2;
           $searchModel = new AlumcreditosSearch();
           
           $dataProvider = $searchModel->searcht(Yii::$app->request->queryParams,$carrera);

        return $this->render('civil', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
         }else{
            return $this->redirect(['site/permiso']);
            
       }
    }
    public function actionAdmon(){
        if(!Yii::$app->user->isGuest && Yii::$app->user->identity->role_id >= 30){
           $carrera=3;
           $searchModel = new AlumcreditosSearch();
           
           $dataProvider = $searchModel->searcht(Yii::$app->request->queryParams,$carrera);

           return $this->render('admon', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
            }else{
            return $this->redirect(['site/permiso']);
            
       }
    }
     
    public function actionAmbiental(){
        if(!Yii::$app->user->isGuest && Yii::$app->user->identity->role_id >= 30){
           $carrera=4;
           $searchModel = new AlumcreditosSearch();
           
           $dataProvider = $searchModel->searcht(Yii::$app->request->queryParams,$carrera);

        return $this->render('ambiental', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
         }else{
            return $this->redirect(['site/permiso']);
            
       }
    }
    public function actionIndustrial(){
        if(!Yii::$app->user->isGuest && Yii::$app->user->identity->role_id >= 30){
           $carrera=5;
           $searchModel = new AlumcreditosSearch();
           
           $dataProvider = $searchModel->searcht(Yii::$app->request->queryParams,$carrera);

        return $this->render('industrial', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
         }else{
            return $this->redirect(['site/permiso']);
            
       }
    }


     public function actionListaaprobados(){
            $apro='si';
            $id=Yii::$app->user->identity->id;
           /* $al = Administrativo::find()->where(['usuario' => $id])->one();   
            $num=$al->iddepartamento;*/

           $searchModel = new AlumcreditosSearch();
           
           $dataProvider = $searchModel->searcht(Yii::$app->request->queryParams,$apro);

        return $this->render('listaaprobados', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

     public function actionInscritosalumno(){
        if(!Yii::$app->user->isGuest && Yii::$app->user->identity->role_id >= 20 && Yii::$app->user->identity->role_id <= 29){
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
        }else{
         return $this->redirect(['site/permiso']);
        }
    }

    public function actionActivaralumno(){
        if(!Yii::$app->user->isGuest && Yii::$app->user->identity->role_id >= 20 && Yii::$app->user->identity->role_id <= 29){
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
         }else{
         return $this->redirect(['site/permiso']);
        }
    }
    protected $repqueryaprobados;
    protected $repquerydepa;

    public function actionAprobados(){
        if(!Yii::$app->user->isGuest && Yii::$app->user->identity->role_id >= 20 && Yii::$app->user->identity->role_id <= 29){
        $apro='Si';
            $id=Yii::$app->user->identity->id;
            $al = Administrativo::find()->where(['usuario' => $id])->one();   
            $num=$al->iddepartamento;

           $searchModel = new AlumcreditosSearch();
           
           $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$num,$apro);

           $session = Yii::$app->session;
                // check if a session is already open
                if (!$session->isActive){
                    $session->open();// open a session
                } 
                // save query here
                $session['repqueryaprobados'] = Yii::$app->request->queryParams;
                $session['repquerydepa'] = $num;



         $this->repqueryaprobados = Yii::$app->request->queryParams; 
         $this->repquerydepa = $num; 

        return $this->render('aprobados', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

         }else{
            return $this->redirect(['site/permiso']);
            
       }

    }

    public function actionReport() {
        if(!Yii::$app->user->isGuest && Yii::$app->user->identity->role_id >= 20 && Yii::$app->user->identity->role_id <= 29){
            $apro='Si';
            // get your HTML raw content without any layouts or scripts
            $searchModel = new AlumcreditosSearch();
    
             $dataProvider = $searchModel->search(Yii::$app->session->get('repqueryaprobados'),Yii::$app->session->get('repquerydepa'),$apro);
            $content = $this->renderPartial('reports', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            ]);
            
            // setup kartik\mpdf\Pdf component
            $pdf = new Pdf([
                // set to use core fonts only
                'mode' => Pdf::MODE_CORE, 
                // A4 paper format
                'format' => Pdf::FORMAT_A4, 
                // portrait orientation
                'orientation' => Pdf::ORIENT_PORTRAIT, 
                // stream to browser inline
                'destination' => Pdf::DEST_BROWSER, 
                // your html content input
                'content' => $content,  
                // format content from your own css file if needed or use the
                // enhanced bootstrap css built by Krajee for mPDF formatting 
                'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
                // any css to be embedded if required
                'cssInline' => '.kv-heading-1{font-size:18px}', 
                 // set mPDF properties on the fly
                'options' => ['title' => 'Reporte'],
                 // call mPDF methods on the fly
                'methods' => [ 
                    'SetHeader'=>['Sistema de Gestion de Creditos Complementarios'], 
                    'SetFooter'=>['{PAGENO}'],
                ]
            ]);
            
            // return the pdf output as per the destination setting
            return $pdf->render(); 
            }else{
            return $this->redirect(['site/permiso']);
           }

    }

    public function actionBajaalumno(){
        if(!Yii::$app->user->isGuest && Yii::$app->user->identity->role_id >= 20 && Yii::$app->user->identity->role_id <= 29){
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
            }else{
            return $this->redirect(['site/permiso']);
           }
    }
    public function actionElimi($id){
        if(!Yii::$app->user->isGuest && Yii::$app->user->identity->role_id >= 20 && Yii::$app->user->identity->role_id <= 29){
       
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
                }else{
            return $this->redirect(['site/permiso']);
           }
          
    }

    public function actionEditar($id){
        if(!Yii::$app->user->isGuest && Yii::$app->user->identity->role_id >= 20 && Yii::$app->user->identity->role_id <= 29){
       
             if (Yii::$app->request->get("id"))
            {
                $id = Html::encode($_GET["id"]);
               if ((int) $id)
                {
                    $al = Alumcreditos::find()->where(['idreporte' => $id])->one();   
                    $al->aprobado='Si';
                    $al->fechaaprobacion=date('Y-m-d');
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
            }else{
            return $this->redirect(['site/permiso']);
           }

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
