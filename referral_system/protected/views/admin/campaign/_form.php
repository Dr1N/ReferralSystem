<?php
/* @var $this CampaignController */
/* @var $model Campaign */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'campaign-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array(
        'class' => 'form-horizontal',
        'enctype'=>'multipart/form-data'
	),
)); ?>

	<p class="alert alert-info">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary(array($model, $model->setting)); ?>

    <div class="well">
    <div class="form-panel">
    
        <?php echo $this->renderPartial('_formGeneral', array('form'=>$form, 'model'=>$model, 'link'=>isset($link) ? $link : null)); ?>
        
        <?php echo $this->renderPartial('_formSetting', array('form'=>$form, 'model'=>$model->setting)); ?>
        
    	<div class="form-group buttons">
            <div class="col-md-offset-3 col-sm-offset-3 col-sm-10">
                <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-primary')); ?>
            </div>
    	</div>

    </div>
    </div>

<?php $this->endWidget(); ?>

</div>