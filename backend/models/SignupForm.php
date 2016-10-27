<?php
namespace backend\models;
use yii\base\Model;
use backend\models\Role;
use backend\models\Status;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $status_id;
    public $role_id;
    public $user_type_id;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            
           // ['user_type_id', 'required'],
            //[['user_type_id'], 'integer'],

            ['role_id', 'required'],
            [['role_id'], 'integer'],

            ['status_id', 'required'],
            [['status_id'], 'integer'],

        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        //$modelRol=Role::find()->where(['id'=>$this->role_id])->one();
       // $modelStatus=Status::find()->where(['id'=>$this->status_id])->one();
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->role_id=$this->role_id;
        $user->status_id=$this->status_id;
        //$user->user_type_id=$this->user_type_id;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        
        return $user->save() ? $user : null;
    }
}
