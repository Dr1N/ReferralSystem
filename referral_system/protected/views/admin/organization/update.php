<?php
/* @var $this OrganizationController */
/* @var $model Organization */

$this->menu=array(
	array('label'=>'List Organization', 'url'=>array('index'), 'linkOptions' => array('class' => 'btn btn-primary')),
    array('label'=>'Update Organization', 'url'=>array('update', 'id'=>$model->id),'active'=>true, 'linkOptions' => array('class' => 'btn btn-default')),
	array('label'=>'Create Organization', 'url'=>array('create'), 'linkOptions' => array('class' => 'btn btn-warning')),
    array('label'=>'Delete Organization', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?','class' => 'btn btn-danger')),
);
?>

<h1 class="text-info">Update Organization <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>