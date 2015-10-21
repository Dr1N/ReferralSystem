<?php
/* @var $this OrganizationController */
/* @var $model Organization */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'organization-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array(
        'class' => 'form-horizontal'
	),
)); ?>

	<p class="alert alert-info">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
    
    <div class="well well-sm">

        <div class="col-md-6 col-sm-12 col-xs-12">
    
            <div class="form-group">
                <div class="col-md-offset-3 col-sm-offset-3 col-sm-9">
            		<h3>General Information</h3>
                </div>
            </div>

        	<div class="form-group">
        		<?php echo $form->labelEx($model,'name',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
                <div class="col-md-9 col-sm-9">
            		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>100,'class'=>'form-control')); ?>
            		<?php echo $form->error($model,'name'); ?>
                </div>
        	</div>
        
        	<div class="form-group">
        		<?php echo $form->labelEx($model,'site_url',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
                <div class="col-md-9 col-sm-9">
                    <div class="input-group">
                        <span class="input-group-addon">http://</span>
                		<?php echo $form->textField($model,'site_url',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
                    </div>
            		<?php echo $form->error($model,'site_url'); ?>
                </div>
        	</div>

            <div class="form-group">
                <?php echo $form->labelEx($model,'industry_id',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
                <div class="col-md-9 col-sm-9">
                    <?php echo $form->dropDownList($model,'industry_id',Industry::getIndustries(true),array('class'=>'form-control')); ?> 
                    <?php echo $form->error($model,'industry_id'); ?>
                </div>
            </div>
        
        	<div class="form-group">
        		<?php echo $form->labelEx($model,'description',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
                <div class="col-md-9 col-sm-9">
            		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50,'class'=>'form-control')); ?>
            		<?php echo $form->error($model,'description'); ?>
                </div>
        	</div>
        
        </div>
        
        <div class="col-md-6 col-sm-12 col-xs-12">
    
            <div class="form-group">
                <div class="col-md-offset-3 col-sm-offset-3 col-sm-9">
            		<h3>Location Information</h3>
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
                <?php echo $form->labelEx($model,'postal_code',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
                <div class="col-md-9 col-sm-9">
                    <?php echo $form->textField($model,'postal_code',array('size'=>60,'maxlength'=>100,'class'=>'form-control')); ?>
                    <?php echo $form->error($model,'postal_code'); ?>
                </div>
            </div>
        
            <div class="form-group">
                <?php echo $form->labelEx($model,'state',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
                <div class="col-md-9 col-sm-9">
                    <?php echo $form->textField($model,'state',array('size'=>60,'maxlength'=>100,'class'=>'form-control')); ?>
                    <?php echo $form->error($model,'state'); ?>
                </div>
            </div>
        
            <div class="form-group">
                <?php echo $form->labelEx($model,'city',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
                <div class="col-md-9 col-sm-9">
                    <?php echo $form->textField($model,'city',array('size'=>60,'maxlength'=>100,'class'=>'form-control')); ?>
                    <?php echo $form->error($model,'city'); ?>
                </div>
            </div>
           
            <div class="form-group">
                <?php echo $form->labelEx($model,'address_line_1',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
                <div class="col-md-9 col-sm-9">
                    <?php echo $form->textField($model,'address_line_1',array('size'=>60,'maxlength'=>100,'class'=>'form-control')); ?>
                    <?php echo $form->error($model,'address_line_1'); ?>
                </div>
            </div>
        
            <div class="form-group">
                <?php echo $form->labelEx($model,'address_line_2',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
                <div class="col-md-9 col-sm-9">
                    <?php echo $form->textField($model,'address_line_2',array('size'=>60,'maxlength'=>100,'class'=>'form-control')); ?>
                    <?php echo $form->error($model,'address_line_2'); ?>
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
        
        <div class="clear"></div>
        
	</div>

<?php $this->endWidget(); ?>

</div>