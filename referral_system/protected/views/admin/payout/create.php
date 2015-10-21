<?php
/* @var $this PayoutController */
/* @var $model Payout */

$this->menu=array(
	array('label'=>'List Payout', 'url'=>array('index'), 'linkOptions' => array('class' => 'btn btn-primary')),
	array('label'=>'Create Payout', 'url'=>array('create'),'active'=>true, 'linkOptions' => array('class' => 'btn btn-default')),
);
?>

<h1 class="text-info">Create Payout</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>