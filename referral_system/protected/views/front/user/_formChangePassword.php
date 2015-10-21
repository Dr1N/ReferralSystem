<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'password-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array(
        'class' => 'form-horizontal'
	),
)); ?>

	<p class="alert alert-info">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	
    <div class="well well-sm col-md-8 col-sm-12 col-xs-12">
    
        <div class="form-group">
            <div class="col-md-offset-3 col-sm-offset-3 col-sm-9">
        		<h3>Credentials Information</h3>
            </div>
        </div>

    	<div class="form-group">
    		<?php echo $form->labelEx($model,'old_password',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
            <div class="col-md-9 col-sm-9">
        		<?php echo $form->passwordField($model,'old_password',array('size'=>32,'maxlength'=>32,'class'=>'form-control')); ?>
        		<?php echo $form->error($model,'old_password'); ?>
            </div>
    	</div>
    	
    	<div class="form-group">
    		<?php echo $form->labelEx($model,'password',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
            <div class="col-md-9 col-sm-9">
        		<?php echo $form->passwordField($model,'password',array('size'=>32,'maxlength'=>32,'class'=>'form-control')); ?>
        		<?php echo $form->error($model,'password'); ?>
            </div>
    	</div>
    
    	<div class="form-group">
    		<?php echo $form->labelEx($model,'confirm_password',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
            <div class="col-md-9 col-sm-9">
        		<?php echo $form->passwordField($model,'confirm_password',array('size'=>32,'maxlength'=>32,'class'=>'form-control')); ?>
        		<?php echo $form->error($model,'confirm_password'); ?>
            </div>
    	</div>
    		
    	<div class="form-group buttons">
            <div class="col-md-offset-2 col-sm-offset-2 col-sm-10">
        		<?php echo CHtml::submitButton('Save', array('class'=>'btn btn-success')); ?>
            </div>
    	</div>
     
     </div>
     
     <div class="clear"></div>

<?php $this->endWidget(); ?>