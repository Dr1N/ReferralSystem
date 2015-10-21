<div id="email-list-block" class="grid-view">

    <span class="tabs-navigation">
        <p class="left italic"><a href="#tab-mail"><small>Send an email</small></a></p>
        <?php if (!empty($model)): ?>
            <p class="right italic"><a href="#tab-mail" class="mail-to-selected"><small>Send to selected emails</small></a></p>
        <?php endif; ?>
        <br /><br />
    </span>

    <?php if (empty($model)): ?>
        
        <div class="alert alert-info">
            The mails have not been sent.
        </div>
        
    <?php else: ?>
    
        <?php $form=$this->beginWidget('CActiveForm'); ?>
        
        <?php $this->widget('ext.jqGridView.jqGridView', 
        	array(
        		'module' => 'track/mail',
        		'elementId' => 'mailList',
        		'buttonSearch' => 'grid-search',
        		'contentId' => 'email-list-block',
        		'parameters' => array(
                    'url' => 'track/mail/mailGrid',
        			'sortname' => 't.mail',
        			'sortorder' => 'DESC',
        			'caption' => 'Mails',
        			'shrinkToFit' => true,
                    'height' => 190,
                ),
        		'columns' => array(
        			jqCaption::caption($form->labelEx($model,'mail')) => array(
        				'name' => 't.mail',
        				'index' => 't.mail',
        				'width' => '37%',
        			),
        	        jqCaption::caption($form->labelEx($model,'sent_at')) => array(
        				'name' => 't.sent_at',
        				'index' => 't.sent_at',
        				'width' => '24%',
        			),
        	        jqCaption::caption($form->labelEx($model,'status')) => array(
        				'name' => 't.status',
        				'index' => 't.status',
        				'width' => '13%',
        			),
        			jqCaption::caption($form->labelEx($model,'added_type')) => array(
        				'name' => 't.added_type',
        				'index' => 't.added_type',
        				'width' => '16%',
        			),
        			'Select' => array(
        				'name' => 'row.options',
        				'index' => 'row.options',
        				'width' => '10%',
        				'align' => 'center',
        				'sortable' => false,
        				'search' => false,
        			),
        		),
        	)
         ); ?>
        
        <?php $this->endWidget(); ?>
    <?php endif; ?>

</div>