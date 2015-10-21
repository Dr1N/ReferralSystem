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
        'class' => 'form-horizontal',
	),
)); ?>

	<p class="alert alert-info">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

    <div class="well">
    <div class="form-panel">
  
    	<div class="form-group">
            <?php echo $form->labelEx($model,'organization_id',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
            <div class="col-md-9 col-sm-9">
        		<?php echo $form->dropDownList($model,'organization_id',Organization::getOrganizations(true),array('class'=>'form-control')); ?> 
        		<?php echo $form->error($model,'organization_id'); ?>
            </div>
    	</div>
    
    	<div class="form-group">
            <?php echo $form->labelEx($model,'mail',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
            <div class="col-md-9 col-sm-9">
                <div class="input-group">
                    <span class="input-group-addon">@</span>
            		<?php echo $form->textField($model,'mail',array('size'=>60,'maxlength'=>100,'class'=>'form-control')); ?>
                </div>
        		<?php echo $form->error($model,'mail'); ?>
            </div>
    	</div>
    
    	<?php if ($model->isNewRecord): ?>
    		<div class="form-group">
                <?php echo $form->labelEx($model,'password',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
                <div class="col-md-9 col-sm-9">
        			<?php echo $form->passwordField($model,'password',array('size'=>32,'maxlength'=>32,'class'=>'form-control')); ?>
        			<?php echo $form->error($model,'password'); ?>
                </div>
    		</div>
    	<?php endif; ?>
    	
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
            <?php echo $form->labelEx($model,'country_id',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
            <div class="col-md-9 col-sm-9">
        		<?php echo $form->dropDownList($model,'country_id',Country::getCountries(true),array('class'=>'form-control')); ?> 
        		<?php echo $form->error($model,'country_id'); ?>
            </div>
    	</div>
    
    	<div class="form-group">
            <?php echo $form->labelEx($model,'city',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
            <div class="col-md-9 col-sm-9">
        		<?php echo $form->textField($model,'city', array('size'=>60,'maxlength'=>100,'class'=>'form-control')); ?> 
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
            <?php echo $form->labelEx($model,'birthday',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
            <div class="col-md-9 col-sm-9">
        		<?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
        		    'name'=>'datepicker-month-year-menu',
        		    'flat'=>false,
                    'value'=>strtotime($model->birthday) ? DateHandler::dateView($model->birthday) : '',
                    'options'=>array(
        			    'dateFormat' => 'mm/dd/yy',
                        'showAnim'=>'fadeIn',	//'slide','fold','slideDown','fadeIn','blind','bounce','clip','drop'
        		        'changeMonth'=>true,
        		        'changeYear'=>true,
        		        'yearRange'=>'1950:2013',
        		    ),
        		    'htmlOptions'=>array(
        		    	'name'=>'User[birthday]',
                        'class'=>'form-control'
        		    ),
        		));
        		?>
        		<?php echo $form->error($model,'birthday'); ?>
            </div>
    	</div>
        
    	<div class="form-group">
            <?php echo $form->labelEx($model,'type',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
            <div class="col-md-9 col-sm-9">
        		<?php echo $form->dropDownList($model,'type',User::$type,array('class'=>'form-control')); ?> 
        		<?php echo $form->error($model,'type'); ?>
            </div>
    	</div>
    
    	<?php if(!empty($model->image)): ?>
    		<div id="image-container" class="form-group">
    	        <div class="col-md-offset-3 col-sm-offset-3 col-md-2 col-sm-3 col-xs-5">
    				<?php echo CHtml::image($model->getImagePath(), 'Avatar', array('class' => 'img-thumbnail')); ?><br />
    				<?php echo Chtml::link('Delete image', array('admin/user/deleteImage/id/' . $model->id), array('id'=>'delete-image')); ?>
    			</div>
    		</div>
    	<?php endif; ?>
    
    	<div class="form-group">
    		<?php echo $form->labelEx($model,'image',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
            <div class="col-md-9 col-sm-9">
    			<?php echo $form->fileField($model,'image',array('class'=>'form-control'));?>
    			<?php echo $form->error($model,'image'); ?>
    		</div>
    	</div>
    
    	<div class="form-group">
            <?php echo $form->labelEx($model,'verified',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
            <div class="col-md-9 col-sm-9">
                <div class="btn-group" data-toggle="buttons">
                    <label class="btn btn-default <?php echo $model->verified == 'yes' ? 'active' : '' ?>">
                		<?php echo $form->radioButton($model,'verified',array('value'=>'yes','uncheckValue'=>null)) . 'Yes'; ?>
                    </label>
                    <label class="btn btn-default <?php echo $model->verified == 'no' ? 'active' : '' ?>">
                		<?php echo $form->radioButton($model,'verified',array('value'=>'no','uncheckValue'=>null)) . ' No'; ?>
                    </label>
                </div>
        		<?php echo $form->error($model,'verified'); ?>
            </div>
    	</div>
    
    	<?php if (!$model->isNewRecord): ?>
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
    	<?php endif; ?>
    	
    	<div class="form-group">
            <?php echo $form->labelEx($model,'active',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
            <div class="col-md-9 col-sm-9">
                <div class="btn-group" data-toggle="buttons">
                    <label class="btn btn-default <?php echo $model->active == 'yes' ? 'active' : '' ?>">
                		<?php echo $form->radioButton($model,'active',array('value'=>'yes','uncheckValue'=>null)) . 'Yes'; ?>
                    </label>
                    <label class="btn btn-default <?php echo $model->active == 'no' ? 'active' : '' ?>">
                		<?php echo $form->radioButton($model,'active',array('value'=>'no','uncheckValue'=>null)) . ' No'; ?>
                    </label>
                </div>
                <?php echo $form->error($model,'active'); ?>
            </div>
    	</div>
    	
    	<div class="form-group buttons">
            <div class="col-md-offset-3 col-sm-offset-3 col-sm-10">
                <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-primary')); ?>
            </div>
    	</div>
    
    </div>
    </div>

<?php $this->endWidget(); ?>

</div>