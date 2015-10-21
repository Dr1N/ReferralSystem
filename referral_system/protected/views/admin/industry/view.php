<?php
/* @var $this IndustryController */
/* @var $model Industry */

$this->menu=array(
	array('label'=>'List Industries', 'url'=>array('index'), 'linkOptions' => array('class' => 'btn btn-primary')),
	array('label'=>'Update Industry', 'url'=>array('update', 'id'=>$model->id), 'linkOptions' => array('class' => 'btn btn-success')),
	array('label'=>'Create Industry', 'url'=>array('create'), 'linkOptions' => array('class' => 'btn btn-success')),
);
?>

<h1>View Industry #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
	),
	'htmlOptions' => array(
        'class' => 'table table-striped'
    ),
)); ?>
