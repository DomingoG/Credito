<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "semestre".
 *
 * @property integer $idsemestre
 * @property string $semestre
 *
 * @property Alumno[] $alumnos
 * @property CreditosHasSemestre[] $creditosHasSemestres
 * @property Creditos[] $creditosIdcreditos
 */
class Semestre extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'semestre';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['semestre'], 'required'],
            [['semestre'], 'string', 'max' => 45],
            //[['operaciones'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idsemestre' => 'Idsemestre',
            'semestre' => 'Semestre',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlumnos()
    {
        return $this->hasMany(Alumno::className(), ['semestre' => 'idsemestre']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreditosHasSemestres()
    {
        return $this->hasMany(CreditosHasSemestre::className(), ['semestre_idsemestre' => 'idsemestre']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreditosIdcreditos()
    {
        return $this->hasMany(Creditos::className(), ['idcredito' => 'creditos_idcredito'])->viaTable('creditos_has_semestre', ['semestre_idsemestre' => 'idsemestre']);
    }
}
