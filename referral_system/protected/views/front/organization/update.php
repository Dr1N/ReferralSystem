<?php
/* @var $this PageController */
/* @var $model Page */

$this->menu=array(
	array('label'=>'My Organization', 'url'=>array('profile'), 'linkOptions' => array('class' => 'btn btn-primary')),
);
?>

<h1>Update Organization</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>