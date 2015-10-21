<?php

/**
 * This is the model class for table "{{industry}}".
 *
 * The followings are the available columns in table '{{industry}}':
 * @property string $id
 * @property string $name
 */
class Industry extends CActiveRecord
{
    public static $_emptyCaption = 'Other';
    
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Industry the static model class
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
		return '{{industry}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('name', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name', 'safe', 'on'=>'search'),
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
			'name' => 'Name',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('name',$this->name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public static function getIndustries($withEmptyRow = false)
	{
		$criteria = new CDbCriteria;
		$criteria->order = 'name ASC';
		$industriesList = Industry::model()->findAll($criteria);
		
		$industries = array();
        if($withEmptyRow)
            $industries[null] = self::$_emptyCaption;

		for ($i = 0; $i < count($industriesList); $i++) {
			$industries[$industriesList[$i]->id] = $industriesList[$i]->name;
		}

		return $industries;
	}

	public static function findByName($name)
    {
        return self::model()->find('name=:name', array(':name'=>$name));
    }
}