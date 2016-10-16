<?php

namespace backend\controllers;

use Yii;
use backend\models\Avisos;
use backend\models\Creditos;
use backend\models\AvisosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\SqlDataProvider; 
use backend\models\Administrativo;

/**
 * AvisosController implements the CRUD actions for Avisos model.
 */
class AvisosController extends Controller
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
     * Lists all Avisos models.
     * @return mixed
     */
    public function actionIndex()
    {
       /* $searchModel = new AvisosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);*/
         $id=Yii::$app->user->identity->id;
       $al = Administrativo::find()->where(['usuario' => $id])->one();   
       $matricula=$al->iddepartamento;
         $provider = new SQLDataProvider([
        
        'sql' => "SELECT avisos.idavisos,avisos.informacion,avisos.fechapublicacion,avisos.fechaevento,creditos.actividad 
        from avisos 
        INNER JOIN creditos on creditos.idcredito=avisos.credito          
        WHERE avisos.departamento=$matricula ",
            
            'pagination' => [
            'pageSize' => 10,
            ],
        'sort' => [
            'attributes' => [
            'title',
            //'view_count',
            'created_at',
            ],
        ],
    ]);
        return $this->render('index',['provider'=>$provider]);

    }

    /**
     * Displays a single Avisos model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Avisos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Avisos();
        $id=Yii::$app->user->identity->id;
             $al = Administrativo::find()->where(['usuario' => $id])->one();   
             $matricula=$al->iddepartamento;
            $modelcarrera=Creditos::find()->where(['responsable'=>$matricula])->all();
        if ($model->load(Yii::$app->request->post()) ) {
            $model->departamento=$matricula;
            $model->fechapublicacion=date('Y-m-d');
            $model->save();
            return $this->redirect(['view', 'id' => $model->idavisos]);
        } else {
      /*$id=Yii::$app->user->identity->id;
       $al = Administrativo::find()->where(['usuario' => $id])->one();   
       $matricula=$al->iddepartamento;*/

            return $this->render('create', [
                'model' => $model, 
                'modelcarrera'=>$modelcarrera,
            ]);
        }
    }

    /**
     * Updates an existing Avisos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $id=Yii::$app->user->identity->id;
             $al = Administrativo::find()->where(['usuario' => $id])->one();   
             $matricula=$al->iddepartamento;
        $modelcarrera=Creditos::find()->where(['responsable'=>$matricula])->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idavisos]);
        } else {
            return $this->render('update', [
                'model' => $model,'modelcarrera'=>$modelcarrera,
            ]);
        }
    }

    /**
     * Deletes an existing Avisos model.
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
     * Finds the Avisos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Avisos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Avisos::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
