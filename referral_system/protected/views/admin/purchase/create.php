<?php
/* @var $this PurchaseController */
/* @var $model Purchase */

$this->menu=array(
	array('label'=>'List Purchase', 'url'=>array('index'), 'linkOptions' => array('class' => 'btn btn-primary')),
	array('label'=>'Create Purchase', 'url'=>array('create'),'active'=>true, 'linkOptions' => array('class' => 'btn btn-default')),
);
?>

<h1 class="text-info">Create Purchase</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>