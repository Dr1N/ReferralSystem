<?php
/* @var $this PurchaseController */
/* @var $model Purchase */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'purchase-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array(
        'class' => 'form-horizontal'
	),
)); ?>

	<p class="alert alert-info">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

    <div class="well">
    <div class="form-panel">

    	<div class="form-group">
    		<?php echo $form->labelEx($model,'owner_id',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
    		<div class="col-md-9 col-sm-9">
        		<?php echo $form->textField($model,'owner_id',array('disabled'=>true, 'value'=>$model->owner->first_name . ' ' . $model->owner->last_name,'class'=>'form-control')); ?>
        		<?php echo $form->error($model,'owner_id'); ?>
            </div>
    	</div>
    
    	<div class="form-group">
    		<?php echo $form->labelEx($model,'campaign_id',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
    		<div class="col-md-9 col-sm-9">
        		<?php echo $form->textField($model,'campaign_id',array('disabled'=>true, 'value'=>$model->campaign->name,'class'=>'form-control')); ?>
        		<?php echo $form->error($model,'campaign_id'); ?>
            </div>
    	</div>
    
    	<div class="form-group">
    		<?php echo $form->labelEx($model,'used_way',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
    		<div class="col-md-9 col-sm-9">
        		<?php echo $form->textField($model,'used_way',array('disabled'=>true,'class'=>'form-control')); ?>
        		<?php echo $form->error($model,'used_way'); ?>
            </div>
    	</div>
    
    	<div class="form-group">
    		<?php echo $form->labelEx($model,'ip_address',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
    		<div class="col-md-9 col-sm-9">
        		<?php echo $form->textField($model,'ip_address',array('disabled'=>true, 'value'=>long2ip($model->ip_address),'class'=>'form-control')); ?>
        		<?php echo $form->error($model,'ip_address'); ?>
            </div>
    	</div>
    
    	<div class="form-group">
    		<?php echo $form->labelEx($model,'amount',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
    		<div class="col-md-9 col-sm-9">
                <div class="input-group">
                    <span class="input-group-addon">$</span>
            		<?php echo $form->textField($model,'amount',array('disabled'=>true,'class'=>'form-control')); ?>
                </div>
        		<?php echo $form->error($model,'amount'); ?>
            </div>
    	</div>
    
    	<div class="form-group">
    		<?php echo $form->labelEx($model,'paid_at',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
    		<div class="col-md-9 col-sm-9">
        		<?php echo $form->textField($model,'paid_at',array('disabled'=>true,'value'=>DateHandler::dateTimeView($model->paid_at),'class'=>'form-control')); ?>
        		<?php echo $form->error($model,'paid_at'); ?>
            </div>
    	</div>
    
        <?php if ($model->isNewRecord): ?>
        	<div class="form-group buttons">
                <div class="col-md-offset-3 col-sm-offset-3 col-sm-10">
            		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-primary')); ?>
                </div>
        	</div>
        <?php endif; ?>

    </div>
    </div>

<?php $this->endWidget(); ?>

</div>