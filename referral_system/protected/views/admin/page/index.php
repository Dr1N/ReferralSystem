<?php
/* @var $this PageController */
/* @var $model Page */

$this->menu=array(
	array('label'=>'List Page', 'url'=>array('index'),'active'=>true, 'linkOptions' => array('class' => 'btn btn-default')),
	array('label'=>'Create Page', 'url'=>array('create'), 'linkOptions' => array('class' => 'btn btn-warning')),
);
?>

<h1 class="text-info">Manage Pages</h1>

<?php $form=$this->beginWidget('CActiveForm'); ?>

<?php $this->widget('ext.jqGridView.jqGridView', array(
	'module' => 'admin/page',
	'elementId' => 'list',
	'buttonSearch' => 'grid-search',
	'contentId' => 'content',
	'parameters' => array(
		'sortname' => 't.id',
		'sortorder' => 'ASC',
		'caption' => 'Pages',
		'shrinkToFit' => true,
	),
	'columns' => array(
		jqCaption::caption($form->labelEx($model,'id')) => array(
			'name' => 't.id',
			'index' => 't.id',
			'width' => '4%',
			'searchtype' => 'integer',
			'align' => 'right'
		),
		/*jqCaption::caption($form->labelEx($model,'parent_id')) => array(
			'name' => 't.parent_id',
			'index' => 't.parent_id',
			'width' => '10%',
			'searchtype' => 'integer',
			'align' => 'right'
		),*/
		jqCaption::caption($form->labelEx($model,'page_url')) => array(
			'name' => 't.page_url',
			'index' => 't.page_url',
			'width' => '10%',
		),
		jqCaption::caption($form->labelEx($model,'link_name')) => array(
			'name' => 't.link_name',
			'index' => 't.link_name',
			'width' => '10%',
		),
		jqCaption::caption($form->labelEx($model,'type')) => array(
			'name' => 't.type',
			'index' => 't.type',
			'width' => '4%',
		),
		jqCaption::caption($form->labelEx($model,'access')) => array(
			'name' => 't.access',
			'index' => 't.access',
			'width' => '4%',
		),
		jqCaption::caption($form->labelEx($model,'sorting')) => array(
			'name' => 't.sorting',
			'index' => 't.sorting',
			'width' => '3%',
			'searchtype' => 'integer',
			'align' => 'right'
		),
		jqCaption::caption($form->labelEx($model,'visible_main')) => array(
			'name' => 't.visible_main',
			'index' => 't.visible_main',
			'width' => '5',
		),
		jqCaption::caption($form->labelEx($model,'visible_bottom')) => array(
			'name' => 't.visible_bottom',
			'index' => 't.visible_bottom',
			'width' => '5%',
		),
		jqCaption::caption($form->labelEx($model,'title')) => array(
			'name' => 't.title',
			'index' => 't.title',
			'width' => '7%',
		),
		jqCaption::caption($form->labelEx($model,'meta_keywords')) => array(
			'name' => 't.meta_keywords',
			'index' => 't.meta_keywords',
			'width' => '7%',
		),
		jqCaption::caption($form->labelEx($model,'meta_description')) => array(
			'name' => 't.meta_description',
			'index' => 't.meta_description',
			'width' => '7%',
		),
		jqCaption::caption($form->labelEx($model,'header')) => array(
			'name' => 't.header',
			'index' => 't.header',
			'width' => '5%',
		),
		jqCaption::caption($form->labelEx($model,'text_page')) => array(
			'name' => 't.text_page',
			'index' => 't.text_page',
			'width' => '24%',
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
