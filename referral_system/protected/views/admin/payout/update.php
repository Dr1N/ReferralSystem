<?php
/* @var $this PayoutController */
/* @var $model Payout */

$this->menu=array(
	array('label'=>'List Payout', 'url'=>array('index'), 'linkOptions' => array('class' => 'btn btn-primary')),
    array('label'=>'Update Payout', 'url'=>array('update', 'id'=>$model->id),'active'=>true, 'linkOptions' => array('class' => 'btn btn-default')),
	//array('label'=>'Create Payout', 'url'=>array('create'), 'linkOptions' => array('class' => 'btn btn-warning')),
	array('label'=>'Delete Payout', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this campaign?','class' => 'btn btn-danger')),
);
?>

<h1 class="text-info">Update Payout <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>