<h1>Login</h1>

<p>Please fill out the following form with your login credentials:</p>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
    'enableAjaxValidation'=>true,
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
        'errorCssClass' => 'text-danger has-error',
	),
)); ?>

	<div class="form-group">
		<?php echo $form->labelEx($model,'username',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'username',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'password',array('class'=>'control-label')); ?>
		<?php echo $form->passwordField($model,'password',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="form-group rememberMe">
		<?php echo $form->checkBox($model,'rememberMe'); ?>
		<?php echo $form->label($model,'rememberMe'); ?>
		<?php echo $form->error($model,'rememberMe'); ?>
	</div>
	
	<div class="form-group buttons">
		<?php echo CHtml::submitButton('Login', array('class'=>'btn btn-success')); ?>
		<a href="#" id="restore-password" class="login-link">Forgot password?</a>
	</div>

<?php $this->endWidget(); ?>
</div>