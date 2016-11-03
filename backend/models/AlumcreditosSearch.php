<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Alumcreditos;

/**
 * AlumcreditosSearch represents the model behind the search form about `backend\models\Alumcreditos`.
 */
class AlumcreditosSearch extends Alumcreditos
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idreporte', 'credito', 'departamento', 'alumno'], 'integer'],
            [['fecha','fechaaprobacion', 'aprobado'], 'safe'],
            [['alumno.nombre'], 'safe'],
            [['alumno.apellidopaterno'], 'safe'],
            [['creditos.actividad'], 'safe'],
          //  [['alumno.carrera'], 'safe'],
            //[['carrera.carrera'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params,$num,$apro)
    {
        if($apro =='No'){
            $query = Alumcreditos::find()->where([
            'aprobado'=>'No',
            'departamento'=>$num,
            ]);    
        }else{
            $query = Alumcreditos::find()->where([
            'aprobado'=>'Si',
            'departamento'=>$num,
            ]);
        }
        $query->leftJoin(['alumno'
        ], 'alumno.Matricula = alumno_creditos.alumno');
        $query->leftJoin([
        'creditos'
        ], 'creditos.idcredito=alumno_creditos.credito');
       /* $query->leftJoin([
        'carrera'
        ], 'carrera.idcarrera=alumno.carrera');*/

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'idreporte' => $this->idreporte,
            'credito' => $this->credito,
            'departamento' => $this->departamento,
            'alumno' => $this->alumno,
            //'alumno.Matricula' => $this->alumno,
            'fecha' => $this->fecha,

        ]);

        $query->andFilterWhere(['like', 'aprobado', $this->aprobado]);
        $query->andFilterWhere(['like', 'alumno.nombre', $this->getAttribute('alumno.nombre')]);
        $query->andFilterWhere(['like', 'alumno.apellidopaterno', $this->getAttribute('alumno.apellidopaterno')]);
        $query->andFilterWhere(['like', 'creditos.actividad', $this->getAttribute('creditos.actividad')]);
       // $query->andFilterWhere(['like', 'carrera.carrera', $this->getAttribute('carrera.carrera')]);

        return $dataProvider;
    }

    public function searcht($params,$carrera)
    {
        
        $query = Alumcreditos::find()->where([
            'aprobado'=>'Si',
            'alumno.carrera'=>$carrera

             ]);
        $query->leftJoin(['alumno'
        ], 'alumno.Matricula = alumno_creditos.alumno');
        $query->leftJoin([
        'creditos'
        ], 'creditos.idcredito=alumno_creditos.credito');
       /* $query->leftJoin([
        'carrera'
        ], 'carrera.idcarrera=alumno.carrera');*/

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'idreporte' => $this->idreporte,
            'credito' => $this->credito,
            'departamento' => $this->departamento,
            'alumno' => $this->alumno,
            //'alumno.Matricula' => $this->alumno,
            'fecha' => $this->fecha,
            //'fechaaprobacion' => $this->fecha,

        ]);

        $query->andFilterWhere(['like', 'aprobado', $this->aprobado]);
        $query->andFilterWhere(['like', 'alumno.nombre', $this->getAttribute('alumno.nombre')]);
        $query->andFilterWhere(['like', 'alumno.apellidopaterno', $this->getAttribute('alumno.apellidopaterno')]);
        $query->andFilterWhere(['like', 'creditos.actividad', $this->getAttribute('creditos.actividad')]);
       // $query->andFilterWhere(['like', 'carrera.carrera', $this->getAttribute('carrera.carrera')]);

        return $dataProvider;
    }

    public function searchalumno($params,$matricula)
    {
        
        $query = Alumcreditos::find()->where([
            'aprobado'=>'Si',
            'alumno'=>$matricula

             ]);
        //$query->leftJoin(['alumno'
        //], 'alumno.Matricula = alumno_creditos.alumno');
        //$query->leftJoin([
        //'creditos'
        ///], 'creditos.idcredito=alumno_creditos.credito');
       /* $query->leftJoin([
        'carrera'
        ], 'carrera.idcarrera=alumno.carrera');*/

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'idreporte' => $this->idreporte,
            'credito' => $this->credito,
            'departamento' => $this->departamento,
            'alumno' => $this->alumno,
            //'alumno.Matricula' => $this->alumno,
            'fecha' => $this->fecha,
            //'fechaaprobacion' => $this->fecha,

        ]);

        $query->andFilterWhere(['like', 'aprobado', $this->aprobado]);
    /*    $query->andFilterWhere(['like', 'alumno.nombre', $this->getAttribute('alumno.nombre')]);
        $query->andFilterWhere(['like', 'alumno.apellidopaterno', $this->getAttribute('alumno.apellidopaterno')]);
        $query->andFilterWhere(['like', 'creditos.actividad', $this->getAttribute('creditos.actividad')]);*/
       // $query->andFilterWhere(['like', 'carrera.carrera', $this->getAttribute('carrera.carrera')]);

        return $dataProvider;
    }


}
