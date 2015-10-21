<?php
/* @var $this CampaignController */
/* @var $model CampaignSetting */
/* @var $form CActiveForm */
?>

<div class="well well-sm">

    <div class="form-group">
        <div class="col-md-offset-3 col-sm-offset-3 col-sm-9">
    		<h3>Campaign Settings</h3>
        </div>
    </div>
    
    <div class="form-group">
    	<?php echo $form->labelEx($model,'referral_prize',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
        <div class="col-md-9 col-sm-9">
            <div class="input-group">
                <span class="input-group-addon">$</span>
        		<?php echo $form->textField($model,'referral_prize',array('class'=>'form-control')); ?>
    		</div>
            <?php echo $form->error($model,'referral_prize'); ?>
        </div>
    </div>
    
    <div class="form-group">
    	<?php echo $form->labelEx($model,'recipient_prize',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
        <div class="col-md-9 col-sm-9">
            <div class="input-group">
                <span class="input-group-addon">$</span>
        		<?php echo $form->textField($model,'recipient_prize',array('class'=>'form-control')); ?>
    		</div>
            <?php echo $form->error($model,'recipient_prize'); ?>
        </div>
    </div>
    
    <div class="form-group">
    	<?php echo $form->labelEx($model,'min_payout',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
        <div class="col-md-9 col-sm-9">
            <div class="input-group">
                <span class="input-group-addon">$</span>
        		<?php echo $form->textField($model,'min_payout',array('class'=>'form-control')); ?>
    		</div>
            <?php echo $form->error($model,'min_payout'); ?>
        </div>
    </div>
            
    <div class="form-group">
    	<?php echo $form->labelEx($model,'enable_mail',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
        <div class="col-md-9 col-sm-9">
            <div class="btn-group" data-toggle="buttons">
                <label class="btn btn-default <?php echo $model->enable_mail == 'yes' ? 'active' : '' ?>">
            		<?php echo $form->radioButton($model,'enable_mail',array('value'=>'yes','uncheckValue'=>null)) . 'Yes'; ?>
                </label>
                <label class="btn btn-default <?php echo $model->enable_mail == 'no' ? 'active' : '' ?>">
            		<?php echo $form->radioButton($model,'enable_mail',array('value'=>'no','uncheckValue'=>null)) . ' No'; ?>
                </label>
            </div>
    		<?php echo $form->error($model,'enable_mail'); ?>
        </div>
    </div>
    
    <div class="form-group" id="mial-message">
    	<?php echo $form->labelEx($model,'message_mail',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
        <div class="col-md-9 col-sm-9">
    		<?php echo $form->textArea($model,'message_mail',array('rows'=>5, 'cols'=>50,'class'=>'form-control')); ?>
    		<?php echo $form->error($model,'message_mail'); ?>
        </div>
    </div>
    
    <div class="form-group">
    	<?php echo $form->labelEx($model,'enable_facebook',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
        <div class="col-md-9 col-sm-9">
            <div class="btn-group" data-toggle="buttons">
                <label class="btn btn-default <?php echo $model->enable_facebook == 'yes' ? 'active' : '' ?>">
            		<?php echo $form->radioButton($model,'enable_facebook',array('value'=>'yes','uncheckValue'=>null)) . 'Yes'; ?>
                </label>
                <label class="btn btn-default <?php echo $model->enable_facebook == 'no' ? 'active' : '' ?>">
            		<?php echo $form->radioButton($model,'enable_facebook',array('value'=>'no','uncheckValue'=>null)) . ' No'; ?>
                </label>
            </div>
    		<?php echo $form->error($model,'enable_facebook'); ?>
        </div>
    </div>
    
    <div class="form-group" id="facebook-message">
    	<?php echo $form->labelEx($model,'message_facebook',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
        <div class="col-md-9 col-sm-9">
    		<?php echo $form->textArea($model,'message_facebook',array('rows'=>5, 'cols'=>50,'class'=>'form-control')); ?>
    		<?php echo $form->error($model,'message_facebook'); ?>
        </div>
    </div>
    
    <div class="form-group">
    	<?php echo $form->labelEx($model,'enable_twitter',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
        <div class="col-md-9 col-sm-9">
            <div class="btn-group" data-toggle="buttons">
                <label class="btn btn-default <?php echo $model->enable_twitter == 'yes' ? 'active' : '' ?>">
            		<?php echo $form->radioButton($model,'enable_twitter',array('value'=>'yes','uncheckValue'=>null)) . 'Yes'; ?>
                </label>
                <label class="btn btn-default <?php echo $model->enable_twitter == 'no' ? 'active' : '' ?>">
            		<?php echo $form->radioButton($model,'enable_twitter',array('value'=>'no','uncheckValue'=>null)) . ' No'; ?>
                </label>
            </div>
    		<?php echo $form->error($model,'enable_twitter'); ?>
        </div>
    </div>
    
    <div class="form-group" id="twitter-message">
    	<?php echo $form->labelEx($model,'message_twitter',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
        <div class="col-md-9 col-sm-9">
    		<?php echo $form->textArea($model,'message_twitter',array('rows'=>5, 'cols'=>50,'class'=>'form-control')); ?>
    		<?php echo $form->error($model,'message_twitter'); ?>
        </div>
    </div> 
    
    <div class="form-group">
    	<?php echo $form->labelEx($model,'enable_link',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
        <div class="col-md-9 col-sm-9">
            <div class="btn-group" data-toggle="buttons">
                <label class="btn btn-default <?php echo $model->enable_link == 'yes' ? 'active' : '' ?>">
            		<?php echo $form->radioButton($model,'enable_link',array('value'=>'yes','uncheckValue'=>null)) . 'Yes'; ?>
                </label>
                <label class="btn btn-default <?php echo $model->enable_link == 'no' ? 'active' : '' ?>">
            		<?php echo $form->radioButton($model,'enable_link',array('value'=>'no','uncheckValue'=>null)) . ' No'; ?>
                </label>
            </div>
    		<?php echo $form->error($model,'enable_link'); ?>
        </div>
    </div>
    
    <div class="form-group buttons">
        <div class="col-md-offset-3 col-sm-offset-3 col-sm-9">
            <?php if ($model->isNewRecord): ?>
                <?php echo CHtml::button('Back', array('class'=>'btn btn-info', 'id'=>'prev-button')); ?>
            <?php endif; ?>
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'btn btn-success')); ?>
        </div>
    </div>

</div>