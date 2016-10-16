<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Alumno;

/**
 * AlumnoSearch represents the model behind the search form about `backend\models\Alumno`.
 */
class AlumnoSearch extends Alumno
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Matricula', 'ciudad', 'carrera', 'usuario'], 'integer'],
            [['nombre', 'apellidopaterno', 'apellidomaterno', 'semestre', 'telefono'], 'safe'],
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
    public function search($params)
    {
        $query = Alumno::find();

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
            'Matricula' => $this->Matricula,
            'ciudad' => $this->ciudad,
            'carrera' => $this->carrera,
            'usuario' => $this->usuario,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'apellidopaterno', $this->apellidopaterno])
            ->andFilterWhere(['like', 'apellidomaterno', $this->apellidomaterno])
            ->andFilterWhere(['like', 'semestre', $this->semestre])
            ->andFilterWhere(['like', 'telefono', $this->telefono]);

        return $dataProvider;
    }
}
