<?php
/* @var $this CampaignController */
/* @var $model Campaign */

$this->menu=array(
	array('label'=>'List Campaign', 'url'=>array('list'), 'linkOptions' => array('class' => 'btn btn-primary')),
    //array('label'=>'Update Campaign Data', 'url'=>array('update', 'id'=>$model->id), 'linkOptions' => array('class' => 'btn btn-info')),
    array('label'=>'Campaign Users', 'url'=>array('users', 'id'=>$model->id), 'linkOptions' => array('class' => 'btn btn-warning')),
	array('label'=>'Add Campaign', 'url'=>array('create'), 'linkOptions' => array('class' => 'btn btn-success')),
	array('label'=>'Delete Campaign', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this campaign?','class' => 'btn btn-danger')),
);
?>

<h1>Update Campaign Setting <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_formSetting', array('model'=>$model)); ?>