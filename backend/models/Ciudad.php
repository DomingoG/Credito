<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "ciudad".
 *
 * @property integer $idciudad
 * @property string $ciudad
 *
 * @property Alumno[] $alumnos
 */
class Ciudad extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ciudad';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ciudad'], 'required'],
            [['ciudad'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idciudad' => 'Idciudad',
            'ciudad' => 'Ciudad',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlumnos()
    {
        return $this->hasMany(Alumno::className(), ['ciudad' => 'idciudad']);
    }
}
