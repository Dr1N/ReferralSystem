<?php
/* @var $this CampaignController */
/* @var $model Campaign */
/* @var $form CActiveForm */
?>

<div class="well well-sm">

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
    	<?php echo $form->labelEx($model,'user_id',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
        <div class="col-md-9 col-sm-9">
            <div class="input-group">
                <span class="input-group-addon">@</span>
        		<?php echo $form->textField($model,'user_id', array('value'=>$model->isNewRecord ? Yii::app()->user->name : $model->user->mail, 'disabled'=>'true','class'=>'form-control')); ?> 
    		</div>
            <?php echo $form->error($model,'user_id'); ?>
        </div>
    </div>
    
    <div class="form-group">
    	<?php echo $form->labelEx($model,'alias',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
        <div class="col-md-9 col-sm-9">
    		<?php echo $form->textField($model,'alias',array('size'=>60,'maxlength'=>100,'class'=>'form-control')); ?>
    		<?php echo $form->error($model,'alias'); ?>
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

    <div class="form-group">
        <?php echo $form->labelEx($model,'image',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
        <div class="col-md-9 col-sm-9">
            <?php echo $form->fileField($model,'image', array('class'=>'form-control'));?>
            <?php echo $form->error($model,'image'); ?>
        </div>
    </div>
    
    <?php if(!empty($model->image)): ?>
        <div id="image-container" class="form-group">
            <div class="col-md-offset-3 col-sm-offset-3 col-md-3 col-sm-3 col-xs-4"> <!-- col-md-4 col-sm-3 col-xs-6 -->
                <?php echo CHtml::image($model->getImagePath(), 'Logo', array('class' => 'img-thumbnail')); ?><br />
                <?php echo Chtml::link('Delete image', array('/campaign/deleteImage/id/' . $model->id), array('id'=>'delete-image')); ?>
            </div>
        </div>
    <?php endif; ?>

    <?php if ($model->isNewRecord): ?>
        <div class="form-group buttons">
            <div class="col-md-offset-3 col-sm-offset-3 col-sm-9">
                <?php echo CHtml::button('Next', array('class'=>'btn btn-info', 'id'=>'next-button')); ?>
            </div>
        </div>
    <?php endif; ?>

</div>