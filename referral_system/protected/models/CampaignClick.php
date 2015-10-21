<?php

/**
 * This is the model class for table "{{campaign_click}}".
 *
 * The followings are the available columns in table '{{campaign_click}}':
 * @property integer $id
 * @property integer $owner_id
 * @property integer $campaign_id
 * @property string $used_way
 * @property string $ip_address
 * @property string $clicked_at
 *
 * The followings are the available model relations:
 * @property User $owner
 * @property Campaign $campaign
 */
class CampaignClick extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CampaignClick the static model class
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
		return '{{campaign_click}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('owner_id, campaign_id, ip_address', 'required'),
			array('owner_id, campaign_id', 'numerical', 'integerOnly'=>true),
			array('used_way', 'length', 'max'=>8),
			array('ip_address', 'length', 'max'=>10),
			array('clicked_at', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, owner_id, campaign_id, used_way, ip_address, clicked_at', 'safe', 'on'=>'search'),
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
			'owner' => array(self::BELONGS_TO, 'User', 'owner_id'),
			'campaign' => array(self::BELONGS_TO, 'Campaign', 'campaign_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'owner_id' => 'Owner',
			'campaign_id' => 'Campaign',
			'used_way' => 'Used Way',
			'ip_address' => 'Ip Address',
			'clicked_at' => 'Clicked At',
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
		$criteria->compare('owner_id',$this->owner_id);
		$criteria->compare('campaign_id',$this->campaign_id);
		$criteria->compare('used_way',$this->used_way,true);
		$criteria->compare('ip_address',$this->ip_address,true);
		$criteria->compare('clicked_at',$this->clicked_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public static function getClicksAmount($campaign_id, $way = null, $owner_id = null)
	{
		$query = 'campaign_id = :campaign_id';
		$params = array(':campaign_id' => $campaign_id);

		if(!empty($way))
		{
			$query .= ' AND used_way = :used_way';
			$params[':used_way'] = $way;
		}

		if(!empty($owner_id))
		{
			$query .= ' AND owner_id = :owner_id';
			$params[':owner_id'] = $owner_id;
		}

		return self::model()->count($query, $params);
	}
    
	public static function findByParams($campaign_id, $way = null, $owner_id = null, $ip_address = null)
	{
		$query = 'campaign_id = :campaign_id';
		$params = array(':campaign_id' => $campaign_id);

		if(!empty($way))
		{
			$query .= ' AND used_way = :used_way';
			$params[':used_way'] = $way;
		}

		if(!empty($owner_id))
		{
			$query .= ' AND owner_id = :owner_id';
			$params[':owner_id'] = $owner_id;
		}
		
        if(!empty($ip_address))
		{
			$query .= ' AND ip_address = :ip_address';
			$params[':ip_address'] = $ip_address;
		}

		return self::model()->find($query, $params);
	}
}	