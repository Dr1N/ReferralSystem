<?php
/* @var $this PayoutController */
/* @var $model Payout */

$this->menu=array(
	array('label'=>'List Payout', 'url'=>array('index'), 'linkOptions' => array('class' => 'btn btn-primary')),
	//array('label'=>'Create Payout', 'url'=>array('create'), 'linkOptions' => array('class' => 'btn btn-success')),
	array('label'=>'Update Payout', 'url'=>array('update', 'id'=>$model->id), 'linkOptions' => array('class' => 'btn btn-success')),
	array('label'=>'Delete Payout', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?'), 'linkOptions' => array('class' => 'btn btn-danger')),
);
?>

<h1 class="text-info">View Payout #<?php echo $model->id; ?></h1>

<div class="table-responsive">
    <?php $this->widget('zii.widgets.CDetailView', array(
    	'data'=>$model,
    	'attributes'=>array(
    		'id',
    		'user.first_name',
    		'user.last_name',
    		'campaign.name',
    		'amount',
    		'end_amount',
    		'created_at',
    		'status',
    		'payout_way',
    		'details',
    	),
    	'htmlOptions' => array(
            'class' => 'table table-striped'
    	),
    )); ?>
</div>