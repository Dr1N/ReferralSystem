<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array(
        'enctype'=>'multipart/form-data',
        'class' => 'form-horizontal'
	),
)); ?>

	<p class="alert alert-info">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
    
    <div class="well well-sm">
    
        <div class="col-md-6 col-sm-12 col-xs-12">

            <div class="form-group">
                <div class="col-md-offset-3 col-sm-offset-3 col-sm-9">
            		<h3>Personal Information</h3>
                </div>
            </div>
            
        	<div class="form-group">
        		<?php echo $form->labelEx($model,'mail',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
                <div class="col-md-9 col-sm-9">
                    <div class="input-group">
                        <span class="input-group-addon">@</span>
                		<?php echo $form->textField($model,'mail',array('size'=>60,'maxlength'=>100,'disabled'=>true,'class'=>'form-control')); ?>
                    </div>
            		<?php echo $form->error($model,'mail'); ?>
                </div>
        	</div>
            
            <div class="form-group">
        		<?php echo $form->labelEx($model,'first_name',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
                <div class="col-md-9 col-sm-9">
            		<?php echo $form->textField($model,'first_name',array('size'=>60,'maxlength'=>100,'class'=>'form-control')); ?>
            		<?php echo $form->error($model,'first_name'); ?>
                </div>
        	</div>
        
        	<div class="form-group">
        		<?php echo $form->labelEx($model,'last_name',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
                <div class="col-md-9 col-sm-9">
            		<?php echo $form->textField($model,'last_name',array('size'=>60,'maxlength'=>100,'class'=>'form-control')); ?>
            		<?php echo $form->error($model,'last_name'); ?>
                </div>
        	</div>
        
        	<div class="form-group">
        		<?php echo $form->labelEx($model,'birthday',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
                <div class="col-md-9 col-sm-9">
            		<?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
            		    'name'=>'datepicker-month-year-menu',
            		    'flat'=>false,
                        'value'=>strtotime($model->birthday) ? DateHandler::dateView($model->birthday) : '',
                        'options'=>array(
            			    'dateFormat'=>'mm/dd/yy',
                            'showAnim'=>'fadeIn',
            		        'changeMonth'=>true,
            		        'changeYear'=>true,
            		        'yearRange'=>'1950:2013',
            		    ),
            		    'htmlOptions'=>array(
            		    	'name'=>'User[birthday]',
                            'class'=>'form-control',
            		    ),
            		)); ?>
            		<?php echo $form->error($model,'birthday'); ?>
                </div>
        	</div>
        
        	<div class="form-group">
        		<?php echo $form->labelEx($model,'registered_at',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
                <div class="col-md-9 col-sm-9">
            		<?php echo $form->textField($model,'registered_at', array('value' => strtotime($model->registered_at) ? DateHandler::dateView($model->registered_at) : '','disabled'=>'true','class'=>'form-control')); ?> 
            		<?php echo $form->error($model,'registered_at'); ?>
                </div>
        	</div>
        
        	<div class="form-group">
        		<?php echo $form->labelEx($model,'last_login_at',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
                <div class="col-md-9 col-sm-9">
            		<?php echo $form->textField($model,'last_login_at', array('value' => strtotime($model->last_login_at) ? DateHandler::dateView($model->last_login_at) : '','disabled'=>'true','class'=>'form-control')); ?> 
            		<?php echo $form->error($model,'last_login_at'); ?>
                </div>
        	</div>
        	
        </div>
        
        <div class="col-md-6 col-sm-12 col-xs-12">
        
            <div class="form-group">
                <div class="col-md-offset-3 col-sm-offset-3 col-sm-9">
            		<h3>Contact and Location</h3>
                </div>
            </div>

            <div class="form-group">
        		<?php echo $form->labelEx($model,'country_id',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
                <div class="col-md-9 col-sm-9">
            		<?php echo $form->dropDownList($model,'country_id',Country::getCountries(true),array('class'=>'form-control')); ?> 
            		<?php echo $form->error($model,'country_id'); ?>
                </div>
        	</div>
        
        	<div class="form-group">
        		<?php echo $form->labelEx($model,'city',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
                <div class="col-md-9 col-sm-9">
            		<?php echo $form->textField($model,'city',array('class'=>'form-control')); ?> 
            		<?php echo $form->error($model,'city'); ?>
                </div>
        	</div>
        
        	<div class="form-group">
        		<?php echo $form->labelEx($model,'address',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
                <div class="col-md-9 col-sm-9">
            		<?php echo $form->textField($model,'address',array('size'=>60,'maxlength'=>100,'class'=>'form-control')); ?>
            		<?php echo $form->error($model,'address'); ?>
                </div>
        	</div>
        
        	<div class="form-group">
        		<?php echo $form->labelEx($model,'phone',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
                <div class="col-md-9 col-sm-9">
            		<?php echo $form->textField($model,'phone',array('size'=>14,'maxlength'=>14,'class'=>'form-control')); ?>
            		<?php echo $form->error($model,'phone'); ?>
                </div>
        	</div>
            
        	<div class="form-group">
        		<?php echo $form->labelEx($model,'organization_id',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
                <div class="col-md-9 col-sm-9">
            		<?php echo $form->textField($model,'organization_id',array('size'=>14,'maxlength'=>14,'class'=>'form-control','disabled'=>'disabled', 'value'=>$model->organization ? $model->organization->name : '')); ?>
            		<?php echo $form->error($model,'organization_id'); ?>
                </div>
        	</div>
            
            <div class="form-group">
                <?php echo $form->labelEx($model,'image',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
                <div class="col-md-9 col-sm-9">
                    <?php echo $form->fileField($model,'image',array('class'=>'form-control'));?>
                    <?php echo $form->error($model,'image'); ?>
                </div>
            </div>
            
        </div>
        
        <div class="clear"></div>
        
        <div class="col-md-6 col-sm-12 col-xs-12">
        	<div class="form-group buttons">
                <div class="col-md-offset-3 col-sm-offset-3 col-sm-9">
            		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'btn btn-success')); ?>
                </div>
        	</div>
        </div>
        
        <div class="col-md-6 col-sm-12 col-xs-12">
            <?php if(!empty($model->image)): ?>
                <div id="image-container" class="form-group">
                    <div class="col-md-offset-3 col-sm-offset-3 col-md-3 col-sm-3 col-xs-4">
                        <?php echo CHtml::image($model->getImagePath(), 'Avatar', array('class' => 'img-thumbnail')); ?><br />
                        <?php echo Chtml::link('Delete image', array('/user/deleteImage/id/' . $model->id), array('id'=>'delete-image')); ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        
        <div class="clear"></div>
         
     </div>

<?php $this->endWidget(); ?>