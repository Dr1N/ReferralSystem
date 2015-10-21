<?php
/* @var $this UserController */
/* @var $model User */

$this->menu=array(
	array('label'=>'List User', 'url'=>array('index'),'active'=>true, 'linkOptions' => array('class' => 'btn btn-default')),
	array('label'=>'Create User', 'url'=>array('create'), 'linkOptions' => array('class' => 'btn btn-warning')),
);
?>

<h1 class="text-info">Manage Users</h1>

<?php $form=$this->beginWidget('CActiveForm'); ?>

<?php $this->widget('ext.jqGridView.jqGridView', array(
	'module' => 'admin/user',
	'elementId' => 'list',
	'buttonSearch' => 'grid-search',
	'contentId' => 'content',
	'parameters' => array(
		'sortname' => 't.id',
		'sortorder' => 'DESC',
		'caption' => 'Users',
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
		jqCaption::caption($form->labelEx($model,'organization_id')) => array(
			'name' => 'organization.name',
			'index' => 'organization.name',
			'width' => '8%',
		),
		jqCaption::caption($form->labelEx($model,'mail')) => array(
			'name' => 't.mail',
			'index' => 't.mail',
			'width' => '10%',
		),
		jqCaption::caption($form->labelEx($model,'first_name')) => array(
			'name' => 't.first_name',
			'index' => 't.first_name',
			'width' => '8%',
		),
		jqCaption::caption($form->labelEx($model,'last_name')) => array(
			'name' => 't.last_name',
			'index' => 't.last_name',
			'width' => '8%',
		),
		jqCaption::caption($form->labelEx($model,'country_id')) => array(
			'name' => 'country.name',
			'index' => 'country.name',
			'width' => '5%',
		),
		jqCaption::caption($form->labelEx($model,'city')) => array(
			'name' => 't.city',
			'index' => 't.city',
			'width' => '5%',
		),
		jqCaption::caption($form->labelEx($model,'address')) => array(
			'name' => 't.address',
			'index' => 't.address',
			'width' => '9%',
		),
		jqCaption::caption($form->labelEx($model,'phone')) => array(
			'name' => 't.phone',
			'index' => 't.phone',
			'width' => '7%',
		),
		jqCaption::caption($form->labelEx($model,'birthday')) => array(
			'name' => 't.birthday',
			'index' => 't.birthday',
			'width' => '5%',
		),
		jqCaption::caption($form->labelEx($model,'registered_at')) => array(
			'name' => 't.registered_at',
			'index' => 't.registered_at',
			'width' => '8%',
		),
		jqCaption::caption($form->labelEx($model,'last_login_at')) => array(
			'name' => 't.last_login_at',
			'index' => 't.last_login_at',
			'width' => '8%',
		),
		jqCaption::caption($form->labelEx($model,'type')) => array(
			'name' => 't.type',
			'index' => 't.type',
			'width' => '3%',
		),
		jqCaption::caption($form->labelEx($model,'image')) => array(
			'name' => 't.image',
			'index' => 't.image',
			'width' => '3%',
			'align' => 'center',
			'sortable' => false,
			'search' => false,
		),
		jqCaption::caption($form->labelEx($model,'verified')) => array(
			'name' => 't.verified',
			'index' => 't.verified',
			'width' => '3%',
		),
		jqCaption::caption($form->labelEx($model,'active')) => array(
			'name' => 't.active',
			'index' => 't.active',
			'width' => '3%',
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
