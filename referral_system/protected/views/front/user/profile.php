<?php
/* @var $this UserController */
/* @var $model User */

$this->menu=array(
	array('label'=>'Update My Profile', 'url'=>array('update'), 'linkOptions' => array('class' => 'btn btn-success')),
	array('label'=>'Change Password', 'url'=>array('changePassword'), 'linkOptions' => array('class' => 'btn btn-primary'))
);
?>

<h1>My Profile</h1>

<div class="table-responsive">
    <?php $this->widget('zii.widgets.CDetailView', array(
    	'data'=>$model,
    	'attributes'=>array(
    		array(
                'name' => 'mail',
                'value' => $model->mail ? $model->mail : '-',
            ),
    		array(
                'name' => 'first_name',
                'value' => $model->first_name ? $model->first_name : '-',
            ),
    		array(
                'name' => 'last_name',
                'value' => $model->last_name ? $model->last_name : '-',
            ),
            array(
                'name' => 'country_id',
                'value' => $model->country ? $model->country->name : null,
            ),
    		array(
                'name' => 'city',
                'value' => $model->city ? $model->city : '-',
            ),
    		array(
                'name' => 'address',
                'value' => $model->address ? $model->address : '-',
            ),
    		array(
                'name' => 'phone',
                'value' => $model->phone ? $model->phone : '-',
            ),
            array(
                'name' => 'image',
                'type' => 'html',
                'value' => !empty($model->image) ? CHtml::image($model->getImagePath(true), 'Avatar') : 'No image',
            ),
            array(
                'name'=>'birthday',
                'value'=>strtotime($model->birthday) ? DateHandler::dateView($model->birthday) : '-',
            ),
            array(
                'name'=>'registered_at',
                'value'=>strtotime($model->registered_at) ? DateHandler::dateTimeView($model->registered_at) : '-',
            ),
            array(
                'name'=>'last_login_at',
                'value'=>strtotime($model->last_login_at) ? DateHandler::dateTimeView($model->last_login_at) : '-',
            ),
    	),
    	'htmlOptions' => array(
            'class' => 'table table-striped'
    	),
    )); ?>
</div>













