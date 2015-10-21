<?php
/* @var $this IndustryController */
/* @var $model Industry */

$this->menu=array(
	array('label'=>'List Industries', 'url'=>array('index'), 'linkOptions' => array('class' => 'btn btn-primary')),
    array('label'=>'Create Industry', 'url'=>array('create'), 'linkOptions' => array('class' => 'btn btn-success')),
    array('label'=>'Delete Industry', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this campaign?','class' => 'btn btn-danger')),
);
?>

<h1>Update Industry <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>