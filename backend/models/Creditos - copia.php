<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "creditos".
 *
 * @property integer $idcredito
 * @property string $actividad
 * @property integer $credito
 * @property string $periodo
 * @property string $comentario
 * @property integer $responsable
 * @property string $obligatorio
 * @property integer $limite
 * @property string $imagen
 *
 * @property AlumnoCreditos[] $alumnoCreditos
 * @property Avisos[] $avisos
 * @property Administrativo $responsable0
 * @property CreditosHasSemestre[] $creditosHasSemestres
 * @property Semestre[] $semestreIdsemestres
 */
class Creditos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'creditos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idcredito', 'actividad', 'credito', 'periodo', 'comentario', 'responsable', 'obligatorio', 'limite', 'imagen'], 'required'],
            [['idcredito', 'credito', 'responsable', 'limite'], 'integer'],
            [['comentario', 'obligatorio'], 'string'],
            [['actividad', 'imagen'], 'string', 'max' => 45],
            [['periodo'], 'string', 'max' => 10],
            [['responsable'], 'exist', 'skipOnError' => true, 'targetClass' => Administrativo::className(), 'targetAttribute' => ['responsable' => 'iddepartamento']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idcredito' => 'Idcredito',
            'actividad' => 'Actividad',
            'credito' => 'Credito',
            'periodo' => 'Periodo',
            'comentario' => 'Comentario',
            'responsable' => 'Responsable',
            'obligatorio' => 'Obligatorio',
            'limite' => 'Limite',
            'imagen' => 'Imagen',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlumnoCreditos()
    {
        return $this->hasMany(AlumnoCreditos::className(), ['credito' => 'idcredito']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAvisos()
    {
        return $this->hasMany(Avisos::className(), ['credito' => 'idcredito']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResponsable0()
    {
        return $this->hasOne(Administrativo::className(), ['iddepartamento' => 'responsable']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreditosHasSemestres()
    {
        return $this->hasMany(CreditosHasSemestre::className(), ['creditos_idcredito' => 'idcredito']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSemestreIdsemestres()
    {
        return $this->hasMany(Semestre::className(), ['idsemestre' => 'semestre_idsemestre'])->viaTable('creditos_has_semestre', ['creditos_idcredito' => 'idcredito']);
    }
}
