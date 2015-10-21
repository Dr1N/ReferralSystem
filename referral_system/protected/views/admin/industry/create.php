<?php
/* @var $this IndustryController */
/* @var $model Industry */

$this->menu=array(
	array('label'=>'List Industries', 'url'=>array('index'), 'linkOptions' => array('class' => 'btn btn-primary')),
);
?>

<h1>Create Industry</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>