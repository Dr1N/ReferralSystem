<?php
/* @var $this PayoutController */
/* @var $model Payout */

$this->menu=array(
	array('label'=>'List Payout', 'url'=>array('list'), 'linkOptions' => array('class' => 'btn btn-primary')),
	//array('label'=>'Create Payout', 'url'=>array('create'), 'linkOptions' => array('class' => 'btn btn-success')),
);
?>

<h1>Update Payout <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
