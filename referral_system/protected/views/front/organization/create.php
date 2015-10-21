<?php
/* @var $this OrganizationController */
/* @var $model Organization */

$this->menu=array(
	array('label'=>'My Organization', 'url'=>array('profile'), 'linkOptions' => array('class' => 'btn btn-primary')),
);
?>

<h1>Create Organization</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>