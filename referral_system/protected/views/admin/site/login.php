<?php
/*$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);*/
?>

<h1 class="text-info">Login</h1>

<p class="alert alert-info">Please fill out the following form with your login credentials:</p>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
        'errorCssClass' => 'text-danger has-error',
	),
	'htmlOptions' => array(
        'class' => 'form-horizontal'
	),
)); ?>

    <div class="well">
    <div class="form-panel">

    	<div class="form-group">
    		<?php echo $form->labelEx($model,'username',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
            <div class="col-md-9 col-sm-9">
        		<?php echo $form->textField($model,'username',array('class'=>'form-control')); ?>
        		<?php echo $form->error($model,'username'); ?>
            </div>
    	</div>
    
    	<div class="form-group">
    		<?php echo $form->labelEx($model,'password',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
            <div class="col-md-9 col-sm-9">
        		<?php echo $form->passwordField($model,'password',array('class'=>'form-control')); ?>
        		<?php echo $form->error($model,'password'); ?>
            </div>
    	</div>
    
    	<div class="form-group rememberMe">
            <div class="col-md-offset-3 col-sm-offset-3 col-sm-10">
        		<?php echo $form->checkBox($model,'rememberMe'); ?>
        		<?php echo $form->label($model,'rememberMe'); ?>
        		<?php echo $form->error($model,'rememberMe'); ?>
            </div>
    	</div>
    
    	<div class="form-group buttons">
            <div class="col-md-offset-3 col-sm-offset-3 col-sm-10">
                <?php echo CHtml::submitButton('Login',array('class'=>'btn btn-primary')); ?>
            </div>
    	</div>
    
    </div>
    </div>

<?php $this->endWidget(); ?>