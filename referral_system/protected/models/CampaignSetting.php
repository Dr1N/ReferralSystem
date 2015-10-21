<?php

/**
 * This is the model class for table "{{campaign_setting}}".
 *
 * The followings are the available columns in table '{{campaign_setting}}':
 * @property integer $id
 * @property integer $campaign_id
 * @property double $referral_prize
 * @property double $recipient_prize
 * @property double $min_payout
 * @property string $message_mail
 * @property string $message_facebook
 * @property string $message_twitter
 * @property string $enable_mail
 * @property string $enable_facebook
 * @property string $enable_twitter
 * @property string $enable_link
 *
 * The followings are the available model relations:
 * @property Campaign $campaign
 */
class CampaignSetting extends CActiveRecord
{
    private static $_minPrize = 0.1;
    private static $_minPayout = 1;
    
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CampaignSetting the static model class
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
		return '{{campaign_setting}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array('campaign_id, referral_prize, recipient_prize, min_payout', 'required'),
            array('message_mail, message_facebook', 'default', 'value'=>''),
			array('campaign_id', 'numerical', 'integerOnly'=>true),
			array('referral_prize, recipient_prize,', 'numerical', 'min'=>self::$_minPrize),
			array('min_payout', 'numerical', 'min'=>self::$_minPayout),
			array('message_twitter', 'length', 'max'=>140),
			array('enable_mail, enable_facebook, enable_twitter, enable_link', 'length', 'max'=>3),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, campaign_id, referral_prize, recipient_prize, min_payout, message_mail, message_facebook, message_twitter, enable_mail, enable_facebook, enable_twitter, enable_link', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'campaign_id' => 'Campaign',
			'referral_prize' => 'Referral Prize',
			'recipient_prize' => 'Recipient Prize',
			'min_payout' => 'Min Payout',
            'message_mail' => 'Mail Message',
            'message_facebook' => 'Facebook Message',
            'message_twitter' => 'Twitter Message',
			'enable_mail' => 'Enable Mail',
			'enable_facebook' => 'Enable Facebook',
			'enable_twitter' => 'Enable Twitter',
			'enable_link' => 'Enable Link',
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
		$criteria->compare('campaign_id',$this->campaign_id);
		$criteria->compare('referral_prize',$this->referral_prize);
		$criteria->compare('recipient_prize',$this->recipient_prize);
		$criteria->compare('min_payout',$this->min_payout);
		$criteria->compare('message_mail',$this->message_mail,true);
		$criteria->compare('message_facebook',$this->message_facebook,true);
		$criteria->compare('message_twitter',$this->message_twitter,true);
		$criteria->compare('enable_mail',$this->enable_mail,true);
		$criteria->compare('enable_facebook',$this->enable_facebook,true);
		$criteria->compare('enable_twitter',$this->enable_twitter,true);
		$criteria->compare('enable_link',$this->enable_link,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    /*protected function afterConstruct()
    {
        $this->referral_prize = self::$_minPrize;
        $this->recipient_prize = self::$_minPrize;
        $this->min_payout = self::$_minPayout;
        return parent::afterConstruct();
    }*/

    public static function findByCampaignId($campaign_id)
    {
        return self::model()->find('campaign_id=:campaign_id', array(':campaign_id'=>$campaign_id));
    }   
}