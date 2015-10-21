<div id="tab-password">
    <?php $this->renderPartial('../layouts/_left_menu'); ?>
    <div class="right-conte">
        <div class="zaglogin">
            <span class="prof-rew-icon"></span>
            <h1 class="uppercase">Change Password</h1>
            <p>Edit your password</p>
        </div>

        <?php $form=$this->beginWidget('CActiveForm', array(
        	'id'=>'password-form',
        	'enableAjaxValidation'=>false,
            'htmlOptions'=>array('class'=>'form-horizontal'),
        )); ?>
        
            <div id="save-password-status">
                <div id="status-fail" class="alert alert-danger hidden">Please fix the input errors.</div>
                <div id="status-success" class="alert alert-success hidden">Your new password is saved.</div>
            </div>
    
            <?php echo $form->errorSummary($model); ?>
        
        	<div id="old_password-row" class="form-group">
        		<?php echo $form->labelEx($model,'old_password',array('class'=>'label-control')); ?>
        		<?php echo $form->passwordField($model,'old_password',array('maxlength'=>32,'class'=>'input-control')); ?>
        		<?php echo $form->error($model,'old_password'); ?>
                <div id="old_password-error-row" class="text-danger hidden"></div>
        	</div>
        	
        	<div id="password-row" class="form-group">
        		<?php echo $form->labelEx($model,'password',array('class'=>'label-control')); ?>
        		<?php echo $form->passwordField($model,'password',array('maxlength'=>32,'class'=>'input-control')); ?>
        		<?php echo $form->error($model,'password'); ?>
                <div id="password-error-row" class="text-danger hidden"></div>
        	</div>
        
        	<div id="confirm_password-row" class="form-group">
        		<?php echo $form->labelEx($model,'confirm_password',array('class'=>'label-control')); ?>
        		<?php echo $form->passwordField($model,'confirm_password',array('maxlength'=>32,'class'=>'input-control')); ?>
        		<?php echo $form->error($model,'confirm_password'); ?>
                <div id="confirm_password-error-row" class="text-danger hidden"></div>
        	</div>
        		
        	<div class="form-group btn-control">
        		<?php echo CHtml::ajaxSubmitButton('Save', 'track/user/changePassword', 
        			array(
                        'type' => 'POST',
                        'dataType' => 'JSON',
                        'success' => 'function (response) { ProfileHelper.savePassword(response); }',
                    ),
                    array(
        	            'id' => 'save-password-button',
        	            'name' => 'save-password-button',
                        'class' => 'btn',
                	)
        		);?>
                <span class="tabs-navigation">
                    <a class="italic space-small" href="#tab-profile"><small>Change Profile</small></a>
                </span>
        	</div>
        <?php $this->endWidget(); ?>
    </div>
</div>