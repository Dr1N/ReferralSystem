<?php if (!User::hasSociety()): ?>
    <?php $this->menu=array(
    	array('label'=>'Register Organization', 'url'=>array('organization/create'), 'linkOptions' => array('class' => 'btn btn-success')),
    ); ?>
<?php endif; ?>

<div class="alert alert-info">
    <p>
        You have to be registered in an organization to perform the action.<br />
		You can create a new organization or ask your colleague to send you an invitation to an existing organization.
    </p>
    <br />
	<p><?php echo CHtml::link('Register Organization',array('organization/create'), array('class' => 'btn btn-primary')); ?></p>
</div>