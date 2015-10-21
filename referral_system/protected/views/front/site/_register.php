<h1>Registration</h1>

<p>Please fill out the following form with your e-mail:</p>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'register-form',
    'action'=>Yii::app()->createUrl('user/register'),
)); ?>

    <div id="save-register-status">
        <div id="status-fail" class="alert alert-danger hidden">Please fix the input errors.</div>
        <div id="status-success" class="alert alert-success hidden">The registration password code was sent to you e-mail. Please enter the password to confirm the registration.</div>
    </div>
    
	<div class="form-group" id="mail-row">
		<?php echo $form->labelEx($model,'mail',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'mail',array('class'=>'form-control')); ?>
        <div id="mail-error-row" class="text-danger hidden"></div>
	</div>
    
	<div class="form-group hidden" id="password-row">
		<?php echo $form->labelEx($model,'password',array('class'=>'control-label')); ?>
		<?php echo $form->passwordField($model,'password',array('class'=>'form-control')); ?>
        <div id="password-error-row" class="text-danger hidden"></div>
	</div>
    
	<div class="form-group buttons">
		<?php echo CHtml::button('Register',array('id'=>'register', 'class'=>'btn btn-success')); ?>
		<?php echo CHtml::button('Confirm',array('id'=>'confirm','class'=>'btn btn-success hidden')); ?>
	</div>

<?php $this->endWidget(); ?>
</div>