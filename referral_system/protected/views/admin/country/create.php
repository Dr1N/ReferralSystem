<?php
/* @var $this CountryController */
/* @var $model Country */

$this->menu=array(
	array('label'=>'List Country', 'url'=>array('index'), 'linkOptions' => array('class' => 'btn btn-primary')),
);
?>

<h1 class="text-info">Create Country</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>