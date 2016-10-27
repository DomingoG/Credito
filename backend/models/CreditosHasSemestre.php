<?php

namespace backend\models;
use backend\models\Semestre;
use backend\models\Creditos;

use Yii;

/**
 * This is the model class for table "creditos_has_semestre".
 *
 * @property integer $creditos_idcredito
 * @property integer $semestre_idsemestre
 *
 * @property Creditos $creditosIdcredito
 * @property Semestre $semestreIdsemestre
 */
class CreditosHasSemestre extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $operaciones;
    public static function tableName()
    {
        return 'creditos_has_semestre';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['creditos_idcredito', 'semestre_idsemestre'], 'required'],
            [['creditos_idcredito', 'semestre_idsemestre'], 'integer'],
            [['creditos_idcredito'], 'exist', 'skipOnError' => true, 'targetClass' => Creditos::className(), 'targetAttribute' => ['creditos_idcredito' => 'idcredito']],
            [['semestre_idsemestre'], 'exist', 'skipOnError' => true, 'targetClass' => Semestre::className(), 'targetAttribute' => ['semestre_idsemestre' => 'idsemestre']],
            [['operaciones'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'creditos_idcredito' => 'Creditos Idcredito',
            'semestre_idsemestre' => 'Semestre Idsemestre',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreditosIdcredito()
    {
        return $this->hasOne(Creditos::className(), ['idcredito' => 'creditos_idcredito']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSemestreIdsemestre()
    {
        return $this->hasOne(Semestre::className(), ['idsemestre' => 'semestre_idsemestre']);
    }
}
