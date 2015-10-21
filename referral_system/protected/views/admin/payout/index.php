<?php
/* @var $this PayoutController */
/* @var $model Payout */

$this->menu=array(
	array('label'=>'List Payout', 'url'=>array('index'),'active'=>true, 'linkOptions' => array('class' => 'btn btn-default')),
	//array('label'=>'Create Payout', 'url'=>array('create'), 'linkOptions' => array('class' => 'btn btn-warning')),
);
?>

<h1 class="text-info">Manage Payouts</h1>

<?php $form=$this->beginWidget('CActiveForm'); ?>

<?php $this->widget('ext.jqGridView.jqGridView', array(
	'module' => 'admin/payout',
	'elementId' => 'list',
	'buttonSearch' => 'grid-search',
	'contentId' => 'content',
	'parameters' => array(
		'sortname' => 't.created_at',
		'sortorder' => 'DESC',
		'caption' => 'Payouts',
		'shrinkToFit' => true,
	),
	'columns' => array(
		jqCaption::caption($form->labelEx($model,'id')) => array(
			'name' => 't.id',
			'index' => 't.id',
			'width' => '5%',
			'searchtype' => 'integer',
			'align' => 'right'
		),
		jqCaption::caption('User Email') => array(
			'name' => 'user.mail',
			'index' => 'user.mail',
			'width' => '10%',
		),
        jqCaption::caption('User Name') => array(
			'name' => 'user.first_name',
			'index' => 'user.first_name',
			'width' => '10%',
		),
        jqCaption::caption($form->labelEx($model,'campaign_id')) => array(
			'name' => 'campaign.name',
			'index' => 'campaign.name',
			'width' => '10%',
		),
		jqCaption::caption($form->labelEx($model,'amount')) => array(
			'name' => 't.amount',
			'index' => 't.amount',
			'width' => '8%',
			'searchtype' => 'number',
			'formatter' => 'currency', 
			'formatoptions'=> array('decimalPlaces'=> 2, 'prefix'=> '$'),
			'align' => 'right',
		),
		jqCaption::caption($form->labelEx($model,'end_amount')) => array(
			'name' => 't.end_amount',
			'index' => 't.end_amount',
			'width' => '10%',
			'searchtype' => 'number',
			'formatter' => 'currency', 
			'formatoptions'=> array('decimalPlaces'=> 2, 'prefix'=> '$'),
			'align' => 'right',
		),
		jqCaption::caption($form->labelEx($model,'created_at')) => array(
			'name' => 't.created_at',
			'index' => 't.created_at',
			'width' => '10%',
		),
		jqCaption::caption($form->labelEx($model,'status')) => array(
			'name' => 't.status',
			'index' => 't.status',
			'width' => '10%',
		),
		jqCaption::caption($form->labelEx($model,'payout_way')) => array(
			'name' => 't.payout_way',
			'index' => 't.payout_way',
			'width' => '10%',
		),
		jqCaption::caption($form->labelEx($model,'details')) => array(
			'name' => 't.details',
			'index' => 't.details',
			'width' => '10%',
		),
		'Options' => array(
			'name' => 'row.options',
			'index' => 'row.options',
			'width' => '7%',
			'align' => 'center',
			'sortable' => false,
			'search' => false,
		),
	),
)); ?>

<?php $this->endWidget(); ?>