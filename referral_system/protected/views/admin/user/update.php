<?php
/* @var $this UserController */
/* @var $model User */

$this->menu=array(
	array('label'=>'List User', 'url'=>array('index'), 'linkOptions' => array('class' => 'btn btn-primary')),
	array('label'=>'Update User', 'url'=>array('update', 'id'=>$model->id),'active'=>true, 'linkOptions' => array('class' => 'btn btn-default')),
	array('label'=>'Change Password', 'url'=>array('password', 'id' => $model->id), 'linkOptions' => array('class' => 'btn btn-success')),
	array('label'=>'Create User', 'url'=>array('create'), 'linkOptions' => array('class' => 'btn btn-warning')),
    array('label'=>'Delete User', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?','class' => 'btn btn-danger')),
);
?>

<h1 class="text-info">Update User <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>