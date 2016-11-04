<?php

namespace backend\models;
use common\models\User;
use Yii;

/**
 * This is the model class for table "administrativo".
 *
 * @property integer $iddepartamento
 * @property string $departamento
 * @property string $encargado
 * @property string $telefono
 * @property integer $usuario
 *
 * @property User $usuario0
 * @property AlumnoCreditos[] $alumnoCreditos
 * @property Avisos[] $avisos
 * @property Creditos[] $creditos
 */
class Administrativo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'administrativo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['departamento', 'encargado', 'telefono', 'usuario'], 'required'],
            [['usuario'], 'integer'],
            [['departamento'], 'string', 'max' => 45],
            [['encargado'], 'string', 'max' => 50],
            [['telefono'], 'string', 'max' => 25],
            [['usuario'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['usuario' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'iddepartamento' => 'Id Departamento',
            'departamento' => 'Departamento',
            'encargado' => 'Encargado',
            'telefono' => 'Telefono',
            'usuario' => 'Usuario',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario0()
    {
        return $this->hasOne(User::className(), ['id' => 'usuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlumnoCreditos()
    {
        return $this->hasMany(AlumnoCreditos::className(), ['departamento' => 'iddepartamento']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAvisos()
    {
        return $this->hasMany(Avisos::className(), ['departamento' => 'iddepartamento']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreditos()
    {
        return $this->hasMany(Creditos::className(), ['responsable' => 'iddepartamento']);
    }
    public function attributes()
    {
        return array_merge(parent::attributes(), ['user.username']);
    }
     public function getUsername()
    {
        $model=$this->usuario0;
        return $model?$model->username:'';
    }
}
