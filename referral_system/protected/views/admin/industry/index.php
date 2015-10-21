<?php
/* @var $this IndustryController */
/* @var $dataProvider CActiveDataProvider */

$this->menu=array(
	array('label'=>'List Industries', 'url'=>array('index'),'active'=>true, 'linkOptions' => array('class' => 'btn btn-default')),
	array('label'=>'Create Industry', 'url'=>array('create'), 'linkOptions' => array('class' => 'btn btn-success')),
);
?>

<h1 class="text-info">Industries</h1>

<?php $form=$this->beginWidget('CActiveForm'); ?>

<?php $this->widget('ext.jqGridView.jqGridView', array(
	'module' => 'admin/industry',
	'elementId' => 'list',
	'buttonSearch' => 'grid-search',
	'contentId' => 'content',
	'parameters' => array(
		'sortname' => 't.id',
		'sortorder' => 'ASC',
		'caption' => 'Industries',
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
			'width' => '80%',
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