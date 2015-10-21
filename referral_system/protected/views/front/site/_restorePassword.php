<h1>Restore Password</h1>

<p>Please fill out the following form with your e-mail:</p>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'restore-form',
    'action'=>Yii::app()->createUrl('user/restorePassword'),
)); ?>

    <div id="save-restore-status">
        <div id="status-fail" class="alert alert-danger hidden">Please fix the input errors.</div>
        <div id="status-success" class="alert alert-success hidden">A new password is generated and sent to your e-mail.</div>
    </div>
    
	<div class="form-group" id="mail-row">
		<?php echo $form->labelEx($model,'mail',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'mail',array('class'=>'form-control')); ?>
        <div id="mail-error-row" class="text-danger hidden"></div>
	</div>
    
	<div class="form-group buttons">
		<?php echo CHtml::button('Restore',array('id'=>'restore', 'class'=>'btn btn-success')); ?>
		<a href="#" id="login"  class="login-link">Login</a>
	</div>

<?php $this->endWidget(); ?>
</div>