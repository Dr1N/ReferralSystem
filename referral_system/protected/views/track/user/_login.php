<div class="login" id="tab-login">
    <div class="zag">
        <span class="logicon"></span>
        <h1 class="uppercase">Login</h1>
        <p>Please fill out the following form with your login credentials:</p>
    </div>
        
    <?php $form=$this->beginWidget('CActiveForm', array(
    	'id'=>'login-form',
        'enableAjaxValidation'=>true,
    	'enableClientValidation'=>true,
    	'clientOptions'=>array(
            'validateOnSubmit'=>true,
            'errorCssClass'=>'has-error',
        ),
        'htmlOptions'=>array('class'=>'form-horizontal'),
    )); ?>

    	<div class="form-group">
    		<?php echo $form->labelEx($model,'username',array('class'=>'label-control')); ?>
    		<?php echo $form->textField($model,'username',array('class'=>'input-control')); ?>
    		<?php echo $form->error($model,'username',array('class'=>'text-danger')); ?>
    	</div>
    
    	<div class="form-group">
    		<?php echo $form->labelEx($model,'password',array('class'=>'label-control')); ?>
    		<?php echo $form->passwordField($model,'password',array('class'=>'input-control')); ?>
    		<?php echo $form->error($model,'password',array('class'=>'text-danger')); ?>
    	</div>
    
    	<div class="form-group btn-control rememberMe">
    		<?php echo $form->checkBox($model,'rememberMe'); ?>
    		<?php echo $form->label($model,'rememberMe'); ?>
    		<?php echo $form->error($model,'rememberMe',array('class'=>'text-danger')); ?>
    	</div>
    
    	<div class="form-group btn-control">
    		<?php echo CHtml::submitButton('Login',array('class'=>'btn')); ?>
            <span class="tabs-navigation">
                <a class="italic space-small" href="#tab-restore"><small>Forgot password?</small></a>
            </span>
    	</div>
        
    <?php $this->endWidget(); ?>
</div>