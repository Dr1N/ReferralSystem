<?php $this->beginContent('//layouts/main'); ?>
<div id="submenu">
	<?php
		$this->widget('zii.widgets.CMenu', array(
			'items'=>$this->menu,
			'htmlOptions' => array(
            	//'class' => 'nav nav-pills'
                'class' => 'list-inline',
			 )
		));
	?>
</div>
<div id="content">
	<?php echo $content; ?>
</div>
<?php $this->endContent(); ?>