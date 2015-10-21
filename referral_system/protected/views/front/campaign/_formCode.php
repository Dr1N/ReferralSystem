<?php
/* @var $this CampaignController */
/* @var $model Campaign */
/* @var $form CActiveForm */
?>

<div class="form-group">
    <div class="col-md-offset-3 col-sm-offset-3 col-sm-9">
		<h3>Widget and Tracking code</h3>
    </div>
</div>

<?php if (!$model->isNewRecord): ?>
	<div class="form-group">
		<?php echo CHtml::label('Widget Code','widget_code',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
        <div class="col-md-9 col-sm-9">
    		<?php echo CHtml::textArea('widget_code', '<iframe src="' . $link . '" width="650" height="720" frameborder="0"></iframe>', array('rows'=>3, 'cols'=>70, 'disabled'=>true,'class'=>'form-control')); ?>
        </div>
	</div>
    
	<div class="form-group">
		<?php echo CHtml::label('Click Tracking Code','track_code',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
        <div class="col-md-9 col-sm-9">
    		<?php echo CHtml::textArea('track_code', $this->renderPartial('_trackCode', array('model'=>$model, 'type'=>'click'), true), array('rows'=>7, 'cols'=>70, 'disabled'=>true,'class'=>'form-control')); ?>
        </div>
	</div>
    
	<div class="form-group">
		<?php echo CHtml::label('Purchase Tracking Code','track_code',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
        <div class="col-md-9 col-sm-9">
    		<?php echo CHtml::textArea('track_code', $this->renderPartial('_trackCode', array('model'=>$model, 'type'=>'purchase'), true), array('rows'=>7, 'cols'=>70, 'disabled'=>true,'class'=>'form-control')); ?>
        </div>
	</div>
<?php endif; ?>