<div id="tab-profile">
    <?php $this->renderPartial('../layouts/_left_menu'); ?>
    <div class="right-conte">
        <div class="zaglogin">
            <span class="prof-rew-icon"></span>
            <h1 class="uppercase">My Profile</h1>
            <p>View or edit your profile</p>
        </div>

        <?php $form=$this->beginWidget('CActiveForm', array(
        	'action'=>'track/user/update',
        	'id'=>'user-form',
        	'enableAjaxValidation'=>false,
            'htmlOptions'=>array('class'=>'form-horizontal'),
        )); ?>
        
            <div id="save-profile-status">
                <div id="status-fail" class="alert alert-danger hidden">Please fix the input errors.</div>
                <div id="status-success" class="alert alert-success hidden">Your profile data is saved.</div>
            </div>
    
            <?php echo $form->errorSummary($model); ?>

        	<div id="mail-row" class="form-group">
        		<?php echo $form->labelEx($model,'mail',array('class'=>'label-small')); ?>
        		<?php echo $form->textField($model,'mail',array('maxlength'=>100,'disabled'=>true,'class'=>'big-control')); ?>
        		<?php echo $form->error($model,'mail'); ?>
                <div id="mail-error-row" class="text-danger hidden"></div>
        	</div>
            
            <div class="form-group">
                <div id="first_name-row" class="left">
            		<?php echo $form->labelEx($model,'first_name',array('class'=>'label-small')); ?>
            		<?php echo $form->textField($model,'first_name',array('maxlength'=>100,'class'=>'profile-control')); ?>
            		<?php echo $form->error($model,'first_name',array('class'=>'label-small')); ?>
                    <div id="first_name-error-row" class="text-danger hidden"></div>        
            	</div>
            
            	<div id="last_name-row" class="left">
            		<?php echo $form->labelEx($model,'last_name',array('class'=>'label-small')); ?>
            		<?php echo $form->textField($model,'last_name',array('maxlength'=>100,'class'=>'profile-control')); ?>
            		<?php echo $form->error($model,'last_name'); ?>
                    <div id="last_name-error-row" class="text-danger hidden"></div>        
            	</div>
            </div>
            
            <div class="form-group">
                <div id="country_id-row" class="left">
            		<?php echo $form->labelEx($model,'country_id',array('class'=>'label-small')); ?>
            		<?php echo $form->dropDownList($model,'country_id',Country::getCountries(true),array('class'=>'profile-control')); ?> 
            		<?php echo $form->error($model,'country_id'); ?>
                    <div id="country_id-error-row" class="text-danger hidden"></div>        
            	</div>
            
            	<div id="city-row" class="left">
            		<?php echo $form->labelEx($model,'city',array('class'=>'label-small')); ?>
            		<?php echo $form->textField($model,'city',array('maxlength'=>100,'class'=>'profile-control')); ?> 
            		<?php echo $form->error($model,'city'); ?>
                    <div id="city-error-row" class="text-danger hidden"></div>
            	</div>
            </div>
            
        	<div id="address-row" class="form-group">
        		<?php echo $form->labelEx($model,'address',array('class'=>'label-small')); ?>
        		<?php echo $form->textField($model,'address',array('maxlength'=>100,'class'=>'big-control')); ?>
        		<?php echo $form->error($model,'address'); ?>
                <div id="address-error-row" class="text-danger hidden"></div>        
        	</div>
            
            <div class="form-group">
            	<div id="birthday-row" class="left">
            		<?php echo $form->labelEx($model,'birthday',array('class'=>'label-small')); ?>
            		<?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
    				    'name'=>'datepicker-month-year-menu',
    				    'flat'=>false,
                        'value'=>strtotime($model->birthday) ? DateHandler::dateView($model->birthday) : '',
                        'options'=>array(
    					    'dateFormat' => 'mm/dd/yy',
                            'showAnim'=>'fadeIn',
    				        'changeMonth'=>true,
    				        'changeYear'=>true,
    				        'yearRange'=>'1950:2013',
    				    ),
    				    'htmlOptions'=>array(
    				    	'name'=>'User[birthday]',
                            'class'=>'profile-control',
    				    ),
            		));
            		?>
            		<?php echo $form->error($model,'birthday'); ?>
                    <div id="birthday-error-row" class="text-danger hidden"></div>        
            	</div>
                
            	<div id="phone-row" class="left">
            		<?php echo $form->labelEx($model,'phone',array('class'=>'label-small')); ?>
            		<?php echo $form->textField($model,'phone',array('maxlength'=>14,'class'=>'profile-control')); ?>
            		<?php echo $form->error($model,'phone'); ?>
                    <div id="phone-error-row" class="text-danger hidden"></div>        
            	</div>
           	</div>
            
        	<div class="form-group btn-profile">
        		<?php echo CHtml::ajaxSubmitButton('Save Profile', 'track/user/update', 
        			array(
                        'type' => 'POST',
                        'dataType' => 'JSON',
                        'success' => 'function (response) { ProfileHelper.saveProfile(response); }',
                    ),
                    array(
        	            'id' => 'save-profile-button',
        	            'name' => 'save-profile-button',
                        'class' => 'btn',
                	)
        		);?>
                <span class="tabs-navigation">
                    <a class="italic space-small" href="#tab-password"><small>Change Password</small></a>
                </span>
        	</div>

        <?php $this->endWidget(); ?>
    </div>
</div>