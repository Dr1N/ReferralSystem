<div id="tab-twitter">
    <?php $this->renderPartial('../layouts/_left_menu'); ?>
    <div class="right-conte">
        <div class="zaglogin">
            <span class="prof-rew-icon"></span>
            <h1 class="uppercase">Share on Twitter</h1>
            <p>Share the deal with your Twitter followers</p>
        </div>
        
        <?php $form=$this->beginWidget('CActiveForm', array(
        	'id'=>'send-twitter-form',
        	'enableAjaxValidation'=>false,
            'htmlOptions'=>array('class'=>'form-horizontal'),
        )); ?>
        
        	<div id="send-twitter-status">
            	<div id="status-fail" class="alert alert-danger hidden">Sending tweet error</div>
            	<div id="status-success" class="alert alert-success hidden">Tweet was sent</div>
        	</div>
            
            <div>
            	<?php echo CHtml::label('Use this tweet or write your own','tweet-text'); ?>
            	<?php echo CHtml::textArea('tweet-text', $campaign->setting->message_twitter); ?>
            </div>

            <div id="twitter-error-message" class="text-danger hidden"></div>

            <div class="left">
            	<?php echo CHtml::ajaxSubmitButton('Tweet', 'track/twitter/sendTweet', 
            		array(
                        'type' => 'POST',
                        'dataType' => 'JSON',
                        'success' => 'function (response) { TwitterHelper.sendTweet(response); }',
                    ),
                    array(
                        'id' => 'send-twitter-button',
                        'name' => 'send-twitter-button',
                        'class' => 'btn',
                    )
            	);?>
            </div>
            
            <div class="right">
            	<small><span id="chars-left"></span> characters left</small>
            </div>
            
        <?php $this->endWidget(); ?>
    </div>
</div>