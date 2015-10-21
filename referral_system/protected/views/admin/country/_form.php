<?php
/* @var $this CountryController */
/* @var $model Country */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'country-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array(
        'class' => 'form-horizontal'
	),
)); ?>

	<p class="alert alert-info">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

    <div class="well">
    <div class="form-panel">

    	<div class="form-group">
    		<?php echo $form->labelEx($model,'name',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
    		<div class="col-md-9 col-sm-9">
        		<?php echo $form->textField($model,'name',array('size'=>45,'maxlength'=>45,'class'=>'form-control')); ?>
        		<?php echo $form->error($model,'name'); ?>
            </div>
    	</div>
    
    	<div class="form-group">
    		<?php echo $form->labelEx($model,'phone_code',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
    		<div class="col-md-9 col-sm-9">
                <div class="input-group">
                    <span class="input-group-addon">+</span>
            		<?php echo $form->textField($model,'phone_code',array('size'=>5,'maxlength'=>5,'class'=>'form-control')); ?>
                </div>
        		<?php echo $form->error($model,'phone_code'); ?>
            </div>
    	</div>
    
    	<div class="form-group buttons">
            <div class="col-md-offset-3 col-sm-offset-3 col-sm-10">
        		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-primary')); ?>
            </div>
    	</div>

    </div>
    </div>

<?php $this->endWidget(); ?>

</div>