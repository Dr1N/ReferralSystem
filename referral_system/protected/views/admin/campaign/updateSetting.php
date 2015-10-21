<?php
/* @var $this CampaignController */
/* @var $model Campaign */

$this->menu=array(
	array('label'=>'List Campaign', 'url'=>array('index'), 'linkOptions' => array('class' => 'btn btn-primary')),
    array('label'=>'Update Campaign Data', 'url'=>array('update', 'id'=>$model->id), 'linkOptions' => array('class' => 'btn btn-success')),
	array('label'=>'Create Campaign', 'url'=>array('create'), 'linkOptions' => array('class' => 'btn btn-warning')),
);
?>

<h1 class="text-info">Update Campaign Setting <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_formSetting', array('model'=>$model)); ?>