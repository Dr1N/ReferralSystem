<?php
/* @var $this OrganizationController */
/* @var $model Organization */

$this->menu = array(
    empty($model) ?
        array('label'=>'Create Organization', 'url'=>array('create'), 'linkOptions' => array('class' => 'btn btn-success')) :
        array('label'=>'Update Organization', 'url'=>array('update'), 'linkOptions' => array('class' => 'btn btn-success')));
?>

<h1>My Organization</h1>

<?php if (isset($model)): ?>

    <div class="table-responsive">
        <?php $this->widget('zii.widgets.CDetailView', array(
        	'data'=>$model,
        	'attributes'=>array(
        		array(
                    'name' => 'name',
                    'value' => $model->name ? $model->name : '-',
                ),
        		array(
                    'name' => 'site_url',
                    'value' => $model->site_url ? $model->site_url : '-',
                ),
        		array(
                    'name' => 'country_id',
                    'value' => $model->country ? $model->country->name : null,
                ),
                array(
                    'name' => 'postal_code',
                    'value' => $model->postal_code ? $model->postal_code : '-',
                ),
                array(
                    'name' => 'state',
                    'value' => $model->state ? $model->state : '-',
                ),
                array(
                    'name' => 'city',
                    'value' => $model->city ? $model->city : '-',
                ),
                array(
                    'name' => 'address_line_1',
                    'value' => $model->address_line_1 ? $model->address_line_1 : '-',
                ),
                array(
                    'name' => 'address_line_2',
                    'value' => $model->address_line_2 ? $model->address_line_2 : '-',
                ),
                array(
                    'name' => 'industry_id',
                    'value' => $model->industry ? $model->industry->name : Industry::$_emptyCaption,
                ),
                array(
                    'name' => 'description',
                    'value' => $model->description ? $model->description : '-',
                ),
        	),
        	'htmlOptions' => array(
                'class' => 'table table-striped'
        	),
        )); ?>
    </div>

<?php else: ?>
    <?php echo $this->renderPartial('../layouts/_noSociety'); ?>
<?php endif; ?>