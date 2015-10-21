<div id="tab-restore">
    <div class="zag">
        <span class="regicon"></span>
        <h1  class="uppercase">Restore Password</h1>
        <p>Please fill out the following form with your e-mail:</p>
    </div>
    
    <?php $form=$this->beginWidget('CActiveForm', array(
    	'id'=>'restore-form',
        'action'=>Yii::app()->createUrl('user/restorePassword'),
        'htmlOptions'=>array('class'=>'form-horizontal'),
    )); ?>
    
        <div id="save-restore-status">
            <div id="status-fail" class="alert alert-danger hidden">Please fix the input errors.</div>
            <div id="status-success" class="alert alert-success hidden">A new password is generated and sent to your e-mail.</div>
        </div>
        
    	<div id="mail-row" class="form-group">
    		<?php echo $form->labelEx($model,'mail',array('class'=>'label-control')); ?>
    		<?php echo $form->textField($model,'mail',array('class'=>'input-control')); ?>
            <div id="mail-error-row" class="text-danger hidden"></div>
    	</div>
        
    	<div class="form-group btn-control">
    		<?php echo CHtml::button('Restore',array('id'=>'restore','class'=>'btn')); ?>
            <span class="tabs-navigation">
                <a class="italic space-small" href="#tab-login"><small>Login</small></a>
            </span>
    	</div>
    	
    <?php $this->endWidget(); ?>
</div>