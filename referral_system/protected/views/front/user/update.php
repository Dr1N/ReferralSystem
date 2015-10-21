<?php
/* @var $this UserController */
/* @var $model User */

$this->menu=array(
	array('label'=>'View My Profile', 'url'=>array('profile'), 'linkOptions' => array('class' => 'btn btn-success')),
	array('label'=>'Change Password', 'url'=>array('changePassword'), 'linkOptions' => array('class' => 'btn btn-primary'))
);
?>

<h1>Update My Profile</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>