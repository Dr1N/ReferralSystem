<?php
/* @var $this CampaignController */
/* @var $model Campaign */

$this->menu=array(
	array('label'=>'List Campaign', 'url'=>array('index'), 'linkOptions' => array('class' => 'btn btn-primary')),
    array('label'=>'Update Campaign', 'url'=>array('update', 'id'=>$model->id), 'linkOptions' => array('class' => 'btn btn-default')),
	array('label'=>'Create Campaign', 'url'=>array('create'), 'linkOptions' => array('class' => 'btn btn-warning')),
    array('label'=>'Delete Campaign', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?','class' => 'btn btn-danger')),
);
?>

<h1 class="text-info">Update Campaign <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'link'=>$link)); ?>