<?php
/* @var $this CampaignController */
/* @var $model Campaign */

$this->menu=array(
	array('label'=>'List Campaign', 'url'=>array('index'), 'linkOptions' => array('class' => 'btn btn-primary')),
	array('label'=>'Create Campaign', 'url'=>array('create'),'active'=>true, 'linkOptions' => array('class' => 'btn btn-default')),
);
?>

<h1 class="text-info">Create Campaign</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>