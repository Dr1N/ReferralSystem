<?php
/* @var $this PayoutController */
/* @var $model Payout */

if (User::hasSociety()):
    $this->menu=array(
    	array('label'=>'Create Payout', 'url'=>array('#'), 'linkOptions' => array('class' => 'btn btn-success', 'data-toggle' => 'modal', 'data-target'=>'#payout-modal')),
    );
endif;
?>

<h1>Manage Payouts</h1>

<?php if (User::hasSociety()): ?>

    <?php $this->Widget('ext.highcharts.HighstockWidget', array(
        'options'=>array(
            //'colors' => array('#0000cc', '#cc0000', '#33cc66', '#660099', '#33ccff', '#ff9900', '#3399ff'),
            //'rangeSelector'=>array('selected'=>2),
            'title' => array('text' => 'Payout Statistics'),
            /*'xAxis' => array(
                'categories' => array('Apples', 'Bananas', 'Oranges')
            ),*/
            'legend' => array('enabled' => true),
            'tooltip' => array('crosshairs' => false),
            'yAxis' => array(
                'title' => array('text' => 'Fruit eaten'),
            ),
            'series' => array(
                //array('name' => 'Jane', 'data' => array(1, 0, 4)),
                //array('name' => 'John', 'data' => array(5, 7, 3))
                array('name' => 'Tanya', 'data' => $data),
                //array('name' => 'Firset', 'data' => $data),
                //array('name' => 'Second', 'data' => $data),
            ),
            'credits' => array('enabled' => false),
            'chart' => array('type' => 'line'), // line, spline, area, areaspline, column, bar, pie, scatter, gauge, arearange, areasplinerange, columnrange, bubble, box plot, error bars, funnel, waterfall, polar chart types.
            //'theme' => 'gray',
        ),
        /*'scripts' => array(
            'highcharts-more',   // enables supplementary chart types (gauge, arearange, columnrange, etc.)
            'modules/exporting', // adds Exporting button/menu to chart
            //'themes/grid'        // applies global 'grid' theme to all charts
        ),*/
    )); ?>
    
    <?php $form=$this->beginWidget('CActiveForm'); ?>
    
    <?php $this->widget('ext.jqGridView.jqGridView', array(
    	'module' => 'payout',
    	'elementId' => 'list',
    	'buttonSearch' => 'grid-search',
    	'contentId' => 'content',
    	'parameters' => array(
    		'sortname' => 't.created_at',
    		'sortorder' => 'DESC',
    		'caption' => 'Payouts',
    		'shrinkToFit' => true,
    	),
    	'columns' => array(
    		jqCaption::caption($form->labelEx($model,'id')) => array(
    			'name' => 't.id',
    			'index' => 't.id',
    			'width' => '5%',
    			'searchtype' => 'integer',
    			'align' => 'right'
    		),
    		jqCaption::caption('User Email') => array(
    			'name' => 'user.mail',
    			'index' => 'user.mail',
    			'width' => '10%',
    		),
            jqCaption::caption('User Name') => array(
    			'name' => 'user.first_name',
    			'index' => 'user.first_name',
    			'width' => '10%',
    		),
            jqCaption::caption($form->labelEx($model,'campaign_id')) => array(
    			'name' => 'campaign.name',
    			'index' => 'campaign.name',
    			'width' => '10%',
    		),
    		jqCaption::caption($form->labelEx($model,'amount')) => array(
    			'name' => 't.amount',
    			'index' => 't.amount',
    			'width' => '8%',
    			'searchtype' => 'number',
    			'formatter' => 'currency', 
    			'formatoptions'=> array('decimalPlaces'=> 2, 'prefix'=> '$'),
    			'align' => 'right',
    		),
    		jqCaption::caption($form->labelEx($model,'end_amount')) => array(
    			'name' => 't.end_amount',
    			'index' => 't.end_amount',
    			'width' => '8%',
    			'searchtype' => 'number',
    			'formatter' => 'currency', 
    			'formatoptions'=> array('decimalPlaces'=> 2, 'prefix'=> '$'),
    			'align' => 'right',
    		),
    		jqCaption::caption($form->labelEx($model,'created_at')) => array(
    			'name' => 't.created_at',
    			'index' => 't.created_at',
    			'width' => '10%',
    		),
    		jqCaption::caption($form->labelEx($model,'status')) => array(
    			'name' => 't.status',
    			'index' => 't.status',
    			'width' => '10%',
    		),
    		jqCaption::caption($form->labelEx($model,'payout_way')) => array(
    			'name' => 't.payout_way',
    			'index' => 't.payout_way',
    			'width' => '10%',
    		),
    		jqCaption::caption($form->labelEx($model,'details')) => array(
    			'name' => 't.details',
    			'index' => 't.details',
    			'width' => '10%',
    		),
    		'Options' => array(
    			'name' => 'row.options',
    			'index' => 'row.options',
    			'width' => '9%',
    			'align' => 'center',
    			'sortable' => false,
    			'search' => false,
    		),
    	),
    )); ?>
    
    <?php $this->endWidget(); ?>

    <?php 
    	$user = new User; // could we don't do like this (a-to-do) !!!!!!!!!!!!!!!
    	echo $this->renderPartial('_formCreate', array('model'=>$user)); // there should be passed the $model, not $user !!!!  
    ?>

<?php else: ?>
    <?php echo $this->renderPartial('../layouts/_noSociety'); ?>
<?php endif; ?>

<div id="payout-update" class="hidden"></div>