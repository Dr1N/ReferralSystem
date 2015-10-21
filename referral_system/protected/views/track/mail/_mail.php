<div id="tab-mail">
    <?php $this->renderPartial('../layouts/_left_menu'); ?>
    <div class="right-conte">
        <div class="zaglogin">
            <span class="prof-rew-icon"></span>
            <h1 class="uppercase">Send an Email</h1>
            <p>Email as many friends as you like.</p>
        </div>
        
        <div id="send-email">
            <?php $form=$this->beginWidget('CActiveForm', array(
            	'id'=>'send-email-form',
            	'enableAjaxValidation'=>false,
                'htmlOptions'=>array('class'=>'form-horizontal'),
            )); ?>
            
                <div id="send-mail-status">
                    <div id="status-fail" class="alert alert-danger hidden">Please fix the input errors.</div>
                    <div id="status-success" class="alert alert-success hidden">Mail was sent.</div>
                </div>
                
                <div>
                    <strong>From: <?=$user->mail?></strong>
                </div>
                
                <div id="mail-row">
                    <?php echo CHtml::label('Enter some e-mail addresses (separate emails with a comma & space)', 'mails'); ?>
                    <?php echo CHtml::textArea('mails'); ?>
                    <div id="mail-error-row" class="text-danger hidden"></div>
                </div>
                
                <span class="tabs-navigation">
                    <p class="left italic"><a href="#tab-mail-list"><small>Sent email list</small></a></p>
                    <p class="right italic"><a href="#tab-mail-import"><small>Import email addresses</small></a></p>
                    <br /><br />
                </span>
                
                <div class="clear"></div> 

                <div id="message-row">
                    <?php echo CHtml::label('Use this message or write your own','message'); ?>
                    <?php echo CHtml::textArea('message', $campaign->setting->message_mail); ?>
                    <div id="message-error-row" class="text-danger hidden"></div>
                </div>
                
                <div>
                    <?php echo CHtml::ajaxSubmitButton('Send Email', 'track/mail/sendMail', 
                		array(
                            'type' => 'POST',
                            'dataType' => 'JSON',
                            'success' => 'function (response) { MailHelper.sendEmail(response); }',
                        ),
                        array(
                            'id' => 'send-mail-button',
                            'name' => 'send-mail-button',
                            'class' => 'btn',
                        )
                	);?>
                </div>
                
            <?php $this->endWidget(); ?>
        </div>
    </div>
</div>

<div id="tab-mail-list">
    <?php $this->renderPartial('../layouts/_left_menu'); ?>
    <div class="right-conte">
        <div class="zaglogin">
            <span class="prof-rew-icon"></span>
            <h1 class="uppercase">Email List</h1>
            <p>List of emails used for sending the invitations</p>
        </div>
        <img src="./images/loading.gif" class="loader" />
        <div class="content-block"></div>
    </div>
</div>

<div id="tab-mail-import">
    <?php $this->renderPartial('../layouts/_left_menu'); ?>
    <div class="right-conte">
        <div class="zaglogin">
            <span class="prof-rew-icon"></span>
            <h1 class="uppercase">Import Emails</h1>
            <p>You can use social networks to import emails</p>
        </div>
        <img src="./images/loading.gif" class="loader" />
        <div class="content-block"></div>
    </div>
</div>