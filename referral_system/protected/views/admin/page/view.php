<?php
/* @var $this PageController */
/* @var $model Page */

$this->menu=array(
	array('label'=>'List Page', 'url'=>array('index'), 'linkOptions' => array('class' => 'btn btn-primary')),
	array('label'=>'Create Page', 'url'=>array('create'), 'linkOptions' => array('class' => 'btn btn-success')),
	array('label'=>'Update Page', 'url'=>array('update', 'id'=>$model->id), 'linkOptions' => array('class' => 'btn btn-success')),
	array('label'=>'Delete Page', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?'), 'linkOptions' => array('class' => 'btn btn-danger')),
);
?>

<h1 class="text-info">View Page #<?php echo $model->id; ?></h1>

<div class="table-responsive">
    <?php $this->widget('zii.widgets.CDetailView', array(
    	'data'=>$model,
    	'attributes'=>array(
    		'id',
    		//'parent_id',
    		'page_url',
    		'link_name',
    		'type',
    		'access',
    		'sorting',
    		'visible_main',
    		'visible_bottom',
    		'title',
    		'meta_keywords',
    		'meta_description',
    		'meta_author',
    		'meta_creator',
    		'meta_title',
    		'meta_subject',
    		'meta_date',
    		'meta_identifier',
    		'meta_type',
    		'meta_language',
    		'header',
    		'text_page',
    	),
    	'htmlOptions' => array(
            'class' => 'table table-striped'
    	),
    )); ?>
</div>