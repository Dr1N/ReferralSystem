<?php
/* @var $this UserController */
/* @var $model User */

if (User::hasSociety()):
    $this->menu=array(
    	array('label'=>'Invite User', 'url'=>array('#'), 'linkOptions' => array('class' => 'btn btn-success', 'data-toggle' => 'modal', 'data-target'=>'#invite-modal')),
    );
endif;
?>

<h1>Manage Colleague</h1>

<?php if (User::hasSociety()): ?>

    <?php $form=$this->beginWidget('CActiveForm'); ?>
    
    <?php $this->widget('ext.jqGridView.jqGridView', array(
    	'module' => 'colleague',
    	'elementId' => 'list',
    	'buttonSearch' => 'grid-search',
    	'contentId' => 'content',
    	'parameters' => array(
    		'sortname' => 't.id',
    		'sortorder' => 'DESC',
    		'caption' => 'Colleagues',
    		'shrinkToFit' => true,
    	),
    	'columns' => array(
    		jqCaption::caption($form->labelEx($model,'id')) => array(
    			'name' => 't.id',
    			'index' => 't.id',
    			'width' => '4%',
    			'searchtype' => 'integer',
    			'align' => 'right',
    		),
    		jqCaption::caption($form->labelEx($model,'mail')) => array(
    			'name' => 't.mail',
    			'index' => 't.mail',
    			'width' => '10%',
    		),
            jqCaption::caption('User Name') => array(
    			'name' => 't.first_name',
    			'index' => 't.first_name',
    			'width' => '10%',
    		),
    		jqCaption::caption($form->labelEx($model,'country_id')) => array(
    			'name' => 'country.name',
    			'index' => 'country.name',
    			'width' => '6%',
    		),
    		jqCaption::caption($form->labelEx($model,'city')) => array(
    			'name' => 't.city',
    			'index' => 't.city',
    			'width' => '7%',
    		),
    		jqCaption::caption($form->labelEx($model,'address')) => array(
    			'name' => 't.address',
    			'index' => 't.address',
    			'width' => '12%',
    		),
    		jqCaption::caption($form->labelEx($model,'phone')) => array(
    			'name' => 't.phone',
    			'index' => 't.phone',
    			'width' => '9%',
    		),
    		jqCaption::caption($form->labelEx($model,'birthday')) => array(
    			'name' => 't.birthday',
    			'index' => 't.birthday',
    			'width' => '7%',
    		),
    		jqCaption::caption($form->labelEx($model,'registered_at')) => array(
    			'name' => 't.registered_at',
    			'index' => 't.registered_at',
    			'width' => '9%',
    		),
    		jqCaption::caption($form->labelEx($model,'last_login_at')) => array(
    			'name' => 't.last_login_at',
    			'index' => 't.last_login_at',
    			'width' => '9%',
    		),
    		jqCaption::caption($form->labelEx($model,'image')) => array(
    			'name' => 't.image',
    			'index' => 't.image',
    			'width' => '5%',
    			'align' => 'center',
    			'sortable' => false,
    			'search' => false,
    		),
    		jqCaption::caption($form->labelEx($model,'verified')) => array(
    			'name' => 't.verified',
    			'index' => 't.verified',
    			'width' => '5%',
    		),
    		jqCaption::caption($form->labelEx($model,'active')) => array(
    			'name' => 't.active',
    			'index' => 't.active',
    			'width' => '3%',
    		),
    		'Options' => array(
    			'name' => 'row.options',
    			'index' => 'row.options',
    			'width' => '4%',
    			'align' => 'center',
    			'sortable' => false,
    			'search' => false,
    		),
    	),
    )); ?>
    
    <?php $this->endWidget(); ?>
    
    <?php echo $this->renderPartial('_formInvite', array('model'=>$model)); ?>

<?php else: ?>
    <?php echo $this->renderPartial('../layouts/_noSociety'); ?>
<?php endif; ?>