<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\web\IdentityInterface;
use yii\helpers\Security;
use yii\helpers\ArrayHelper;
use backend\models\Role;
use backend\models\Status;
use backend\models\UserType;
//use frontend\models\Profile;
use yii\helpers\Url;
use yii\helpers\Html;
/**
* User model
*
* @property integer $id
* @property string $username
* @property string $password_hash
* @property string $password_reset_token
* @property string $email
* @property string $auth_key
* @property integer $role_id
* @property integer $status_id
* @proprty integer $user_type_id
* @property integer $created_at
* @property integer $updated_at
* @property string $password write-only password
*/

class User extends ActiveRecord implements IdentityInterface {    
    
    const STATUS_ACTIVE = 10;
    
    public static function tableName()
    {
        return 'user';
    }

    /**
    * behaviors
    */
    public function behaviors(){
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                                ],
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
    * validation rules
    */
    public function rules()
    {
    return [
            ['status_id', 'default', 'value' => self::STATUS_ACTIVE],
            //[['status_id'],'in', 'range'=>array_keys($this->getStatusList())],
            ['role_id','default','value'=> 10],
           // [['role_id'],'in', 'range'=>array_keys($this->getRoleList())],
            ['user_type_id', 'default', 'value' => 10],
            //[['user_type_id'],'in', 'range'=>array_keys($this->getUserTypeList())],
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique'],        
           ];
    }
    /* Your model attribute labels */
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
    * @findIdentity
    */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status_id' => self::STATUS_ACTIVE]);
    }

    /**
    * @findIdentityByAccessToken
    */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['auth_key' => $token]);
    }

    /**
    * Finds user by username
    * broken into 2 lines to avoid wordwrapping * @param string $username
    * @return static|null
    */
    public static function findByUsername($username)
    {
         return static::findOne(['username' => $username, 'status_id' => self::STATUS_ACTIVE]);
    }

    /**
    * Finds user by password reset token
    *
    * @param string $token password reset token
    * @return static|null
    */
    public static function findByPasswordResetToken($token)
    {
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        if ($timestamp + $expire < time()) {
            // token expired
            return null;
         }
         
        return static::findOne(['password_reset_token' => $token, 'status_id' => self::STATUS_ACTIVE,]);
    }

    /*
    * @getId
    */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
    * @getAuthKey
    */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
    * @validateAuthKey
    */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
    * Validates password
    *
    * @param string $password password to validate
    * @return boolean if password provided is valid for current user
    */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
    * Generates password hash from password and sets it to the model
    *
    * @param string $password
    */

    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
    * Generates "remember me" authentication key
    */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
    * Generates new password reset token
    * broken into 2 lines to avoid wordwrapping
    */

    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }



    /**
    * Removes password reset token
    */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

     //public function getRole0() 
    //{
      //  return $this->hasMany(Role::className(),['role_value' => 'role_id']);
                
    //}

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRole0()
    {
        return $this->hasone(Role::className(), ['role_value' => 'role_id']);
    }

     public function getType0()
    {
        return $this->hasone(UserType::className(), ['user_type_value' => 'user_type_id']);
    }

    public function getTypename(){
         $model=$this->type0;
        return $model?$model->user_type_name:'';
    }

    public function getRolename(){
         $model=$this->role0;
        return $model?$model->role_name:'';
    }

    public function attributes()
    {
        return array_merge(parent::attributes(), ['role.role_name','status.status_name','user_type.user_type_name']);
    }




    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus0()
    {
        return $this->hasOne(Status::className(), ['status_value' => 'status_id']);
    }

    /** get role name
     * 
     */

     public function getStatusname(){
         $model=$this->status0;
        return $model?$model->status_name:'';
    }

}