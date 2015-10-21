<?php
/* @var $this CountryController */
/* @var $model Country */

$this->menu=array(
	array('label'=>'List Country', 'url'=>array('index'),'active'=>true, 'linkOptions' => array('class' => 'btn btn-default')),
	//array('label'=>'Create Country', 'url'=>array('create'), 'linkOptions' => array('class' => 'btn btn-warning')),
);
?>

<h1 class="text-info">Manage Contries</h1>

<?php $form=$this->beginWidget('CActiveForm'); ?>

<?php $this->widget('ext.jqGridView.jqGridView', array(
	'module' => 'admin/country',
	'elementId' => 'list',
	'buttonSearch' => 'grid-search',
	'contentId' => 'content',
	'parameters' => array(
		'sortname' => 't.id',
		'sortorder' => 'ASC',
		'caption' => 'Countries',
		'shrinkToFit' => true,
	),
	'columns' => array(
		jqCaption::caption($form->labelEx($model,'id')) => array(
			'name' => 't.id',
			'index' => 't.id',
			'width' => '10%',
			'searchtype' => 'integer',
			'align' => 'right',
		),
		jqCaption::caption($form->labelEx($model,'name')) => array(
			'name' => 't.name',
			'index' => 't.name',
			'width' => '40%',
		),
		jqCaption::caption($form->labelEx($model,'phone_code')) => array(
			'name' => 't.phone_code',
			'index' => 't.phone_code',
			'width' => '40%',
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