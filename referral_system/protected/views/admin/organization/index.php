<?php
/* @var $this OrganizationController */
/* @var $model Organization */

$this->menu=array(
	array('label'=>'List Organization', 'url'=>array('index'),'active'=>true, 'linkOptions' => array('class' => 'btn btn-default')),
	array('label'=>'Create Organization', 'url'=>array('create'), 'linkOptions' => array('class' => 'btn btn-warning')),
);
?>

<h1 class="text-info">Manage Organizations</h1>

<?php $form=$this->beginWidget('CActiveForm'); ?>

<?php $this->widget('ext.jqGridView.jqGridView', array(
	'module' => 'admin/organization',
	'elementId' => 'list',
	'buttonSearch' => 'grid-search',
	'contentId' => 'content',
	'parameters' => array(
		'sortname' => 't.name',
		'sortorder' => 'ASC',
		'caption' => 'Organizations',
		'shrinkToFit' => true,
	),
	'columns' => array(
		jqCaption::caption($form->labelEx($model,'id')) => array(
			'name' => 't.id',
			'index' => 't.id',
			'width' => '3%',
			'searchtype' => 'integer',
			'align' => 'right',
		),
		jqCaption::caption($form->labelEx($model,'name')) => array(
			'name' => 't.name',
			'index' => 't.name',
			'width' => '10%',
		),
		jqCaption::caption($form->labelEx($model,'site_url')) => array(
			'name' => 't.site_url',
			'index' => 't.site_url',
			'width' => '12%',
		),
		jqCaption::caption($form->labelEx($model,'country_id')) => array(
			'name' => 'country.name',
			'index' => 'country.name',
			'width' => '8%',
		),
		jqCaption::caption($form->labelEx($model,'postal_code')) => array(
			'name' => 't.postal_code',
			'index' => 't.postal_code',
			'width' => '8%',
		),
		jqCaption::caption($form->labelEx($model,'state')) => array(
			'name' => 't.state',
			'index' => 't.state',
			'width' => '8%',
		),
		jqCaption::caption($form->labelEx($model,'city')) => array(
			'name' => 't.city',
			'index' => 't.city',
			'width' => '8%',
		),
		jqCaption::caption($form->labelEx($model,'address_line_1')) => array(
			'name' => 't.address_line_1',
			'index' => 't.address_line_1',
			'width' => '10%',
		),
		jqCaption::caption($form->labelEx($model,'address_line_2')) => array(
			'name' => 't.address_line_1',
			'index' => 't.address_line_1',
			'width' => '10%',
		),
		jqCaption::caption($form->labelEx($model,'industry_id')) => array(
			'name' => 'industry.name',
			'index' => 'industry.name',
			'width' => '8%',
		),
		jqCaption::caption($form->labelEx($model,'description')) => array(
			'name' => 't.description',
			'index' => 't.description',
			'width' => '10%',
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
