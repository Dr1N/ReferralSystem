<?php
/* @var $this UserController */
/* @var $model User */

$this->menu=array(
	array('label'=>'List User', 'url'=>array('list'), 'linkOptions' => array('class' => 'btn btn-primary')),
	array('label'=>'Invite User', 'url'=>array('#'), 'linkOptions' => array('class' => 'btn btn-success', 'data-toggle' => 'modal', 'data-target'=>'#invite-modal')),
	array('label'=>'Delete from Organization', 'url'=>'#', 'linkOptions'=>array('submit'=>array('deleteLink','id'=>$model->id),'confirm'=>'Are you sure you want to delete this user from your organization?','class' => 'btn btn-danger')),
);
?>

<h1>
    <?php if(!empty($model->first_name) or !empty($model->last_name)): ?>
        <?php echo $model->first_name; ?> <?php echo $model->last_name; ?>
    <?php else: ?>
        <?php echo $model->mail; ?>
    <?php endif; ?>
</h1>

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
    		'active',
    	),
    	'htmlOptions' => array(
            'class' => 'table table-striped'
    	),
    )); ?>
</div>

<?php 
    $model = new User; 
    echo $this->renderPartial('_formInvite', array('model'=>$model)); 
?>







