<?php

namespace backend\controllers;

use Yii;
use common\models\User;
use common\models\RecordHelpers;
use backend\models\Alumno;
use backend\models\AlumnoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;

/**
 * AlumnoController implements the CRUD actions for Alumno model.
 */
class AlumnoController extends Controller
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
     * Lists all Alumno models.
     * @return mixed
     */
    /*public function actionIndex()
    {
        $searchModel = new AlumnoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }*/

    /**
     * Displays a single Alumno model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('perfil', [
            'model' => $this->findModel($id),
        ]);
    }
    
    /* public function actionViewconsulta($id)
    {
       $query=Alumno::find()->where(['Matricula'=>$id])->one();
      // $query->leftJoin([
        //'carrera'
        //], 'alumno.carrera=carrera.idcarrera');

//       $model = new ActiveDataProvider([
  //          'query' => $query,
    //    ]);

       return $this->render('viewconsulta', ['model'=>$query]);
       
    }*/

    /**
     * Creates a new Alumno model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
      /*  $model = new Alumno();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->Matricula]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }*/
        \Yii::$app->language = 'es';
        if(!Yii::$app->user->isGuest && Yii::$app->user->identity->role_id <= 10){
         $model = new Alumno();
         //$user= new User;
        if ($model->load(Yii::$app->request->post()) ) {
            $model->usuario=Yii::$app->user->identity->id;
            $model->save();
            return $this->redirect(['perfil', 'id' => $model->Matricula]);
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
     * Updates an existing Alumno model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        \Yii::$app->language = 'es';
        if(!Yii::$app->user->isGuest && Yii::$app->user->identity->role_id <= 10){
        $model = $this->findModel($id);
        $id=Yii::$app->user->identity->id;
        $modeluser=User::find()->where(['id'=>$id])->one();

        if ($model->load(Yii::$app->request->post()) && $modeluser->load(Yii::$app->request->post())) {
            $modeluser->save();
            $model->save();
            return $this->redirect(['perfil']);//, 'id' => $model->Matricula]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'modeluser'=>$modeluser,
            ]);
        }
        }else{
            return $this->redirect(['site/permiso']);
            //return $this->render('site/nopermitido');
            } 
    }

    /**
     * Deletes an existing Alumno model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if(!Yii::$app->user->isGuest && Yii::$app->user->identity->role_id <= 10){
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
        }else{
            return $this->redirect(['site/permiso']);
            //return $this->render('site/nopermitido');
            } 
    }

    /**
     * Finds the Alumno model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Alumno the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Alumno::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

       public function actionPerfil()
    {
       if(!Yii::$app->user->isGuest && Yii::$app->user->identity->role_id <= 10){

       //$id=Yii::$app->user->identity->id;
       ///$modelalu=Alumno::find()->where(['usuario'=>$id])->one();

        ///return $this->render('perfil',['model'=>$modelalu]);//mostrar infromacion de BD

        if ($already_exists = RecordHelpers::alumnoHas('alumno')) {
                return $this->render('perfil', [
                'model' => $this->findModel($already_exists),
                ]);
            } else {
            return $this->redirect(['alumno/create']);
            }

         }else{
            return $this->redirect(['site/permiso']);
            //return $this->render('site/nopermitido');
            } 

    }
}
