<?php
/* @var $this UserController */
/* @var $model User */

$this->menu=array(
	array('label'=>'List User', 'url'=>array('index'), 'linkOptions' => array('class' => 'btn btn-primary')),
	array('label'=>'Create User', 'url'=>array('create'),'active'=>true, 'linkOptions' => array('class' => 'btn btn-default')),
);
?>

<h1 class="text-info">Create User</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>