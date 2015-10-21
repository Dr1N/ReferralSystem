<?php
/* @var $this PurchaseController */
/* @var $model Purchase */

$this->menu=array(
	array('label'=>'List Purchase', 'url'=>array('index'),'active'=>true, 'linkOptions' => array('class' => 'btn btn-default')),
);
?>

<h1 class="text-info">Manage Purchases</h1>

<?php $form=$this->beginWidget('CActiveForm'); ?>

<?php $this->widget('ext.jqGridView.jqGridView', array(
	'module' => 'admin/purchase',
	'elementId' => 'list',
	'buttonSearch' => 'grid-search',
	'contentId' => 'content',
	'parameters' => array(
		'sortname' => 't.paid_at',
		'sortorder' => 'DESC',
		'caption' => 'Purchases',
		'shrinkToFit' => true,
	),
	'columns' => array(
		jqCaption::caption($form->labelEx($model,'id')) => array(
			'name' => 't.id',
			'index' => 't.id',
			'width' => '5%',
			'searchtype' => 'integer',
			'align' => 'right',
		),
        jqCaption::caption('Owner') => array(
			'name' => 'owner.first_name',
			'index' => 'owner.first_name',
			'width' => '20%',
		),
        jqCaption::caption($form->labelEx($model,'campaign_id')) => array(
			'name' => 't.campaign_id',
			'index' => 't.campaign_id',
			'width' => '25%',
		),
		jqCaption::caption($form->labelEx($model,'used_way')) => array(
			'name' => 't.used_way',
			'index' => 't.used_way',
			'width' => '10%',
		),
		jqCaption::caption($form->labelEx($model,'ip_address')) => array(
			'name' => 't.ip_address',
			'index' => 't.ip_address',
			'width' => '10%',
			'searchtype' => 'integer',
			'align' => 'right',
		),
		jqCaption::caption($form->labelEx($model,'amount')) => array(
			'name' => 't.amount',
			'index' => 't.amount',
			'width' => '10%',
			'searchtype' => 'number',
			'align' => 'right',
			'formatter' => 'currency', 
			'formatoptions'=> array('decimalPlaces'=> 2, 'prefix'=> '$'),
		),
		jqCaption::caption($form->labelEx($model,'paid_at')) => array(
			'name' => 't.paid_at',
			'index' => 't.paid_at',
			'width' => '10%',
		),
		'Options' => array(
			'name' => 'row.options',
			'index' => 'row.options',
			'width' => '10%',
			'align' => 'center',
			'sortable' => false,
			'search' => false,
		),
	),
)); ?>

<?php $this->endWidget(); ?>
