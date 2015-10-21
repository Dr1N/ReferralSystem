<?php
/* @var $this OrganizationController */
/* @var $model Organization */

$this->menu=array(
	array('label'=>'List Organization', 'url'=>array('index'), 'linkOptions' => array('class' => 'btn btn-primary')),
	array('label'=>'Create Organization', 'url'=>array('create'), 'linkOptions' => array('class' => 'btn btn-success')),
	array('label'=>'Update Organization', 'url'=>array('update', 'id'=>$model->id), 'linkOptions' => array('class' => 'btn btn-warning')),
	array('label'=>'Delete Organization', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?'), 'linkOptions' => array('class' => 'btn btn-danger')),
);
?>

<h1 class="text-info">View Organization #<?php echo $model->id; ?></h1>

<div class="table-responsive">
    <?php $this->widget('zii.widgets.CDetailView', array(
    	'data'=>$model,
    	'attributes'=>array(
    		'id',
    		'name',
    		'site_url',
    		'description',
    	),
    	'htmlOptions' => array(
            'class' => 'table table-striped'
    	),
    )); ?>
</div>