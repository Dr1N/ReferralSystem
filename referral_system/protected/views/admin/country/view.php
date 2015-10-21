<?php
/* @var $this CountryController */
/* @var $model Country */

$this->menu=array(
	array('label'=>'List Country', 'url'=>array('index'), 'linkOptions' => array('class' => 'btn btn-primary')),
	//array('label'=>'Create Country', 'url'=>array('create'), 'linkOptions' => array('class' => 'btn btn-success')),
	array('label'=>'Update Country', 'url'=>array('update', 'id'=>$model->id), 'linkOptions' => array('class' => 'btn btn-success')),
	//array('label'=>'Delete Country', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?'), 'linkOptions' => array('class' => 'btn btn-danger')),
);
?>

<h1 class="text-info">View Country #<?php echo $model->id; ?></h1>

<div class="table-responsive">
    <?php $this->widget('zii.widgets.CDetailView', array(
    	'data'=>$model,
    	'attributes'=>array(
    		'id',
    		'name',
    		'phone_code',
    	),
    	'htmlOptions' => array(
            'class' => 'table table-striped'
    	),
    )); ?>
</div>