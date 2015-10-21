<?php
/* @var $this UserController */
/* @var $model User */

$this->menu=array(
	array('label'=>'List User',   'url'=>array('index'), 'linkOptions' => array('class' => 'btn btn-primary')),
	array('label'=>'Update User', 'url'=>array('update', 'id'=>$model->id), 'linkOptions' => array('class' => 'btn btn-success')),
	array('label'=>'Create User', 'url'=>array('create'), 'linkOptions' => array('class' => 'btn btn-warning')),
	array('label'=>'Delete User', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?'), 'linkOptions' => array('class' => 'btn btn-danger')),
);
?>

<h1 class="text-info">View User #<?php echo $model->id; ?></h1>

<div class="table-responsive">
    <?php $this->widget('zii.widgets.CDetailView', array(
    	'data'=>$model,
    	'attributes'=>array(
            array(
                'name'=>'organization_id',
                'value'=>$model->organization->name,
            ),
    		'mail',
    		'first_name',
    		'last_name',
            array(
                'name'=>'country_id',
                'value'=>$model->country->name,
            ),
    		'city',
    		'address',
    		'phone',
            array(
                'name'=>'Image',
                'type'=>'html',
                'value'=>!empty($model->image) ? CHtml::image($model->getImagePath(true), 'Avatar') : 'No avatar',
            ),
            array(
                'name'=>'birthday',
                'value'=>strtotime($model->birthday) ? DateHandler::dateView($model->birthday) : '',
            ),
            array(
                'name'=>'registered_at',
                'value'=>strtotime($model->registered_at) ? DateHandler::dateTimeView($model->registered_at) : '',
            ),
            array(
                'name'=>'last_login_at',
                'value'=>strtotime($model->last_login_at) ? DateHandler::dateTimeView($model->last_login_at) : '',
            ),
    		'active',   
    	),
    	'htmlOptions' => array(
            'class' => 'table table-striped'
    	),
    )); ?>
</div>