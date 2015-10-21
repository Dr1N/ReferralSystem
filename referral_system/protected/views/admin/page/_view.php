<?php
/* @var $this PageController */
/* @var $data Page */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('parent_id')); ?>:</b>
	<?php echo CHtml::encode($data->parent_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('page_url')); ?>:</b>
	<?php echo CHtml::encode($data->page_url); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('link_name')); ?>:</b>
	<?php echo CHtml::encode($data->link_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
	<?php echo CHtml::encode($data->type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('access')); ?>:</b>
	<?php echo CHtml::encode($data->access); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sorting')); ?>:</b>
	<?php echo CHtml::encode($data->sorting); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('visible_main')); ?>:</b>
	<?php echo CHtml::encode($data->visible_main); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('visible_bottom')); ?>:</b>
	<?php echo CHtml::encode($data->visible_bottom); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('meta_keywords')); ?>:</b>
	<?php echo CHtml::encode($data->meta_keywords); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('meta_description')); ?>:</b>
	<?php echo CHtml::encode($data->meta_description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('meta_author')); ?>:</b>
	<?php echo CHtml::encode($data->meta_author); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('meta_creator')); ?>:</b>
	<?php echo CHtml::encode($data->meta_creator); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('meta_title')); ?>:</b>
	<?php echo CHtml::encode($data->meta_title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('meta_subject')); ?>:</b>
	<?php echo CHtml::encode($data->meta_subject); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('meta_date')); ?>:</b>
	<?php echo CHtml::encode($data->meta_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('meta_identifier')); ?>:</b>
	<?php echo CHtml::encode($data->meta_identifier); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('meta_type')); ?>:</b>
	<?php echo CHtml::encode($data->meta_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('meta_language')); ?>:</b>
	<?php echo CHtml::encode($data->meta_language); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('header')); ?>:</b>
	<?php echo CHtml::encode($data->header); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('text_page')); ?>:</b>
	<?php echo CHtml::encode($data->text_page); ?>
	<br />

	*/ ?>

</div>