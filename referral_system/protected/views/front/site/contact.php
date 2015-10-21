<?php
	$this->pageTitle=Yii::app()->name . ' - Contact Us';
?>

<h1>Contact Us</h1>

<?php if(Yii::app()->user->hasFlash('contact')): ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('contact'); ?>
</div>

<?php else: ?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'contact-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
        'errorCssClass' => 'text-danger has-error',
	),
	'htmlOptions' => array(
        'class' => 'form-horizontal'
	),
)); ?>

	<p class="alert alert-info">
        If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.<br />
        Fields with <span class="required">*</span> are required.
    </p>

	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">
		<?php echo $form->labelEx($model,'name',array('class'=>'col-md-2 col-sm-2 control-label')); ?>
        <div class="col-md-10 col-sm-10">
    		<?php echo $form->textField($model,'name',array('class'=>'form-control')); ?>
    		<?php echo $form->error($model,'name'); ?>
        </div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'email',array('class'=>'col-md-2 col-sm-2 control-label')); ?>
        <div class="col-md-10 col-sm-10">
    		<?php echo $form->textField($model,'email',array('class'=>'form-control')); ?>
    		<?php echo $form->error($model,'email'); ?>
        </div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'subject',array('class'=>'col-md-2 col-sm-2 control-label')); ?>
        <div class="col-md-10 col-sm-10">
    		<?php echo $form->textField($model,'subject',array('size'=>60,'maxlength'=>128,'class'=>'form-control')); ?>
    		<?php echo $form->error($model,'subject'); ?>
        </div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'body',array('class'=>'col-md-2 col-sm-2 control-label')); ?>
        <div class="col-md-10 col-sm-10">
    		<?php echo $form->textArea($model,'body',array('rows'=>6, 'cols'=>50,'class'=>'form-control')); ?>
    		<?php echo $form->error($model,'body'); ?>
        </div>
	</div>

	<?php if(CCaptcha::checkRequirements()): ?>
	<div class="form-group">
		<?php echo $form->labelEx($model,'verifyCode',array('class'=>'col-md-2 col-sm-2 control-label')); ?>
        <div class="col-md-10 col-sm-10">
            <?php $this->widget('CCaptcha'); ?>
            <?php echo $form->textField($model,'verifyCode',array('class'=>'form-control')); ?>
    		<div class="hint">Please enter the letters as they are shown in the image above.
    		<br/>Letters are not case-sensitive.</div>
    		<?php echo $form->error($model,'verifyCode'); ?>
        </div>
	</div>
	<?php endif; ?>

	<div class="form-group buttons">
        <div class="col-md-offset-2 col-sm-offset-2 col-sm-10">
            <?php echo CHtml::submitButton('Submit', array('class'=>'btn btn-success')); ?>
    	</div>
	</div>

<?php $this->endWidget(); ?>

</div>

<?php endif; ?>