<?php
/* @var $this UserController */
/* @var $model User */

$this->menu=array(
	array('label'=>'View My Profile', 'url'=>array('profile'), 'linkOptions' => array('class' => 'btn btn-success')),
	array('label'=>'Update Profile', 'url'=>array('update'), 'linkOptions' => array('class' => 'btn btn-primary'))
);
?>

<h1>Change My Password</h1>

<?php echo $this->renderPartial('_formChangePassword', array('model'=>$model)); ?>