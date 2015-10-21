<?php
/* @var $this PurchaseController */
/* @var $model Purchase */

$this->menu=array(
	array('label'=>'List Purchase', 'url'=>array('index'), 'linkOptions' => array('class' => 'btn btn-primary')),
	//array('label'=>'Create Purchase', 'url'=>array('create'), 'linkOptions' => array('class' => 'btn btn-success')),
	array('label'=>'Update Purchase', 'url'=>array('update', 'id'=>$model->id), 'linkOptions' => array('class' => 'btn btn-success')),
	array('label'=>'Delete Purchase', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?'), 'linkOptions' => array('class' => 'btn btn-danger')),
);
?>

<h1 class="text-info">View Purchase #<?php echo $model->id; ?></h1>

<div class="table-responsive">
    <?php $this->widget('zii.widgets.CDetailView', array(
    	'data'=>$model,
    	'attributes'=>array(
    		'id',
    		'owner_id',
    		'campaign_id',
    		'used_way',
    		'ip_address',
    		'amount',
    		'paid_at',
    	),
    	'htmlOptions' => array(
            'class' => 'table table-striped'
    	),
    )); ?>
</div>