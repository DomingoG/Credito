<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "alumno_creditos".
 *
 * @property integer $idreporte
 * @property integer $credito
 * @property integer $departamento
 * @property integer $alumno
 * @property string $fecha
 * @property string $aprobado
 *
 * @property Creditos $credito0
 * @property Administrativo $departamento0
 * @property Alumno $alumno0
 */
class Alumcreditos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'alumno_creditos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['credito', 'departamento', 'alumno', 'fecha','fechaaprobacion', 'aprobado'], 'required'],
            [['credito', 'departamento', 'alumno'], 'integer'],
            [['fecha','fechaaprobacion'], 'safe'],
            [['aprobado'], 'string'],
            [['credito'], 'exist', 'skipOnError' => true, 'targetClass' => Creditos::className(), 'targetAttribute' => ['credito' => 'idcredito']],
            [['departamento'], 'exist', 'skipOnError' => true, 'targetClass' => Administrativo::className(), 'targetAttribute' => ['departamento' => 'iddepartamento']],
            [['alumno'], 'exist', 'skipOnError' => true, 'targetClass' => Alumno::className(), 'targetAttribute' => ['alumno' => 'Matricula']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idreporte' => 'Idreporte',
            'credito' => 'Credito',
            'departamento' => 'Departamento',
            'alumno' => 'Alumno',
            'fecha' => 'Fecha',
            'fechaaprobacion'=>'Fecha Aprobacion',
            'aprobado' => 'Aprobado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCredito0()
    {
        return $this->hasOne(Creditos::className(), ['idcredito' => 'credito']);
    }
    /*public function attributes()
    {
        return array_merge(parent::attributes(), []);
    }*/

    public function getActividad()
    {
        $model=$this->credito0;
        return $model?$model->actividad:'';
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
    public function getAlumno0()
    {
        return $this->hasOne(Alumno::className(), ['Matricula' => 'alumno']);
    }
     public function attributes()
    {
        return array_merge(parent::attributes(), ['alumno.nombre','alumno.apellidopaterno','creditos.actividad','administrativo.departamento','administrativo.encargado']);
    }

     public function getNombre()
    {
        $model=$this->alumno0;
        return $model?$model->nombre:'';
    }
     public function getApellido()
    {
        $model=$this->alumno0;
        return $model?$model->apellidopaterno:'';
    }
     public function getDepartamento()
    {
        $model=$this->departamento0;
        return $model?$model->departamento:'';
    }
    public function getEncargado()
    {
        $model=$this->departamento0;
        return $model?$model->encargado:'';
    }

   /*   public function getCarre0()
    {
        $model=$this->alumno0;
        return $this->hasOne(Carrera::className(), ['idcarrera' => $model->carrera]);
    }*/
  /*  public function getCar()
    {
       $model=$this->alumno0;
       return $model?$model->carrera:'';
    }*/


}
