<?php
/* @var $this PageController */
/* @var $model Page */

$this->menu=array(
	array('label'=>'List Page', 'url'=>array('index'), 'linkOptions' => array('class' => 'btn btn-primary')),
	array('label'=>'Create Page', 'url'=>array('create'),'active'=>true, 'linkOptions' => array('class' => 'btn btn-default')),
);
?>

<h1 class="text-info">Create Page</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>