<?php

/**
 * This is the model class for table "{{page}}".
 *
 * The followings are the available columns in table '{{page}}':
 * @property integer $id
 * @property integer $parent_id
 * @property string $page_url
 * @property string $link_name
 * @property string $type
 * @property string $access
 * @property string $sorting
 * @property string $visible_main
 * @property string $visible_bottom
 * @property string $title
 * @property string $meta_keywords
 * @property string $meta_description
 * @property string $meta_author
 * @property string $meta_creator
 * @property string $meta_title
 * @property string $meta_subject
 * @property string $meta_date
 * @property string $meta_identifier
 * @property string $meta_type
 * @property string $meta_language
 * @property string $header
 * @property string $text_page
 *
 * The followings are the available model relations:
 */
class Page extends CActiveRecord
{
	public static $type = array(
		'html' => 'Html',
		'code' => 'Code',
		'both' => 'Both',
		'alias' => 'Alias'
	);
    
	public static $access = array(
		'guest' => 'Guest',
		'insider' => 'Insider',
	);
    
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Page the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{page}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('page_url, link_name', 'required'),
			array('parent_id', 'numerical', 'integerOnly'=>true),
			array('page_url, link_name, title, meta_author, meta_creator, meta_title, meta_subject, meta_date, meta_identifier, meta_type, meta_language, header', 'length', 'max'=>100),
			array('type', 'length', 'max'=>5),
			array('access', 'length', 'max'=>7),
			array('sorting', 'length', 'max'=>4),
			array('visible_main, visible_bottom, dropdown', 'length', 'max'=>3),
			array('meta_keywords, meta_description', 'length', 'max'=>255),
            array('text_page', 'default', 'value'=>''),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, parent_id, page_url, link_name, type, access, sorting, visible_main, visible_bottom, dropdown, title, meta_keywords, meta_description, meta_author, meta_creator, meta_title, meta_subject, meta_date, meta_identifier, meta_type, meta_language, header, text_page', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'parent_id' => 'Parent',
			'page_url' => 'Page Url',
			'link_name' => 'Link Name',
			'type' => 'Type',
			'access' => 'Access',
			'sorting' => 'Sorting',
			'visible_main' => 'In Main Menu',
			'visible_bottom' => 'In Bottom Menu',
			'dropdown' => 'Dropdown',
			'title' => 'Title',
			'meta_keywords' => 'Meta Keywords',
			'meta_description' => 'Meta Description',
			'meta_author' => 'Meta Author',
			'meta_creator' => 'Meta Creator',
			'meta_title' => 'Meta Title',
			'meta_subject' => 'Meta Subject',
			'meta_date' => 'Meta Date',
			'meta_identifier' => 'Meta Identifier',
			'meta_type' => 'Meta Type',
			'meta_language' => 'Meta Language',
			'header' => 'Header',
			'text_page' => 'Text Page',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('page_url',$this->page_url,true);
		$criteria->compare('link_name',$this->link_name,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('access',$this->access,true);
		$criteria->compare('sorting',$this->sorting,true);
		$criteria->compare('visible_main',$this->visible_main,true);
		$criteria->compare('visible_bottom',$this->visible_bottom,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('meta_keywords',$this->meta_keywords,true);
		$criteria->compare('meta_description',$this->meta_description,true);
		$criteria->compare('meta_author',$this->meta_author,true);
		$criteria->compare('meta_creator',$this->meta_creator,true);
		$criteria->compare('meta_title',$this->meta_title,true);
		$criteria->compare('meta_subject',$this->meta_subject,true);
		$criteria->compare('meta_date',$this->meta_date,true);
		$criteria->compare('meta_identifier',$this->meta_identifier,true);
		$criteria->compare('meta_type',$this->meta_type,true);
		$criteria->compare('meta_language',$this->meta_language,true);
		$criteria->compare('header',$this->header,true);
		$criteria->compare('text_page',$this->text_page,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
	public static function getFrontMenuPages($visible_main = null, $visible_bottom = null)
	{
		$criteria = new CDbCriteria;
		$criteria->order = 'sorting ASC';
        if ($visible_main != null)
            $criteria->compare('visible_main', $visible_main);
        if ($visible_bottom != null)
            $criteria->compare('visible_bottom', $visible_bottom);
		$pagesList = Page::model()->findAll($criteria);
		
		$pages = array();
		for ($i = 0; $i < count($pagesList); $i++) {
			$pages[] = array(
                'label' => $pagesList[$i]->link_name,
                'url' => $pagesList[$i]->page_url,
                'visible' => $pagesList[$i]->access == 'guest' || !Yii::app()->user->isGuest,
                'dropdown' => $pagesList[$i]->dropdown,
            );
		}

		return $pages;
	}
    
    public static function findByPageUrl($page_url)
    {
        return self::model()->find('page_url=:page_url', array(':page_url'=>$page_url));
    }
}