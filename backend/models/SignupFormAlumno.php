<?php
namespace backend\models;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupFormAlumno extends Model
{
    public $username;
    public $email;
    public $password;
    


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

/*            ['role_id', 'required'],
            [['role_id'], 'integer'],

            ['status_id', 'required'],
            [['status_id'], 'integer'],*/

        ];
    }

     public function attributeLabels()
    {
        return [
        /* Your other attribute labels */

            'username'=>'Nombre de Usuario',
            'created_at'=>'Fecha de Creacion',
            'updated_at'=>'Fecha de Modificado',
            'status_id' => 'Estado',
            'role_id'=> 'Tipo de Rol',
          
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
        $user->setPassword($this->password);
        $user->generateAuthKey();
        
        return $user->save() ? $user : null;
    }
}
