<?php

/**
 * This is the model class for table "{{imported_mail}}".
 *
 * The followings are the available columns in table '{{imported_mail}}':
 * @property integer $id
 * @property integer $user_id
 * @property string $mail
 * @property string $sent_at
 * @property string $status
 * @property string $added_type
 *
 * The followings are the available model relations:
 * @property User $user
 */
class ImportedMail extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ImportedMail the static model class
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
		return '{{imported_mail}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array('user_id, campaign_id, mail', 'required'),
			array('user_id, campaign_id', 'numerical', 'integerOnly'=>true),
			array('mail', 'length', 'max'=>100),
			array('mail', 'required'),
			array('mail', 'email'),
			array('status, added_type', 'length', 'max'=>8),
			array('sent_at', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, campaign_id, mail, sent_at, status, added_type', 'safe', 'on'=>'search'),
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
			'campaign' => array(self::BELONGS_TO, 'Campaign', 'campaign_id'),
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'campaign_id' => 'Campaign',
			'mail' => 'Mail',
			'sent_at' => 'Sent At',
			'status' => 'Status',
			'added_type' => 'Added Type',
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('campaign_id',$this->campaign_id);
		$criteria->compare('mail',$this->mail,true);
		$criteria->compare('sent_at',$this->sent_at,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('added_type',$this->added_type,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public static function findByUserCampaignAndMail($user_id, $campaign_id, $mail = null) // i think we can combine this function and findByUserAndCampaign function to one !!!!!!!!!!!!!!!! (a-to-do)(a-done)
    {
    	$query = 'user_id=:user_id AND campaign_id=:campaign_id';
    	$params = array(':user_id'=>$user_id, ':campaign_id'=>$campaign_id);
    		
    	if(isset($mail))
    	{
        	$query .= ' AND mail=:mail';
    		$params[':mail'] = $mail;
    	}
        return self::model()->find($query, $params);
    }

    /*public static function findByUserAndCampaign($user_id, $campaign_id)
    {
        return self::model()->find('user_id=:user_id AND campaign_id=:campaign_id', 
        	array(':user_id'=>$user_id, ':campaign_id'=>$campaign_id));
    }*/
}