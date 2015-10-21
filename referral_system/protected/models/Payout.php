<?php

/**
 * This is the model class for table "{{payout}}".
 *
 * The followings are the available columns in table '{{payout}}':
 * @property integer $id
 * @property integer $user_id
 * @property integer $campaign_id
 * @property double $amount
 * @property double $end_amount
 * @property string $paid_at$created_at
 * @property string $status
 * @property string $payout_way
 * @property string $details
 *
 * The followings are the available model relations:
 * @property Campaign $campaign
 * @property User $user
 */

class Payout extends CActiveRecord
{
	public static $payoutWay = array(
		'paypal' => 'Paypal',
		'westernunion' => 'Westernunion'
	);

	public static $status = array(
		'pending' => 'Pending',
		'completed' => 'Completed',
		'rejected' => 'Rejected'
	);

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Payout the static model class
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
		return '{{payout}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			
			array('user_id, campaign_id, amount, status, payout_way, details', 'required'),
			array('user_id, campaign_id', 'numerical', 'integerOnly'=>true),
			array('amount, end_amount', 'numerical'),
			array('status', 'length', 'max'=>9),
			array('payout_way', 'length', 'max'=>12),
			array('details', 'length', 'max'=>255),
			array('created_at', 'safe'),
			array('id, user_id, campaign_id, amount, end_amount, created_at, status, payout_way, details', 'safe', 'on'=>'search'),
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
			'amount' => 'Amount',
			'end_amount' => 'End Amount',
			'created_at' => 'Created At',
			'paid_at' => 'Paid At',
			'status' => 'Status',
			'payout_way' => 'Payout Way',
			'details' => 'Details',
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
		$criteria->compare('amount',$this->amount);
		$criteria->compare('end_amount',$this->end_amount);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('payout_way',$this->payout_way,true);
		$criteria->compare('details',$this->details,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	protected function beforeSave()
	{
		if(parent::beforeSave())
		{	
			if(!$this->isNewRecord)
    		{
	    		$payout = self::model()->findByPk($this->id);
		 		$campaignUser = CampaignUser::findByUserAndCampaign($this->user_id, $this->campaign_id);
		 		
		 		switch ($this->status) // i think it will not count correctly !!!!!!!!!!!!!!!!!! (a-to-do) (a-done) //beforeSave or oldvalue
		 		{
		 			case 'completed':
		 				if($payout->status != 'completed')
							$campaignUser->amount_pending -= $this->amount;
		 				break;
		 			case 'rejected':
		 				if($payout->status != 'rejected' || $payout->status != 'completed')
		 				{
		 					$campaignUser->amount_pending -= $this->amount;
		 					$campaignUser->amount_earned += $this->amount;
		 				}
		 				break;
		 			case 'pending':
		 				if($payout->status != 'pending' || $payout->status != 'completed')
		 				{
		 					$campaignUser->amount_earned -= $this->amount;
		 					$campaignUser->amount_pending += $this->amount;
		 				}
		 				break;
		 		}
		 		$campaignUser->save();
	    	}
	    	return true;
	    }
		else
			return false;
	}

	protected function beforeDelete()
	{
		$result = false;
		if(parent::beforeDelete())
		{	
			$result = true;
			if($this->status == 'pending')
			{
				$campaignUser = CampaignUser::findByUserAndCampaign($this->user_id, $this->campaign_id);
				$campaignUser->amount_pending -= $this->amount;
		 		$campaignUser->amount_earned += $this->amount;
		 		if (!$campaignUser->save())
		 			$result = false;
			}
		}
		return $result;
	}

  	/*protected function afterSave()
	{
		parent::afterSave();
	    if(!$this->isNewRecord)
    	{
	 		$campaignUser = CampaignUser::findByUserAndCampaign($this->user_id, $this->campaign_id);
	 		switch ($this->status) // i think it will not count correctly !!!!!!!!!!!!!!!!!! (a-to-do) //beforeSave or oldvalue
	 		{
	 			case 'completed':
					$campaignUser->amount_pending -= $this->amount;
	 				break;
	 			case 'rejected':
	 				$campaignUser->amount_pending -= $this->amount;
	 				$campaignUser->amount_earned += $this->amount;
	 				break;
	 			case 'pending':
	 				$campaignUser->amount_earned -= $this->amount;
	 				$campaignUser->amount_pending += $this->amount;
	 				break;
	 		}
	 		$campaignUser->save();
	 	}
   	}*/

	public static function parseDetails($details)
	{
		$result = '';
		$resArray = array();
        $details = json_decode($details, true);
        if (empty($details))
            return '';
		foreach ($details as $key => $value) 
			$resArray[] = ucwords(str_replace('_', ' ', $key)) . ': ' . $value;
		return implode(', ', $resArray);
	}

   	public static function findByUserAndCampaign($user_id, $campaign_id)
    {
        return self::model()->find('user_id=:user_id AND campaign_id=:campaign_id', 
        	array(':user_id'=>$user_id, ':campaign_id'=>$campaign_id));
    }
    
   	public static function findStatistic($campaign_id)
    {
		$query = 'campaign_id = :campaign_id';
		$params = array(':campaign_id' => $campaign_id);

		$result = Yii::app()->db->createCommand()
			->select('DATE(created_at) AS date, COUNT(id) AS total')
			->from('rf_payout')
			//->where($query, $params)
            ->group('DATE(created_at)')
            ->order('DATE(created_at)')
			->queryAll();

        return $result;
    }
}