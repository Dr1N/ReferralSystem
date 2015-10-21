<div id="tab-facebook">
    <?php $this->renderPartial('../layouts/_left_menu'); ?>
    <div class="right-conte">
        <div class="zaglogin">
            <span class="prof-rew-icon"></span>
            <h1 class="uppercase">Share on Facebook</h1>
            <p>Tell your Facebook friends about the deal.</p>
        </div>

        <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'send-facebook-form',
            'enableAjaxValidation'=>false,
            'htmlOptions'=>array('class'=>'form-horizontal'),
        )); ?>

        <div id="send-facebook-status">
            <div id="status-fail" class="alert alert-danger hidden">Sending error</div>
            <div id="status-success" class="alert alert-success hidden">Message was sent</div>
            
        </div>

        <div>
            <?php echo CHtml::label('Use this message or write your own','facebook-text'); ?>
            <?php echo CHtml::textArea('facebook-text', $campaign->setting->message_facebook); ?>
        </div>

        <div id="facebook-errors" class="text-danger hidden"></div>
        
        <div class="left">
            <?php echo CHtml::ajaxSubmitButton('Share Now', 'track/facebook/sendFacebook', 
                array(
                    'type' => 'POST',
                    'dataType' => 'JSON',
                    'success' => 'function (response) { FacebookHelper.sendFacebook(response); }',
                ),
                array(
                    'id' => 'send-facebook-button',
                    'name' => 'send-facebook-button',
                    'class' => 'btn',
                )
            );?>
        </div>

        <?php $this->endWidget(); ?>

    </div>
</div>