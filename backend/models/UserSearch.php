<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\User;

/**
 * UserSearch represents the model behind the search form about `common\models\User`.
 */
class UserSearch extends User
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'role_id', 'user_type_id', 'status_id'], 'integer'],
            [['username', 'auth_key', 'password_hash', 'password_reset_token', 'email', 'created_at', 'updated_at'], 'safe'],
            [['role.role_name'], 'safe'],
            [['status.status_name'], 'safe'],
            [['user_type.user_type_name'], 'safe'],
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
        $query = User::find()->where(['role_id'=>[10,20]]);
        $query->leftJoin(['role'
        ], 'role.role_value = user.role_id');

        $query->leftJoin(['status'
        ], 'status.status_value = user.status_id');
        
        $query->leftJoin(['user_type'
        ], 'user_type.user_type_value = user.user_type_id');

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
            'id' => $this->id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'role_id' => $this->role_id,
            'user_type_id' => $this->user_type_id,
            'status_id' => $this->status_id,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', 'email', $this->email]);
       $query->andFilterWhere(['like', 'role.role_name', $this->getAttribute('role.role_name')]);
       $query->andFilterWhere(['like', 'status.status_name', $this->getAttribute('status.status_name')]);
       $query->andFilterWhere(['like', 'user_type.user_type_name', $this->getAttribute('user_type.user_type_name')]);

        return $dataProvider;
    }
}
