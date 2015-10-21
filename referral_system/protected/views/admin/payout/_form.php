<?php
/* @var $this PayoutController */
/* @var $model Payout */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'payout-form',
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
    		<?php echo $form->labelEx($model,'user_id',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
    		<div class="col-md-9 col-sm-9">
        		<?php echo $form->textField($model,'user_id',array('value'=>$model->user->mail,'disabled'=>!$model->isNewRecord,'class'=>'form-control')); ?>
        		<?php echo $form->error($model,'user_id'); ?>
            </div>
    	</div>
    
    	<div class="form-group">
    		<?php echo $form->labelEx($model,'campaign_id',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
    		<div class="col-md-9 col-sm-9">
        		<?php echo $form->textField($model,'campaign_id',array('value'=>$model->campaign->name,'disabled'=>!$model->isNewRecord,'class'=>'form-control')); ?>
        		<?php echo $form->error($model,'campaign_id'); ?>
            </div>
    	</div>
    
    	<div class="form-group">
    		<?php echo $form->labelEx($model,'amount',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
    		<div class="col-md-9 col-sm-9">
                <div class="input-group">
                    <span class="input-group-addon">$</span>
            		<?php echo $form->textField($model,'amount',array('disabled'=>!$model->isNewRecord,'class'=>'form-control')); ?>
                </div>
        		<?php echo $form->error($model,'amount'); ?>
            </div>
    	</div>
    
    	<div class="form-group">
    		<?php echo $form->labelEx($model,'end_amount',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
    		<div class="col-md-9 col-sm-9">
                <div class="input-group">
                    <span class="input-group-addon">$</span>
            		<?php echo $form->textField($model,'end_amount',array('disabled'=>!$model->isNewRecord,'class'=>'form-control')); ?>
                </div>
        		<?php echo $form->error($model,'end_amount'); ?>
            </div>
    	</div>
    
    	<div class="form-group">
    		<?php echo $form->labelEx($model,'created_at',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
    		<div class="col-md-9 col-sm-9">
                <?php echo $form->textField($model,'created_at',array('disabled'=>true,'value'=>$model->isNewRecord ? DateHandler::nowView() : DateHandler::dateTimeView($model->created_at),'class'=>'form-control')); ?>
                <?php echo $form->hiddenField($model,'created_at',array('value'=>$model->isNewRecord ? DateHandler::now() : DateHandler::dateTime($model->created_at))); ?>
        		<?php echo $form->error($model,'created_at'); ?>
            </div>
    	</div>
    
    	<div class="form-group">
    		<?php echo $form->labelEx($model,'payout_way',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
    		<div class="col-md-9 col-sm-9">
        		<?php echo $form->dropDownList($model,'payout_way',Payout::$payoutWay,array('disabled'=>!$model->isNewRecord,'class'=>'form-control')); ?>
        		<?php echo $form->error($model,'payout_way'); ?>
            </div>
    	</div>
        
    	<div class="form-group">
    		<?php echo $form->labelEx($model,'status',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
            <div class="col-md-9 col-sm-9">
                <div class="btn-group" data-toggle="buttons" id="payout-status">
                    <label class="btn btn-success <?php echo $model->status == 'completed' ? 'active' : '' ?>">
                		<?php echo $form->radioButton($model,'status',array('value'=>'completed','uncheckValue'=>null)) . ' Completed'; ?>
                    </label>
                    <label class="btn btn-warning <?php echo $model->status == 'pending' ? 'active' : '' ?>">
                		<?php echo $form->radioButton($model,'status',array('value'=>'pending','uncheckValue'=>null)) . ' Pending'; ?>
                    </label>
                    <label class="btn btn-danger <?php echo $model->status == 'rejected' ? 'active' : '' ?>">
                		<?php echo $form->radioButton($model,'status',array('value'=>'rejected','uncheckValue'=>null)) . ' Rejected'; ?>
                    </label>
                </div>
        		<?php echo $form->error($model,'status'); ?>
            </div>
    	</div>
    
    	<div class="form-group">
    		<?php echo $form->labelEx($model,'details',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
    		<div class="col-md-9 col-sm-9">
                <?php echo $form->textArea($model,'details',array('value'=>Payout::parseDetails($model->details), 'disabled'=>!$model->isNewRecord, 'class'=>'form-control')); ?>
        		<?php echo $form->error($model,'details'); ?>
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