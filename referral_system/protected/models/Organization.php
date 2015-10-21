<?php

/**
 * This is the model class for table "{{organization}}".
 *
 * The followings are the available columns in table '{{organization}}':
 * @property integer $id
 * @property string $name
 * @property string $site_url
 * @property string $description
 *
 * The followings are the available model relations:
 * @property Campaign[] $campaigns
 * @property User[] $users
 */
class Organization extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Organization the static model class
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
		return '{{organization}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, description', 'required'),
			array('name', 'length', 'max'=>100),
			array('country_id, industry_id', 'numerical', 'integerOnly'=>true),
			array('name, state, city, address_line_1, address_line_2', 'length', 'max'=>100),
			array('site_url', 'length', 'max'=>255),
            array('site_url','url'), // !!!!!!!!!!!!!!!!!!!!!
            array('postal_code', 'length', 'max'=>5),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, site_url, country_id, postal_code, state, city, address_line_1, address_line_2, industry_id, description', 'safe', 'on'=>'search'),
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
            'campaigns' => array(self::HAS_MANY, 'Campaign', 'organization_id'),
            'users' => array(self::HAS_MANY, 'User', 'organization_id'),
            'invitations' => array(self::HAS_MANY, 'Invitation', 'organization_id'),
            'industry' => array(self::BELONGS_TO, 'Industry', 'industry_id'),
            'country' => array(self::BELONGS_TO, 'Country', 'country_id'),
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
            'site_url' => 'Site Url',
            'country_id' => 'Country',
            'postal_code' => 'Postal Code',
            'state' => 'State',
            'city' => 'City',
            'address_line_1' => 'Address Line 1',
            'address_line_2' => 'Address Line 2',
            'industry_id' => 'Industry',
            'description' => 'Description',
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
        $criteria->compare('name',$this->name,true);
        $criteria->compare('site_url',$this->site_url,true);
        $criteria->compare('country_id',$this->country_id);
        $criteria->compare('postal_code',$this->postal_code,true);
        $criteria->compare('state',$this->state,true);
        $criteria->compare('city',$this->city,true);
        $criteria->compare('address_line_1',$this->address_line_1,true);
        $criteria->compare('address_line_2',$this->address_line_2,true);
        $criteria->compare('industry_id',$this->industry_id);
        $criteria->compare('description',$this->description,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
	}
    
	public static function getOrganizations($withEmptyRow = false)
	{
		$criteria = new CDbCriteria;
		$criteria->order = 'name ASC';
		$organizationsList = Organization::model()->findAll($criteria);
		
		$organizations = array();
        if($withEmptyRow)
            $organizations[null] = null;
                    
		for ($i = 0; $i < count($organizationsList); $i++)
			$organizations[$organizationsList[$i]->id] = $organizationsList[$i]->name;

		return $organizations;
	}
}