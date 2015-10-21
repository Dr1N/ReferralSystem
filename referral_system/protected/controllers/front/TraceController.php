<?php

class TraceController extends Controller
{
    private static $_trackParam = 'rs_trck';
    private static $_trackPreg = '/(&|\?)(rs_trck=(?P<param>(\w)+))(&|$)/';
    
	public function actionClick($campaign_id, $code_id)
	{
        $userId = $this->getUserIdFromHttp();        
        $usedWay = $this->getUsedWay();        
        $user = $this->loadUser($userId);
        $campaign = $this->loadCampaign($campaign_id, $code_id);
        
        /*$clickInfo = array(
            'owner_id' => $userId,
            'campaign_id' => $campaign_id,
            'used_way' => $usedWay,
            'ip_address' => ip2long(Yii::app()->geoip->getMyIpAddress()),
        );
        $model = CampaignClick::model()->find('owner_id=:owner_id AND campaign_id=:campaign_id AND used_way=:used_way AND ip_address=:ip_address', $clickInfo);*/ // needs to be tested !!!!!!!!!!!!!
        $ip_address = ip2long(Yii::app()->geoip->getMyIpAddress());
        $model = CampaignClick::findByParams($campaign_id, $usedWay, $userId, $ip_address);
        if ($model == null) {
            $model = new CampaignClick;
            $model->attributes=$clickInfo;
        }
        $model->clicked_at = DateHandler::now();
        $model->save();
        
        $this->_exit(false);
	}
    
	public function actionPurchase($campaign_id, $code_id, $purchase_id = null)
	{
        $userId = $this->getUserIdFromCookie();        
        $user = $this->loadUser($userId);
        $campaign = $this->loadCampaign($campaign_id, $code_id);

        /*$clickInfo = array(
            'owner_id' => $userId,
            'campaign_id' => $campaign_id,
            'ip_address' => ip2long(Yii::app()->geoip->getMyIpAddress()),
        );
        $click = CampaignClick::model()->find('owner_id=:owner_id AND campaign_id=:campaign_id AND ip_address=:ip_address', $clickInfo);*/
        $ip_address = ip2long(Yii::app()->geoip->getMyIpAddress());
        $click = CampaignClick::findByParams($campaign_id, null, $userId, $ip_address); // needs to be tested !!!!!!!!!!!!!
		if($click===null)
			$this->_exit();
        
		$model = new CampaignPurchase;
        $model->attributes=$clickInfo;
        $model->used_way = $click->used_way;
        $model->amount = $campaign->setting->referral_prize;
        // purchase_id // !!!!!!!
        $model->paid_at = DateHandler::now();
        $model->save();
        
        $this->_exit(false);
	}
    
    public function getUserIdFromHttp()
    {
        $httpReferer = parse_url($_SERVER['HTTP_REFERER']);
        preg_match(self::$_trackPreg, $httpReferer['query'], $matches);
        if (empty($matches['param']))
            $this->_exit();
        
        $refererStr = $matches['param'];
        $refererParam = explode('_', $refererStr);
        $userId = (int) $refererParam[0];
        if (empty($userId))
            $this->_exit();
        
        Yii::app()->request->cookies[self::$_trackParam] = new CHttpCookie(self::$_trackParam, $refererStr);
        
        return $userId;        
    }
    
    public function getUserIdFromCookie()
    {
        $refererStr = Yii::app()->request->cookies[self::$_trackParam]->value;
        if (empty($refererStr))
            $this->_exit();
        $refererParam = explode('_', $refererStr);
        $userId = (int) $refererParam[0];
        if (empty($userId))
            $this->_exit();
        
        return $userId;        
    }
    
    public function getUsedWay()
    {
        return 'link';
    }
    
	/**
	 * Returns the campaign model based on the primary key and the code field given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @param string $code the campaign code field of the model to be loaded
	 * @return Campaign the loaded model
	 * @throws CHttpException
	 */
	public function loadCampaign($id, $code)
	{
        if (empty($id))
            $this->_exit();
        
		$model=Campaign::model()->findByPk($id);
		if($model===null || $model->code != $code)
			$this->_exit();
		return $model;
	}
    
	/**
	 * Returns the user model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return User the loaded model
	 * @throws CHttpException
	 */
	public function loadUser($id)
	{
        if (empty($id))
            $this->_exit();
        
		$model=User::model()->findByPk($id);
		if($model===null)
			$this->_exit();
		return $model;
	}
    
    private function _exit($error = true)
    {
        exit($error ? '0' : '1');
    }
}