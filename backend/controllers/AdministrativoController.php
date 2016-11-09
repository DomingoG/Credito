<?php

namespace backend\controllers;

use Yii;
use common\models\user;
use common\models\RecordHelpers;
use backend\models\Administrativo;
use backend\models\AdministrativoSearch;
use backend\models\AlumcreditosSearch;
use backend\models\Alumcreditos;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AdministrativoController implements the CRUD actions for Administrativo model.
 */
class AdministrativoController extends Controller
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
     * Lists all Administrativo models.
     * @return mixed
     */


   /*  public function actionListaaprobados(){

        $searchModel = new AlumcreditosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }*/

    public function actionIndex()
    {
         if(!Yii::$app->user->isGuest && Yii::$app->user->identity->role_id >= 30){
        $searchModel = new AdministrativoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        }else{
            return $this->redirect(['site/permiso']);
            
       }
    }

    /**
     * Displays a single Administrativo model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
         if(!Yii::$app->user->isGuest && Yii::$app->user->identity->role_id >= 20){
            if(!Yii::$app->user->isGuest && Yii::$app->user->identity->role_id <= 20){
                return $this->render('viewadmin', [
            'model' => $this->findModel($id),
            ]);
            }else{
                return $this->render('view', [
            'model' => $this->findModel($id),       
            ]); 
            }
        
        
         }else{
            return $this->redirect(['site/permiso']); 
       }
    }

    /**
     * Creates a new Administrativo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(!Yii::$app->user->isGuest && Yii::$app->user->identity->role_id >= 30){
        $model = new Administrativo();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->iddepartamento]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
        }else{
            return $this->redirect(['site/permiso']); 
       }
    }

    /**
     * Updates an existing Administrativo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
         if(!Yii::$app->user->isGuest && Yii::$app->user->identity->role_id >= 20){
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->iddepartamento]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
        }else{
            return $this->redirect(['site/permiso']); 
       }
    }

    /**
     * Updates an existing Administrativo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdateadministrativo($id)
    {
         if(!Yii::$app->user->isGuest && Yii::$app->user->identity->role_id >= 20){
            $model = $this->findModel($id);
            $user=User::find()->where(['id'=>$model->usuario])->one();

        if ($model->load(Yii::$app->request->post()) && $user->load(Yii::$app->request->post())) {
            $user->save();
            $model->save();
            return $this->redirect(['perfile', 'id' => $model->iddepartamento]);
        } else {
            return $this->render('updateadministrativo', [
                'model' => $model,
                'modeluser'=>$user,
            ]);
        }
        }else{
            return $this->redirect(['site/permiso']); 
       }
    }

    /**
     * Deletes an existing Administrativo model.
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
       }
    }

    /**
     * Finds the Administrativo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Administrativo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */

    protected function findModel($id)
    {
        if (($model = Administrativo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

     public function actionPerfile(){
        if(!Yii::$app->user->isGuest && Yii::$app->user->identity->role_id >= 20){
        if ($already_exists = RecordHelpers::userHas('administrativo')) {
                return $this->render('viewadmin', [
                'model' => $this->findModel($already_exists),
                ]);
            } else {
            return $this->redirect(['create']);
            }
        }else{
            return $this->redirect(['site/permiso']); 
       }       
    }

}
