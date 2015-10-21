<?php
/* @var $this CampaignController */
/* @var $model Campaign */

$this->menu=array(
	array('label'=>'List Campaign', 'url'=>array('index'),'active'=>true, 'linkOptions' => array('class' => 'btn btn-default')),
	array('label'=>'Create Campaign', 'url'=>array('create'), 'linkOptions' => array('class' => 'btn btn-warning')),
);
?>

<h1 class="text-info">Manage Campaigns</h1>

<?php $form=$this->beginWidget('CActiveForm'); ?>

<?php $this->widget('ext.jqGridView.jqGridView', array(
	'module' => 'admin/campaign',
	'elementId' => 'list',
	'buttonSearch' => 'grid-search',
	'contentId' => 'content',
	'parameters' => array(
		'sortname' => 't.name',
		'sortorder' => 'ASC',
		'caption' => 'Campaigns',
		'shrinkToFit' => true,
	),
	'columns' => array(
		jqCaption::caption($form->labelEx($model,'id')) => array(
			'name' => 't.id',
			'index' => 't.id',
			'width' => '2%',
			'searchtype' => 'integer',
			'align' => 'right',
		),
		jqCaption::caption($form->labelEx($model,'name')) => array(
			'name' => 't.name',
			'index' => 't.name',
			'width' => '8%',
		),
		jqCaption::caption($form->labelEx($model,'alias')) => array(
			'name' => 't.alias',
			'index' => 't.alias',
			'width' => '8%',
		),
        jqCaption::caption($form->labelEx($model,'organization_id')) => array(
			'name' => 'organization.name',
			'index' => 'organization.name',
			'width' => '5%',
		),
        jqCaption::caption($form->labelEx($model,'user_id')) => array(
			'name' => 'user.mail',
			'index' => 'user.mail',
			'width' => '8%',
		),
        jqCaption::caption('Creator Name') => array(
			'name' => 'user.first_name',
			'index' => 'user.first_name',
			'width' => '5%',
		),
       	jqCaption::caption($form->labelEx($model,'site_url')) => array(
			'name' => 't.site_url',
			'index' => 't.site_url',
			'width' => '7%',
		),
		jqCaption::caption($form->labelEx($model,'image')) => array(
			'name' => 't.image',
			'index' => 't.image',
			'width' => '3%',
			'align' => 'center',
			'sortable' => false,
			'search' => false,
		),
		jqCaption::caption($form->labelEx($model,'active')) => array(
			'name' => 't.active',
			'index' => 't.active',
			'width' => '3%',
		),
		jqCaption::caption($form->labelEx($model,'setting.referral_prize')) => array(
			'name' => 'setting.referral_prize',
			'index' => 'setting.referral_prize',
			'searchtype' => 'number',
			'formatter' => 'currency',
			'formatoptions'=> array('decimalPlaces'=> 2, 'prefix'=> '$'),
			'align' => 'right',
			'width' => '7%',
		),
		jqCaption::caption($form->labelEx($model,'setting.recipient_prize')) => array(
			'name' => 'setting.recipient_prize',
			'index' => 'setting.recipient_prize',
			'searchtype' => 'number',
			'formatter' => 'currency', 
			'formatoptions'=> array('decimalPlaces'=> 2, 'prefix'=> '$'),
			'align' => 'right',
			'width' => '7%',
		),
		jqCaption::caption($form->labelEx($model,'setting.min_payout')) => array(
			'name' => 'setting.min_payout',
			'index' => 'setting.min_payout',
			'searchtype' => 'number',
			'formatter' => 'currency', 
			'formatoptions'=> array('decimalPlaces'=> 2, 'prefix'=> '$'),
			'align' => 'right',
			'width' => '5%',
		),
		'Clicks' => array(
			'name' => 'row.options',
			'index' => 'row.options',
			'align' => 'right',
			'width' => '2%',
			'sortable' => false,
    		'search' => false,
		),
		'Purchases' => array(
			'name' => 'row.options',
			'index' => 'row.options',
			'align' => 'right',
			'width' => '4%',
			'sortable' => false,
    		'search' => false,
		),
		'Payouts($)' => array(
			'name' => 'row.options',
			'index' => 'row.options',
			'align' => 'right',
			'formatter' => 'currency',
			'formatoptions'=> array('decimalPlaces'=> 2, 'prefix'=> '$'),
            'width' => '4%',
			'sortable' => false,
    		'search' => false,
		),
		jqCaption::caption($form->labelEx($model,'setting.enable_mail')) => array(
			'name' => 'setting.enable_mail',
			'index' => 'setting.enable_mail',
			'width' => '5%',
		),
		jqCaption::caption($form->labelEx($model,'setting.enable_facebook')) => array(
			'name' => 'setting.enable_facebook',
			'index' => 'setting.enable_facebook',
			'width' => '5%',
		),
		jqCaption::caption($form->labelEx($model,'setting.enable_twitter')) => array(
			'name' => 'setting.enable_twitter',
			'index' => 'setting.enable_twitter',
			'width' => '5%',
		),
		jqCaption::caption($form->labelEx($model,'setting.enable_link')) => array(
			'name' => 'setting.enable_link',
			'index' => 'setting.enable_link',
			'width' => '5%',
		),
		'Options' => array(
			'name' => 'row.options',
			'index' => 'row.options',
			'width' => '5%',
			'align' => 'center',
			'sortable' => false,
			'search' => false,
		),
	),
)); ?>

<?php $this->endWidget(); ?>
