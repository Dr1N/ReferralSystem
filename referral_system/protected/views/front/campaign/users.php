<?php
/* @var $this CampaignController */
/* @var $model Campaign */
/* @var $user User */

if (User::hasSociety()):
    $this->menu=array(
    	array('label'=>'List Campaign', 'url'=>array('list'), 'linkOptions' => array('class' => 'btn btn-primary')),
        //array('label'=>'Update Campaign Data', 'url'=>array('update', 'id'=>$model->id), 'linkOptions' => array('class' => 'btn btn-info')),
    	array('label'=>'Add Campaign', 'url'=>array('create'), 'linkOptions' => array('class' => 'btn btn-success')),
    	array('label'=>'Delete Campaign', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this campaign?','class' => 'btn btn-danger')),
    );
endif;
?>

<h1>Campaign Users</h1>

<?php if (User::hasSociety()): ?>
    
    <?php $form=$this->beginWidget('CActiveForm'); ?>
    
    <?php $this->widget('ext.jqGridView.jqGridView', array(
    	'module' => 'campaign',
    	'elementId' => 'list',
    	'buttonSearch' => 'grid-search',
    	'contentId' => 'content',
    	'parameters' => array(
            'url' => '../../../campaign/usersGrid/id/' . $model->id,
    		'sortname' => 't.id',
    		'sortorder' => 'DESC',
    		'caption' => 'Users',
    		'shrinkToFit' => true,
    	),
    	'columns' => array(
    		jqCaption::caption($form->labelEx($user,'id')) => array(
    			'name' => 't.id',
    			'index' => 't.id',
    			'width' => '5%',
    			'searchtype' => 'integer',
    			'align' => 'right',
    		),
    		jqCaption::caption($form->labelEx($user,'mail')) => array(
    			'name' => 't.mail',
    			'index' => 't.mail',
    			'width' => '10%',
    		),
            jqCaption::caption('User Name') => array(
    			'name' => 't.first_name',
    			'index' => 't.first_name',
    			'width' => '10%',
    		),
    		jqCaption::caption($form->labelEx($user,'country_id')) => array(
    			'name' => 'country.name',
    			'index' => 'country.name',
    			'width' => '5%',
    		),
    		jqCaption::caption($form->labelEx($user,'city')) => array(
    			'name' => 't.city',
    			'index' => 't.city',
    			'width' => '5%',
    		),
    		jqCaption::caption($form->labelEx($user,'address')) => array(
    			'name' => 't.address',
    			'index' => 't.address',
    			'width' => '8%',
    		),
    		jqCaption::caption($form->labelEx($user,'phone')) => array(
    			'name' => 't.phone',
    			'index' => 't.phone',
    			'width' => '8%',
    		),
    		jqCaption::caption($form->labelEx($user,'birthday')) => array(
    			'name' => 't.birthday',
    			'index' => 't.birthday',
    			'width' => '5%',
    		),
    		jqCaption::caption($form->labelEx($user,'registered_at')) => array(
    			'name' => 't.registered_at',
    			'index' => 't.registered_at',
    			'width' => '8%',
    		),
    		jqCaption::caption($form->labelEx($user,'last_login_at')) => array(
    			'name' => 't.last_login_at',
    			'index' => 't.last_login_at',
    			'width' => '8%',
    		),
    		jqCaption::caption($form->labelEx($user,'verified')) => array(
    			'name' => 't.verified',
    			'index' => 't.verified',
    			'width' => '3%',
    		),
    		jqCaption::caption($form->labelEx($user,'active')) => array(
    			'name' => 't.active',
    			'index' => 't.active',
    			'width' => '3%',
    		),
            
    
    
    
            
    		'Mail Clicks' => array(
    			'name' => 't.statistic',
    			'index' => 't.statistic',
    			'width' => '3%',
    		),
    		'Facebook Clicks' => array(
    			'name' => 't.statistic',
    			'index' => 't.statistic',
    			'width' => '3%',
    		),
    		'Twitter Clicks' => array(
    			'name' => 't.statistic',
    			'index' => 't.statistic',
    			'width' => '3%',
    		),
    		'Link Clicks' => array(
    			'name' => 't.statistic',
    			'index' => 't.statistic',
    			'width' => '3%',
    		),
    		'Mail Purchases' => array(
    			'name' => 't.statistic',
    			'index' => 't.statistic',
    			'width' => '3%',
    		),
    		'Facebook Purchases' => array(
    			'name' => 't.statistic',
    			'index' => 't.statistic',
    			'width' => '3%',
    		),
    		'Twitter Purchases' => array(
    			'name' => 't.statistic',
    			'index' => 't.statistic',
    			'width' => '3%',
    		),
    		'Link Purchases' => array(
    			'name' => 't.statistic',
    			'index' => 't.statistic',
    			'width' => '3%',
    		),
    
            
            
            
            
            
    
            
            
            
            
            
            
            
            
            
            
            
            
            
    		'Options' => array(
    			'name' => 'row.options',
    			'index' => 'row.options',
    			'width' => '8%',
    			'align' => 'center',
    			'sortable' => false,
    			'search' => false,
    		),
    	),
    )); ?>
    
    <?php $this->endWidget(); ?>

<?php else: ?>
    <?php echo $this->renderPartial('../layouts/_noSociety'); ?>
<?php endif; ?>