<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "carrera".
 *
 * @property integer $idcarrera
 * @property string $carrera
 *
 * @property Alumno[] $alumnos
 */
class Carrera extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'carrera';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['carrera'], 'required'],
            [['carrera'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idcarrera' => 'Idcarrera',
            'carrera' => 'Carrera',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlumnos()
    {
        return $this->hasMany(Alumno::className(), ['carrera' => 'idcarrera']);
    }
}
