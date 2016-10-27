<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use backend\models\Creditos;
use yii\helpers\Html;
use backend\models\Alumcreditos;
use backend\models\Alumno;

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
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index','creditolista','vermas','registro','permiso'],
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
        return $this->render('permiso');
    }

     public function actionCreditolista(){

       $table = new Creditos;
       $modelsi = $table->find()->where(['obligatorio'=>'Si'])->all();

       $table1= new Creditos;
       $modelno = $table1->find()->where(['obligatorio'=>'No'])->all();

        return $this->render('creditolista',['listasi'=>$modelsi,'listano'=>$modelno]);
    }

    public function actionVermas(){

        if (Yii::$app->request->get("idcredito"))
            {
                $idcredito = Html::encode($_GET["idcredito"]);
               if ((int) $idcredito)
                {
                    $credito = Creditos::find()->where(['idcredito'=> $idcredito])->one();
                    //
                    $iduser=Yii::$app->user->identity->id;
                    $al = Alumno::find()->where(['usuario' => $iduser])->one();   
                    
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
            return $this->render("vermas", ["model" => $credito,'contar'=>$num,'sino'=>$apro,'limit'=>$mostrar]);

        
    }
    public function actionRegistro($id){
         
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

    }


    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
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
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
