<?php
/* @var $this CampaignController */
/* @var $model Campaign */

$this->menu=array(
	array('label'=>'List Campaign', 'url'=>array('index'), 'linkOptions' => array('class' => 'btn btn-primary')),
	array('label'=>'Create Campaign', 'url'=>array('create'), 'linkOptions' => array('class' => 'btn btn-success')),
	array('label'=>'Update Campaign', 'url'=>array('update', 'id'=>$model->id), 'linkOptions' => array('class' => 'btn btn-success')),
	array('label'=>'Delete Campaign', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?'), 'linkOptions' => array('class' => 'btn btn-danger')),
);
?>

<h1 class="text-info">View Campaign #<?php echo $model->id; ?></h1>

<div class="table-responsive">
    <?php $this->widget('zii.widgets.CDetailView', array(
    	'data'=>$model,
    	'attributes'=>array(
    		'id',
    		'name',
    		'alias',
    		'site_url',
    		'active',
    	),
    	'htmlOptions' => array(
            'class' => 'table table-striped'
    	),
    )); ?>
</div>