<?php
/* @var $this PageController */
/* @var $model Page */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'page-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array(
        'class' => 'form-horizontal'
	),
)); ?>

	<p class="alert alert-info">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	
    <div class="well">
    <div class="form-panel">

    	<!--div class="form-group">
    		<?php //echo $form->labelEx($model,'parent_id',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
    		<div class="col-md-9 col-sm-9">
        		<?php //echo $form->textField($model,'parent_id'); ?>
        		<?php //echo $form->error($model,'parent_id'); ?>
    		</div>
    	</div-->
    
    	<div class="form-group">
    		<?php echo $form->labelEx($model,'page_url',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
    		<div class="col-md-9 col-sm-9">
        		<?php echo $form->textField($model,'page_url',array('size'=>60,'maxlength'=>100,'class'=>'form-control')); ?>
        		<?php echo $form->error($model,'page_url'); ?>
            </div>
    	</div>
    
    	<div class="form-group">
    		<?php echo $form->labelEx($model,'link_name',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
    		<div class="col-md-9 col-sm-9">
        		<?php echo $form->textField($model,'link_name',array('size'=>60,'maxlength'=>100,'class'=>'form-control')); ?>
        		<?php echo $form->error($model,'link_name'); ?>
            </div>
    	</div>
    
    	<div class="form-group">
    		<?php echo $form->labelEx($model,'type',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
    		<div class="col-md-9 col-sm-9">
        		<?php echo $form->dropDownList($model,'type',Page::$type,array('class'=>'form-control')); ?>
        		<?php echo $form->error($model,'type'); ?>
            </div>
    	</div>
    
    	<div class="form-group">
    		<?php echo $form->labelEx($model,'access',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
    		<div class="col-md-9 col-sm-9">
        		<?php echo $form->dropDownList($model,'access',Page::$access,array('class'=>'form-control')); ?>
        		<?php echo $form->error($model,'access'); ?>
            </div>
    	</div>
    
    	<div class="form-group">
    		<?php echo $form->labelEx($model,'sorting',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
    		<div class="col-md-9 col-sm-9">
        		<?php echo $form->textField($model,'sorting',array('size'=>4,'maxlength'=>4,'class'=>'form-control')); ?>
        		<?php echo $form->error($model,'sorting'); ?>
            </div>
    	</div>
    
    	<div class="form-group">
    		<?php echo $form->labelEx($model,'visible_main',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
    		<div class="col-md-9 col-sm-9">
                <div class="btn-group" data-toggle="buttons">
                    <label class="btn btn-default <?php echo $model->visible_main == 'yes' ? 'active' : '' ?>">
                		<?php echo $form->radioButton($model,'visible_main',array('value'=>'yes','uncheckValue'=>null)) . 'Yes'; ?>
                    </label>
                    <label class="btn btn-default <?php echo $model->visible_main == 'no' ? 'active' : '' ?>">
                		<?php echo $form->radioButton($model,'visible_main',array('value'=>'no','uncheckValue'=>null)) . ' No'; ?>
                    </label>
                </div>
                <?php echo $form->error($model,'visible_main'); ?>
            </div>
    	</div>
    
    	<div class="form-group">
    		<?php echo $form->labelEx($model,'visible_bottom',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
    		<div class="col-md-9 col-sm-9">
                <div class="btn-group" data-toggle="buttons">
                    <label class="btn btn-default <?php echo $model->visible_bottom == 'yes' ? 'active' : '' ?>">
                		<?php echo $form->radioButton($model,'visible_bottom',array('value'=>'yes','uncheckValue'=>null)) . 'Yes'; ?>
                    </label>
                    <label class="btn btn-default <?php echo $model->visible_bottom == 'no' ? 'active' : '' ?>">
                		<?php echo $form->radioButton($model,'visible_bottom',array('value'=>'no','uncheckValue'=>null)) . ' No'; ?>
                    </label>
                </div>
        		<?php echo $form->error($model,'visible_bottom'); ?>
            </div>
    	</div>
    
    	<div class="form-group">
    		<?php echo $form->labelEx($model,'title',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
    		<div class="col-md-9 col-sm-9">
        		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>100,'class'=>'form-control')); ?>
        		<?php echo $form->error($model,'title'); ?>
            </div>
    	</div>
    
    	<div class="form-group">
    		<?php echo $form->labelEx($model,'meta_keywords',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
    		<div class="col-md-9 col-sm-9">
        		<?php echo $form->textField($model,'meta_keywords',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
        		<?php echo $form->error($model,'meta_keywords'); ?>
            </div>
    	</div>
    
    	<div class="form-group">
    		<?php echo $form->labelEx($model,'meta_description',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
    		<div class="col-md-9 col-sm-9">
        		<?php echo $form->textField($model,'meta_description',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
        		<?php echo $form->error($model,'meta_description'); ?>
            </div>
    	</div>
    
    	<div id="meta_fields" class="hidden">
        
        	<div class="form-group">
        		<?php echo $form->labelEx($model,'meta_author',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
        		<div class="col-md-9 col-sm-9">
                    <?php echo $form->textField($model,'meta_author',array('size'=>60,'maxlength'=>100,'class'=>'form-control')); ?>
            		<?php echo $form->error($model,'meta_author'); ?>
                </div>
        	</div>
        
        	<div class="form-group">
        		<?php echo $form->labelEx($model,'meta_creator',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
        		<div class="col-md-9 col-sm-9">
            		<?php echo $form->textField($model,'meta_creator',array('size'=>60,'maxlength'=>100,'class'=>'form-control')); ?>
            		<?php echo $form->error($model,'meta_creator'); ?>
                </div>
        	</div>
        
        	<div class="form-group">
        		<?php echo $form->labelEx($model,'meta_title',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
        		<div class="col-md-9 col-sm-9">
            		<?php echo $form->textField($model,'meta_title',array('size'=>60,'maxlength'=>100,'class'=>'form-control')); ?>
            		<?php echo $form->error($model,'meta_title'); ?>
                </div>
        	</div>
        
        	<div class="form-group">
        		<?php echo $form->labelEx($model,'meta_subject',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
        		<div class="col-md-9 col-sm-9">
            		<?php echo $form->textField($model,'meta_subject',array('size'=>60,'maxlength'=>100,'class'=>'form-control')); ?>
            		<?php echo $form->error($model,'meta_subject'); ?>
                </div>
        	</div>
        
        	<div class="form-group">
        		<?php echo $form->labelEx($model,'meta_date',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
        		<div class="col-md-9 col-sm-9">
            		<?php echo $form->textField($model,'meta_date',array('size'=>60,'maxlength'=>100,'class'=>'form-control')); ?>
            		<?php echo $form->error($model,'meta_date'); ?>
                </div>
        	</div>
        
        	<div class="form-group">
        		<?php echo $form->labelEx($model,'meta_identifier',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
        		<div class="col-md-9 col-sm-9">
            		<?php echo $form->textField($model,'meta_identifier',array('size'=>60,'maxlength'=>100,'class'=>'form-control')); ?>
            		<?php echo $form->error($model,'meta_identifier'); ?>
                </div>
        	</div>
        
        	<div class="form-group">
        		<?php echo $form->labelEx($model,'meta_type',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
        		<div class="col-md-9 col-sm-9">
            		<?php echo $form->textField($model,'meta_type',array('size'=>60,'maxlength'=>100,'class'=>'form-control')); ?>
            		<?php echo $form->error($model,'meta_type'); ?>
                </div>
        	</div>
        
        	<div class="form-group">
        		<?php echo $form->labelEx($model,'meta_language',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
        		<div class="col-md-9 col-sm-9">
            		<?php echo $form->textField($model,'meta_language',array('size'=>60,'maxlength'=>100,'class'=>'form-control')); ?>
            		<?php echo $form->error($model,'meta_language'); ?>
                </div>
        	</div>
        
        </div>
        
    	<div class="form-group">
            <div class="col-md-offset-3 col-sm-offset-3 col-sm-10">
                <a href="#" id="show_meta_fields">All Meta Fields</a><br />
        	</div>
    	</div>
    
    	<div class="form-group">
    		<?php echo $form->labelEx($model,'header',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
    		<div class="col-md-9 col-sm-9">
                <?php echo $form->textField($model,'header',array('size'=>60,'maxlength'=>100,'class'=>'form-control')); ?>
        		<?php echo $form->error($model,'header'); ?>
            </div>
    	</div>
    
    	<div class="form-group">
    		<?php echo $form->labelEx($model,'text_page',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
    		<div class="col-md-9 col-sm-9 col-xs-8">
        		<?php $this->widget('application.extensions.tinymce.ETinyMce', 
        			array(
        				'model'=>$model,
        				'name'=>'Page[text_page]',
        				//'width'=>'100%',
        				'value'=>$model->text_page,
        				'options' => array(
        					'theme' => 'advanced',
        					'skin' => 'default',
        					'theme_advanced_toolbar_location'=>'top',
        					'theme_advanced_toolbar_align'=>"left",
        					'theme_advanced_buttons1' => "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,formatselect,fontselect,fontsizeselect",
        					'theme_advanced_buttons2' => "cut,copy,paste,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,forecolor, backcolor|,hr,removeformat,visualaid,|,sub,sup,|,charmap",
        					'theme_advanced_buttons3' => ""
        				)
        			)
        		); ?>
        		<?php echo $form->error($model,'text_page'); ?>
            </div>
    	</div>

    	<div class="form-group buttons">
            <div class="col-md-offset-3 col-sm-offset-3 col-sm-10">
        		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-primary')); ?>
            </div>
    	</div>

    </div>
    </div>

<?php $this->endWidget(); ?>

</div>