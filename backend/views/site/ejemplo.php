<div class="row">
                <?php echo $form->labelEx($model,'provincia_fk'); ?>
                <?php echo $form->dropDownList($model,'provincia_fk',CHtml::listData(Provincia::model()->findAll(),'id','prov_desc'),
                                                                     array(
                                                                          'ajax'=>array(
                                                                             'type'=>'POST',
                                                                             'url'=>CController::createUrl('Entidadhc/SelectMun'),
                                                                             'update'=>'#'.CHtml::activeId($model,'municipio_fk'),
                                                                     ),'prompt'=>'Seleccione una provincia'
                                                                         )); ?>
                <?php echo $form->error($model,'provincia_fk'); ?>
        </div>

        <div class="row">
                <?php echo $form->labelEx($model,'municipio_fk'); ?>
                <?php 
                $lista_municipio = array();
                if(isset($model->municipio_fk)){
                $id_provincia = intval($model->provincia_fk);
                $lista_municipio = CHtml::listData(Municipio::model()->findAll("provincia_fk = '$id_provincia'"),'id','mun_desc');
                }
                
                echo $form->dropDownList($model,'municipio_fk',$lista_municipio,array('prompt'=>'Seleccione un municipio')); ?>
                <?php echo $form->error($model,'municipio_fk'); ?>
        </div>