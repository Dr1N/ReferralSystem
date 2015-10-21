<?php
/* @var $this CountryController */
/* @var $model Country */

$this->menu=array(
	array('label'=>'List Country', 'url'=>array('index'), 'linkOptions' => array('class' => 'btn btn-primary')),
    array('label'=>'Update Country', 'url'=>array('update', 'id'=>$model->id),'active'=>true, 'linkOptions' => array('class' => 'btn btn-default')),
	//array('label'=>'Create Country', 'url'=>array('create'), 'linkOptions' => array('class' => 'btn btn-warning')),
);
?>

<h1 class="text-info">Update Country <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>