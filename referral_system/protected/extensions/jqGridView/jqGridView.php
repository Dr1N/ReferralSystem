<?php
/**
 * Created on 01 06 2012 (11:57 AM)
 *
 */

class jqGridView extends CWidget 
{
	public $module;
	public $elementId;
	public $columns;
	public $extraColumns;
	public $parameters;
	public $headers;
	public $buttonSearch;
	public $buttonGrouping;
	public $buttonScheme;
	public $optionForm;
	public $contentId;
	public $filteringIds;
	public $detailsId;
	public $schemeId;
	public $selectedScheme;
	public $firstExtraFields;
	
	private $_columnNames;
	private $_columnModel;
	private $_extraNames;
	private $_extraModel;
	
	public function init()
	{
		$this->_parseColumns();
		parent::init();
	}

	public function run()
	{
		$this->_addIncludes();
		
		$data = array(
			'module' => $this->module,
			'elementId' => $this->elementId,
			'columnNames' => json_encode($this->_columnNames),
			'columnModel' => json_encode($this->_columnModel),
			'extraNames' => json_encode($this->_extraNames),
			'extraModel' => json_encode($this->_extraModel),
			'parameters' => json_encode($this->parameters),
			'headers' => json_encode($this->headers),
			'buttonSearch' => $this->buttonSearch,
			'buttonGrouping' => $this->buttonGrouping,
			'buttonScheme' => $this->buttonScheme,
			'optionForm' => $this->optionForm,
			'contentId' => $this->contentId,
			'filteringIds' => json_encode($this->filteringIds),
			'detailsId' => $this->detailsId,
			'schemeId' => $this->schemeId,
			'selectedScheme' => $this->selectedScheme,
			'firstExtraFields' => $this->firstExtraFields,
		);
		
		$this->render('view', $data);
	}
	
	private function _parseColumns()
	{
		$this->_columnNames = array_keys($this->columns);
		$this->_columnModel = array_values ($this->columns);
		
		if (isset($this->extraColumns))
		{
			$this->_extraNames = array_keys($this->extraColumns);
			$this->_extraModel = array_values ($this->extraColumns);
		}
	}
	
	private function _addIncludes()
	{
		$cs = Yii::app()->clientScript;
		$am = Yii::app()->assetManager;
		
		$cs->registerCssFile($am->publish(Yii::getPathOfAlias('ext.jqGridView.assets.css').'/ui.jqgrid.css'));
		$cs->registerCssFile($am->publish(Yii::getPathOfAlias('ext.jqGridView.assets.css').'/jquery-ui-custom.css'));
		$cs->registerCssFile($am->publish(Yii::getPathOfAlias('ext.jqGridView.assets.css').'/ui.multiselect.css'));
		 
		$cs->registerCoreScript('jquery');
		$cs->registerScriptFile($am->publish(Yii::getPathOfAlias('ext.jqGridView.assets.js.jqgrid').'/grid.locale-en.js'));
		$cs->registerScriptFile($am->publish(Yii::getPathOfAlias('ext.jqGridView.assets.js.jqgrid').'/jquery.jqGrid.min.js'));
		//$cs->registerScriptFile($am->publish(Yii::getPathOfAlias('ext.jqGridView.assets.js.jqgrid').'/jquery-ui-custom.min.js'));
		$cs->registerScriptFile($am->publish(Yii::getPathOfAlias('ext.jqGridView.assets.js.jqgrid').'/ui.multiselect.js'));
		$cs->registerScriptFile($am->publish(Yii::getPathOfAlias('ext.jqGridView.assets.js.jqgrid').'/grid.jqueryui.js'));
		$cs->registerScriptFile($am->publish(Yii::getPathOfAlias('ext.jqGridView.assets.js').'/grid.build.js'));
	}	
}
