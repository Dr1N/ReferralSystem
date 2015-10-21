<?php
/* @var $this CampaignController */
/* @var $model Campaign */

if (User::hasSociety()):
    $this->menu=array(
    	array('label'=>'List Campaign', 'url'=>array('list'), 'linkOptions' => array('class' => 'btn btn-primary')),
    );
endif;
?>

<h1>Add Campaign</h1>

<?php if (User::hasSociety()): ?>
    <?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
<?php else: ?>
    <?php echo $this->renderPartial('../layouts/_noSociety'); ?>
<?php endif; ?>