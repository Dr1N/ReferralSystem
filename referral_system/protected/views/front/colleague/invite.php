<?php
/* @var $this UserController */
/* @var $model User */

if (User::hasSociety()):
    $this->menu=array(
    	array('label'=>'List User', 'url'=>array('list'), 'linkOptions' => array('class' => 'btn btn-primary')),
    );
endif;
?>

<h1>Invite User</h1>

<?php if (User::hasSociety()): ?>
    <?php echo $this->renderPartial('_formInvite', array('model'=>$model, 'result'=>$result)); ?>  
<?php else: ?>
    <?php echo $this->renderPartial('../layouts/_noSociety'); ?>
<?php endif; ?>