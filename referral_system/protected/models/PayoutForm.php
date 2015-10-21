<?php

class PayoutForm extends CFormModel
{
	public $amount;
	public $payout_way;
	public $mail;
	public $first_name;
	public $last_name;
	public $country;
	public $city;
	public $minPayout;
		
	public function rules()
	{
		$specialRuls = array();
		$generalRuls = array(
			array('amount', 'required'),
			array('amount', 'numerical', 'min'=>$this->minPayout), // needs to check for 0 !!!!!!!!!!!!!!!!!!!!!!!
			array('amount', 'validateAmount'),
		);
		
		switch ($this->payout_way) 
		{
			case 'paypal':
				$specialRuls = array(
					array('mail', 'required'),
					array('mail', 'email'),
				);
				break;
			
			case 'westernunion':
				$specialRuls =  array(
					array('first_name', 'required'),
					array('last_name', 'required'),
					array('country', 'required'),
					array('city', 'required'),
					array('first_name, last_name, city, country', 'length', 'max'=>100),
				);
				break;
		}
		
		return array_merge($generalRuls, $specialRuls);
	}

	public function attributeLabels()
	{
		return array(
			'amount' => 'Amount',
			'payout_way' => 'Payout Way',
			'mail'=>'E-mail',
			'first_name' => 'First Name',
			'last_name' => 'Last Name',
			'country' => 'Country',
			'city' => 'City',
		);
	}

	public function validateAmount()
	{
		$user_id = Yii::app()->user->id;
        $campaign_id = (int) Yii::app()->session['campaign_id'];
        $campaignUser = CampaignUser::findByUserAndCampaign($user_id, $campaign_id);
        
        if($this->amount <= 0)
        	$this->addError('amount', 'Amount must be a positive number.');	
        else if($this->amount > $campaignUser->amount_earned)
            $this->addError('amount', 'Attempt to pay out more funds than you currently have.');	
	}
}
?>