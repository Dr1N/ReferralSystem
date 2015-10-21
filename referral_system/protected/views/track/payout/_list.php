<?php $form=$this->beginWidget('CActiveForm'); ?>

<?php $this->widget('ext.jqGridView.jqGridView', 
	array(
		'module' => 'track/payout',
		'elementId' => 'payoutList',
		'buttonSearch' => 'grid-search',
		'contentId' => 'payouts-table',
		'parameters' => array(
            'url' => 'track/payout/payoutGrid',
			'sortname' => 't.created_at',
			'sortorder' => 'DESC',
			'caption' => 'Payout',
			'shrinkToFit' => true,
            'height' => 100,
        ),
		'columns' => array(
			jqCaption::caption($form->labelEx($model,'status')) => array(
				'name' => 't.status',
				'index' => 't.status',
				'width' => '6%',
			),
	        jqCaption::caption($form->labelEx($model,'created_at')) => array(
				'name' => 't.created_at',
				'index' => 't.created_at',
				'width' => '11%',
			),
	        jqCaption::caption($form->labelEx($model,'details')) => array(
				'name' => 't.details',
				'index' => 't.details',
				'width' => '21%',
			),
			jqCaption::caption($form->labelEx($model,'amount')) => array(
				'name' => 't.amount',
				'index' => 't.amount',
				'width' => '6%',
				'searchtype' => 'number',
				'formatter' => 'currency', 
				'formatoptions'=> array('decimalPlaces'=> 2, 'prefix'=> '$'),
				'align' => 'right',
			),
			jqCaption::caption($form->labelEx($model,'end_amount')) => array(
				'name' => 't.end_amount',
				'index' => 't.end_amount',
				'width' => '6%',
				'searchtype' => 'number',
				'formatter' => 'currency', 
				'formatoptions'=> array('decimalPlaces'=> 2, 'prefix'=> '$'),
				'align' => 'right',
			),
		),
	));  ?>

<?php $this->endWidget(); ?>