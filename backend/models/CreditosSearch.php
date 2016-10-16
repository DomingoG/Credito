<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Creditos;

/**
 * CreditosSearch represents the model behind the search form about `backend\models\Creditos`.
 */
class CreditosSearch extends Creditos
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idcredito', 'credito', 'responsable', 'limite'], 'integer'],
            [['actividad', 'periodo', 'comentario', 'obligatorio', 'imagen'], 'safe'],
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
        $query = Creditos::find();

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
            'idcredito' => $this->idcredito,
            'credito' => $this->credito,
            'responsable' => $this->responsable,
            'limite' => $this->limite,
        ]);

        $query->andFilterWhere(['like', 'actividad', $this->actividad])
            ->andFilterWhere(['like', 'periodo', $this->periodo])
            ->andFilterWhere(['like', 'comentario', $this->comentario])
            ->andFilterWhere(['like', 'obligatorio', $this->obligatorio])
            ->andFilterWhere(['like', 'imagen', $this->imagen]);

        return $dataProvider;
    }
}
