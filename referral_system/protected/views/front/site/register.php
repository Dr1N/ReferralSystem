<?php $this->pageTitle=Yii::app()->name; ?>

<h1>Welcome to <?php echo CHtml::encode(Yii::app()->name); ?></h1>

<div style="float:  left; width: 58%;">
    <h2><?php echo $page->link_name; ?></h2>
    	
    <?php echo $page->text_page; ?>
</div>

<div style="float: left; width: 38%; padding-left: 4%;">
    <?php if(Yii::app()->user->isGuest): ?>
        <?php echo $this->renderPartial('_registration', array('model'=>$model,'result'=>$result)); ?><strong></strong>
    <?php endif; ?>
</div>