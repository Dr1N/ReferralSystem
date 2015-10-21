<?php
/* @var $this PurchaseController */
/* @var $model Purchase */

$this->menu=array(
	array('label'=>'List Purchase', 'url'=>array('index'), 'linkOptions' => array('class' => 'btn btn-primary')),
    array('label'=>'Update Purchase', 'url'=>array('update', 'id'=>$model->id),'active'=>true, 'linkOptions' => array('class' => 'btn btn-default')),
    array('label'=>'Delete Payout', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this campaign?','class' => 'btn btn-danger')),
);
?>

<h1 class="text-info">Update Purchase <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>