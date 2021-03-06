<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\models;
use Yii;
/** 
 * Description of RecordHelpers
 *
 * @author SoftwareDevelopment
 */
class RecordHelpers {

    
public static function userHas($model_name){
    $connection = \Yii::$app->db;
    $userid = Yii::$app->user->identity->id;
    $sql = "SELECT iddepartamento FROM $model_name WHERE usuario=:userid";
    $command = $connection->createCommand($sql);
    $command->bindValue(":userid", $userid);
    $result = $command->queryOne();
    if ($result == null) 
        {
            return false;
        } else 
            {
                return $result['iddepartamento'];
            }
}

public static function alumnoHas($model_name){
    $connection = \Yii::$app->db;
    $userid = Yii::$app->user->identity->id;
    $sql = "SELECT Matricula FROM $model_name WHERE usuario=:userid";
    $command = $connection->createCommand($sql);
    $command->bindValue(":userid", $userid);
    $result = $command->queryOne();
    if ($result == null) 
        {
            return false;
        } else 
            {
                return $result['Matricula'];
            }
}


}
