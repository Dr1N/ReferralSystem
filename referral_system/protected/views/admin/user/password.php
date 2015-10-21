<?php
/* @var $this UserController */
/* @var $model User */

$this->menu=array(
	array('label'=>'List User', 'url'=>array('index'), 'linkOptions' => array('class' => 'btn btn-primary')),
	array('label'=>'Update User', 'url'=>array('update', 'id'=>$id), 'linkOptions' => array('class' => 'btn btn-success')),
	array('label'=>'Change Password', 'url'=>array('password', 'id'=>$id), 'active'=>true, 'linkOptions' => array('class' => 'btn btn-default')),
	array('label'=>'Create User', 'url'=>array('create'), 'linkOptions' => array('class' => 'btn btn-warning')),
    array('label'=>'Delete User', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$id),'confirm'=>'Are you sure you want to delete this item?','class' => 'btn btn-danger')),
);
?>

<h1 class="text-info">Change Password</h1>

<?php echo $this->renderPartial('_formPassword', array('model'=>$model)); ?>