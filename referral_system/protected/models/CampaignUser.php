<?php

/**
 * This is the model class for table "{{campaign_user}}".
 *
 * The followings are the available columns in table '{{campaign_user}}':
 * @property integer $id
 * @property integer $user_id
 * @property integer $campaign_id
 * @property double $amount_earned
 * @property double $amount_pending
 * @property string $active
 * @property string $code
 *
 * The followings are the available model relations:
 * @property User $user
 * @property Campaign $campaign
 */
class CampaignUser extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CampaignUser the static model class
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
		return '{{campaign_user}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, campaign_id, code', 'required'),
			array('user_id, campaign_id', 'numerical', 'integerOnly'=>true),
			array('amount_earned, amount_pending', 'numerical'),
			array('active', 'length', 'max'=>3),
			array('code', 'length', 'max'=>16),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, campaign_id, amount_earned, amount_pending, active, code', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
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
			'user_id' => 'User',
			'campaign_id' => 'Campaign',
			'amount_earned' => 'Amount Earned',
			'amount_pending' => 'Amount Pending',
			'active' => 'Active',
			'code' => 'Code',
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
		$criteria->compare('amount_earned',$this->amount_earned);
		$criteria->compare('amount_pending',$this->amount_pending);
		$criteria->compare('active',$this->active,true);
		$criteria->compare('code',$this->code,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public static function findByUserAndCampaign($user_id, $campaign_id)
    {
        $params=array(
            ':user_id'=>$user_id,
            ':campaign_id'=>$campaign_id,
        );
        return self::model()->find('user_id=:user_id AND campaign_id=:campaign_id', $params);
    }
    
    public static function addWithUserAndCampaign($user_id, $campaign_id)
    {
        $model = new CampaignUser;
        $model->user_id = $user_id;
        $model->campaign_id = $campaign_id;
        $model->code = CodeGenerator::generateCode();;
        return $model->save();
    }

    public static function getUserAmount($campaign_id)
    {
    	$query = 'campaign_id = :campaign_id';
		$params = array(':campaign_id' => $campaign_id);
		return self::model()->count($query, $params);
    }
}