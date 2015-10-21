<?php
/* @var $this CampaignController */
/* @var $model Campaign */
/* @var $form CActiveForm */
?>

<div class="form">

    <p class="alert alert-info">Fields with<span class="required">*</span> are required.</p>
    
    <?php $form=$this->beginWidget('CActiveForm', array(
    	'id'=>'campaign-form',
    	'enableAjaxValidation'=>false,
    	'htmlOptions' => array(
            'class' => 'form-horizontal',
            'enctype'=>'multipart/form-data'
    	),
    )); ?>
    
        <div class="col-md-6 col-sm-12 col-xs-12">
            <?php echo $form->errorSummary(array($model, $model->setting));?>
            <div id="block-general" <?php if ($model->isNewRecord && !empty($model->name)): ?> class="hidden-simple" <?php endif; ?>>
                <?php echo $this->renderPartial('_formGeneral', array('form'=>$form, 'model'=>$model)); ?>
            </div>
            <div class="clear"></div>
            <div id="block-setting" <?php if ($model->isNewRecord && empty($model->name)): ?> class="hidden-simple" <?php endif; ?>>
                <?php echo $this->renderPartial('_formSetting', array('form'=>$form, 'model'=>$model->setting)); ?>
            </div>
        </div>
        
        <div class="col-md-6 col-sm-12 col-xs-12">
            <div class="col-md-offset-0 col-sm-offset-1 hidden-xs">
                <div class="form-group visible-sm">
                    <div class="col-md-offset-2 col-sm-offset-2 col-sm-9">
                		<h3>Widget View Example</h3>
                    </div>
                </div>
                <iframe src="http://referral_system/track?id=1&code=1234567890&example=1" width="554" height="574" frameborder="0"></iframe> <!-- !!!!!!!!!!!!!!!!!!!!!!!! -->
            </div>
            <div class="clear"></div>
            <div id="block-code">
                <?php if (!$model->isNewRecord): ?>
                    <?php echo $this->renderPartial('_formCode', array('form'=>$form, 'model'=>$model, 'link'=>isset($link) ? $link : null)); ?>
                <?php endif; ?>
            </div>
        </div>
        
        <div class="clearfix visible-xs"></div>
        <div class="clear"></div>
        
    <?php $this->endWidget(); ?>

</div>