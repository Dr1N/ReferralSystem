<?php
/* @var $this PageController */
/* @var $model Page */

$this->menu=array(
	array('label'=>'List Page', 'url'=>array('index'), 'linkOptions' => array('class' => 'btn btn-primary')),
    array('label'=>'Update Page', 'url'=>array('update', 'id'=>$model->id),'active'=>true, 'linkOptions' => array('class' => 'btn btn-default')),
	array('label'=>'Create Page', 'url'=>array('create'), 'linkOptions' => array('class' => 'btn btn-warning')),
    array('label'=>'Delete Page', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this campaign?','class' => 'btn btn-danger')),
);
?>

<h1 class="text-info">Update Page <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>