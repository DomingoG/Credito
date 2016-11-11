<?php
namespace backend\controllers;

use Yii;
use common\models\User;
use common\models\RecordHelpers;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use backend\models\Creditos;
use yii\helpers\Html;
use backend\models\Alumcreditos;
use backend\models\AlumcreditosSearch;
use backend\models\Administrativo;
use backend\models\Alumno;
use backend\models\SignupFormAlumno;
use kartik\mpdf\Pdf;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error','create'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout', 'index','creditolista','vermas','registro','permiso','reportealumno','report','perfil'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
 
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionPermiso()
    {
        \Yii::$app->language = 'es';
        return $this->render('permiso');
    }

     public function actionCreditolista(){
        \Yii::$app->language = 'es';
        if(!Yii::$app->user->isGuest && Yii::$app->user->identity->role_id <= 10){

       $table = new Creditos;
       $modelsi = $table->find()->where(['obligatorio'=>'Si'])->all();

       $table1= new Creditos;
       $modelno = $table1->find()->where(['obligatorio'=>'No'])->all();

        return $this->render('creditolista',['listasi'=>$modelsi,'listano'=>$modelno]);
        }else{
            return $this->redirect(['site/permiso']);
            //return $this->render('site/nopermitido');
       }
    }

    public function actionVermas(){
        \Yii::$app->language = 'es';
        
        if(!Yii::$app->user->isGuest && Yii::$app->user->identity->role_id <= 10){
            if ($already_exists = RecordHelpers::alumnoHas('alumno')) {
        if (Yii::$app->request->get("idcredito"))
            {
                $idcredito = Html::encode($_GET["idcredito"]);
               if ((int) $idcredito)
                {
                    $credito = Creditos::find()->where(['idcredito'=> $idcredito])->one();
                    //
                    $iduser=Yii::$app->user->identity->id;
                    $al = Alumno::find()->where(['usuario' => $iduser])->one();   
                    $respon = Creditos::find(['responsable'])->where(['idcredito'=> $idcredito])->one();
                    $modelrespo=Administrativo::find()->where(['iddepartamento'=>$respon])->one();           
                    $num=Alumcreditos::find()->where([
                        'credito'=>$credito->idcredito,
                        'alumno'=> $al->Matricula,
                        ])->count();

                    $apro=Alumcreditos::find()->where([
                        'credito'=>$credito->idcredito,
                        'alumno'=>$al->Matricula,
                        'aprobado'=>'Si',
                        ])->count();

                    $inscritosnow=Alumcreditos::find()->where([
                        'credito'=>$credito->idcredito,
                        ])->count();
                    $limit=$credito->limite;
                    //si mostrar es 1:se puede ver encaso contrario: no se vera btom
                    if($limit == 0){
                        $mostrar=2;//
                        
                    }else{
                        if($inscritosnow < $limit ){
                            $mostrar=2;//

                        }else{
                            $mostrar=1;
                            $num=1;
                        }
                    }
                }
                else
                {
                    return $this->redirect(["creditolista"]);
                }
            }
            else
            {
                return $this->redirect(["creditolista"]);
            }
            return $this->render("vermas", ["model" => $credito,'contar'=>$num,'sino'=>$apro,'limit'=>$mostrar,'modeldepa'=>$modelrespo]);
             
            } else {
            return $this->redirect(['alumno/create']);
            }
             }else{
            return $this->redirect(['site/permiso']);
            //return $this->render('site/nopermitido');
            }

        
    }
    public function actionRegistro($id){
         
         if(!Yii::$app->user->isGuest && Yii::$app->user->identity->role_id <= 10){
                        $table= new Alumcreditos;
                        $credito = Creditos::findOne($id);
                        $idalumno=Yii::$app->user->identity->id;
                        $alumno = Alumno::find()->where(['usuario' => $idalumno])->one();
                        //$alumno = Alumno::findOne($idalumno);
                        
                        $table->credito = $credito->idcredito;
                        $table->departamento = $credito->responsable;
                        $table->alumno =$alumno->Matricula;
                        $table->aprobado = "NO";
                        $table->fecha=date('Y-m-d');
                        $table->fechaaprobacion=date('Y-m-d');
                        

                        $table->save();

        return $this->redirect(["creditolista"]);  
        }else{
            return $this->redirect(['site/permiso']);
            //return $this->render('site/nopermitido');
            }       

    }


    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        \Yii::$app->language = 'es';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            //$iduser=Yii::$app->user->identity->id;
            if(!Yii::$app->user->isGuest && Yii::$app->user->identity->role_id >= 30){
                return $this->redirect(["user/homeuser"]);
            }elseif(!Yii::$app->user->isGuest && Yii::$app->user->identity->role_id >=20 ){
                return $this->redirect(["administrativo/homeadmin"]);
            }elseif(!Yii::$app->user->isGuest && Yii::$app->user->identity->role_id <=10 ){
                return $this->redirect(["site/index"]);
            }
             //$admin=User::find()->where(['usuario'=>$iduser])->count();
             //$alumno=Alumno::find()->where(['usuario'=>$iduser])->count();



            //return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        \Yii::$app->language = 'es';
        Yii::$app->user->logout();

        return $this->goHome();
    }

    protected $modelalumno;
    protected $matriculaalumno;

    public function actionReport(){
        \Yii::$app->language = 'es';
        if(!Yii::$app->user->isGuest && Yii::$app->user->identity->role_id <= 10){

            if ($already_exists = RecordHelpers::alumnoHas('alumno')) {
                
                 $aprobadosi="Si";
        $aprobadono="No";
        $searchModel = new AlumcreditosSearch();
        $idalumno=Yii::$app->user->identity->id;
        $alumno= Alumno::find()->where(['usuario' => $idalumno])->one();
        $Matricula= Alumno::find('Matricula')->where(['usuario' => $idalumno])->one();
        
        $modelsi = $searchModel->searchalumno(Yii::$app->request->queryParams,$Matricula,$aprobadosi);
        $modelno = $searchModel->searchalumno(Yii::$app->request->queryParams,$Matricula,$aprobadono);

        $session = Yii::$app->session;
                // check if a session is already open
                if (!$session->isActive){
                    $session->open();// open a session
                } 
                // save query here
                $session['modelalumno'] = Yii::$app->request->queryParams;
                $session['matriculaalumno'] = $Matricula;



         $this->modelalumno = Yii::$app->request->queryParams; 
         $this->matriculaalumno = $Matricula;


        return $this->render('report',[
            'modelsi'=>$modelsi,
            'modelno'=>$modelno,
            'alumno'=>$alumno
            ]);
       

            } else {
            return $this->redirect(['alumno/create']);
            }

         }else{
            return $this->redirect(['site/permiso']);
            //return $this->render('site/nopermitido');
            }    
    }

       public function actionReportealumno() {
        \Yii::$app->language = 'es';

            if(!Yii::$app->user->isGuest && Yii::$app->user->identity->role_id <= 10){
            
             $aprobadosi="Si";
             $aprobadono="No";

            $searchModel = new AlumcreditosSearch();
            $idalumno=Yii::$app->user->identity->id;
            $alumno= Alumno::find()->where(['usuario' => $idalumno])->one();

            $modelsi= $searchModel->searchalumno(Yii::$app->request->queryParams,Yii::$app->session->get('matriculaalumno'),$aprobadosi);
            $modelno = $searchModel->searchalumno(Yii::$app->request->queryParams,Yii::$app->session->get('matriculaalumno'),$aprobadono);

            $content = $this->renderPartial('reportealumno', [
            'alumno'=>$alumno,
            'modelsi' => $modelsi,
            'modelno' => $modelno,
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
            //return $this->render('site/nopermitido');
            }    
    }

     public function actionCreate()
    {
          \Yii::$app->language = 'es';
         
          $model = new SignupFormAlumno();
        
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                return $this->redirect(['site/login']);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
       
    }


}
