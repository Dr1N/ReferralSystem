<div id="tab-register">
    <div class="zag">
        <span class="regicon"></span>
        <h1  class="uppercase">Registration</h1>
        <p>Please fill out the following form with your e-mail:</p>
    </div>
    
    <?php $form=$this->beginWidget('CActiveForm', array(
    	'id'=>'register-form',
        'action'=>Yii::app()->createUrl('user/register'),
        'htmlOptions'=>array('class'=>'form-horizontal'),
    )); ?>
    
        <div id="save-register-status">
            <div id="status-fail" class="alert alert-danger hidden">Please fix the input errors.</div>
            <div id="status-success" class="alert alert-success hidden">The registration password code was sent to you e-mail. Please enter the password to confirm the registration.</div>
        </div>
        
    	<div id="mail-row" class="form-group">
    		<?php echo $form->labelEx($model,'mail',array('class'=>'label-control')); ?>
    		<?php echo $form->textField($model,'mail',array('class'=>'input-control')); ?>
            <div id="mail-error-row" class="text-danger hidden"></div>
    	</div>
        
    	<div id="password-row" class="form-group hidden">
    		<?php echo $form->labelEx($model,'password',array('class'=>'label-control')); ?>
    		<?php echo $form->passwordField($model,'password',array('class'=>'input-control')); ?>
            <div id="password-error-row" class="text-danger hidden"></div>
    	</div>
        
    	<div class="form-group btn-control">
        	<?php echo CHtml::button('Register',array('id'=>'register','class'=>'btn')); ?>
    		<?php echo CHtml::button('Confirm',array('id'=>'confirm','class'=>'btn hidden')); ?>
    	</div>
        
    <?php $this->endWidget(); ?>
</div>