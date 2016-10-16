<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "avisos".
 *
 * @property integer $idavisos
 * @property string $informacion
 * @property integer $departamento
 * @property string $fechapublicacion
 * @property integer $fechaevento
 * @property integer $credito
 *
 * @property Administrativo $departamento0
 * @property Creditos $credito0
 */
class Avisos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'avisos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['informacion', 'departamento', 'fechapublicacion', 'fechaevento', 'credito'], 'required'],
            [['informacion'], 'string'],
            [['departamento','credito'], 'integer'],
            [['fechapublicacion','fechaevento'], 'safe'],
            [['departamento'], 'exist', 'skipOnError' => true, 'targetClass' => Administrativo::className(), 'targetAttribute' => ['departamento' => 'iddepartamento']],
            [['credito'], 'exist', 'skipOnError' => true, 'targetClass' => Creditos::className(), 'targetAttribute' => ['credito' => 'idcredito']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idavisos' => 'Idavisos',
            'informacion' => 'Informacion',
            'departamento' => 'Departamento',
            'fechapublicacion' => 'Fecha Publicacion',
            'fechaevento' => 'Fecha Evento',
            'credito' => 'Credito',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartamento0()
    {
        return $this->hasOne(Administrativo::className(), ['iddepartamento' => 'departamento']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCredito0()
    {
        return $this->hasOne(Creditos::className(), ['idcredito' => 'credito']);
    }
}
