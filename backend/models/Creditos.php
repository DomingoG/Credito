<?php

namespace backend\models;
use backend\models\Semestre;
use backend\models\CreditosHasSemestre;

use Yii;

/**
 * This is the model class for table "creditos".
 *
 * @property integer $idcredito
 * @property string $actividad
 * @property integer $credito
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
    public $operaciones;
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
            [['idcredito', 'actividad', 'credito', 'comentario', 'responsable', 'obligatorio', 'limite','operaciones'], 'required'],
            [['idcredito', 'credito', 'responsable', 'limite'], 'integer'],
            [['comentario', 'obligatorio'], 'string'],
            [['operaciones'], 'safe'],
            [['actividad'], 'string', 'max' => 45],
            [['imagen'], 'safe'],
            [['imagen'],'image', 'extensions' => 'png, jpg, gif,jpeg',//'types'=>'jpg, jpeg, png, gif',
                'minWidth' => 250, 'maxWidth' => 250,
                'minHeight' => 250, 'maxHeight' => 250],
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
            'comentario' => 'Comentario',
            'responsable' => 'Responsable',
            'obligatorio' => 'Obligatorio',
            'limite' => 'Limite',
            'operaciones'=>'Semestre Permitidos',
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


    public function afterSave($insert, $changedAttributes){
    \Yii::$app->db->createCommand()->delete('creditos_has_semestre', 'creditos_idcredito = '.(int) $this->idcredito)->execute();
 
    foreach ($this->operaciones as $id) {
        $ro = new CreditosHasSemestre();
        $ro->creditos_idcredito = $this->idcredito;
        $ro->semestre_idsemestre = $id;
        $ro->save();
    }
    }

    public function getList()
    {
        return $this->getSemestreIdsemestres()->asArray();
    }
}
