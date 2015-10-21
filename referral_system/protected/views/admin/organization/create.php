<?php
/* @var $this OrganizationController */
/* @var $model Organization */

$this->menu=array(
	array('label'=>'List Organization', 'url'=>array('index'), 'linkOptions' => array('class' => 'btn btn-primary')),
	array('label'=>'Create Organization', 'url'=>array('create'),'active'=>true, 'linkOptions' => array('class' => 'btn btn-default')),
);
?>

<h1 class="text-info">Create Organization</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>