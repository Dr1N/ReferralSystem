<?php

class PayoutController extends Controller
{
	/**
	 * Displays the rewards page
	 */
	public function actionStatistic()
	{
        $campaign_id = (int) Yii::app()->session['campaign_id'];
        $user_id = Yii::app()->user->id;
        $payoutModel = Payout::findByUserAndCampaign($user_id, $campaign_id);
       
        $statistic = array(
        	'clicks' => array(
        		'mail' => CampaignClick::getClicksAmount($campaign_id, 'mail', $user_id),
        		'facebook' => CampaignClick::getClicksAmount($campaign_id, 'facebook', $user_id),
        		'twitter' => CampaignClick::getClicksAmount($campaign_id, 'twitter', $user_id),
        		'link' => CampaignClick::getClicksAmount($campaign_id, 'link', $user_id),
        	),
        	'purchases' => array(
        		'mail' => CampaignPurchase::getPurchaseAmount($campaign_id, 'mail', $user_id),
        		'facebook' => CampaignPurchase::getPurchaseAmount($campaign_id, 'facebook', $user_id),
        		'twitter' => CampaignPurchase::getPurchaseAmount($campaign_id, 'twitter', $user_id),
        		'link' => CampaignPurchase::getPurchaseAmount($campaign_id, 'link', $user_id),
        	),
        	'total' => array(
        		'mail' => CampaignPurchase::getPurchaseTotal($campaign_id, 'mail', $user_id),
        		'facebook' => CampaignPurchase::getPurchaseTotal($campaign_id, 'facebook', $user_id),
        		'twitter' => CampaignPurchase::getPurchaseTotal($campaign_id, 'twitter', $user_id),
        		'link' => CampaignPurchase::getPurchaseTotal($campaign_id, 'link', $user_id),
        	),
        );

		$this->renderPartial('_statistic',array(
			'statistic' => $statistic,
            'payoutModel' => $payoutModel,
		));
	}

	public function actionPayoutGrid()
    {
        $parametres = $_GET;
        $user_id = Yii::app()->user->id;
        $campaign_id = (int) Yii::app()->session['campaign_id'];
        
        $providerConfig = jqCondition::getProviderConfig($parametres);
        $condition = empty($providerConfig['criteria']['condition']) ? '' : $providerConfig['criteria']['condition'] . ' AND ';
        $condition .= '(t.user_id=' . $user_id . ' AND t.campaign_id=' . $campaign_id . ')';
        $providerConfig['criteria']['condition'] = $condition;
        $dataProvider = new CActiveDataProvider('Payout', $providerConfig);
        $response = new stdClass;
        $response->page = $page;
        $response->records = $dataProvider->getTotalItemCount();
        $response->total = ceil($response->records / $parametres['rows']);
        $rows = $dataProvider->getData();
        
        foreach ($rows as $i=>$data) {
            $response->rows[$i]['id'] = $data['id'];
            $response->rows[$i]['cell'] = array(
                $data->status,
                DateHandler::dateTimeView($data->created_at),
                Payout::parseDetails($data->details),
                $data->amount,
                $data->end_amount,
            );
        }
        
        exit(json_encode($response));
    }

    public function actionCreate()
    {
        $user_id = Yii::app()->user->id;
        $campaign_id = (int) Yii::app()->session['campaign_id'];
        
        $user = $this->loadUser($user_id);
        $campaignUser = CampaignUser::findByUserAndCampaign($user_id, $campaign_id);
        
        $this->renderPartial('_create',array(
            'user' => $user,
            'campaignUser' => $campaignUser,
        ));
    }

    public function actionPaypal()
    {
        $this->renderPartial('_paypal');
    }

    public function actionWesternunion()
    {
        $this->renderPartial('_westernunion');
    }

    public function actionCreatePayout() // !!!!!!!!!!!!! check and refactoring
    {
        $response = array();
        $response['result'] = 'fail';
        $response['errors'] = 'empty';
        
        if(Yii::app()->request->isAjaxRequest)
        {
            $payoutModel = new Payout;
            $payoutForm = new PayoutForm;
            $campaign_id = (int) Yii::app()->session['campaign_id'];
            $campaignSetting = CampaignSetting::findByCampaignId($campaign_id);

            $payoutForm->amount = $_POST['amount'];
            $payoutForm->payout_way = $_POST['payout_way'];
            $payoutForm->minPayout = $campaignSetting->min_payout;
            $details = null;
            
            switch ($payoutForm->payout_way)
            {
                case 'paypal':
                    $details = $_POST['Paypal'];
                    break;
                case 'westernunion':
                    $details = $_POST['Westernunion'];
                    break;
            }
            
            $payoutForm->attributes = $details;
            
            if($payoutForm->validate())
            {
                $user_id = Yii::app()->user->id;
                $campaignUser = CampaignUser::findByUserAndCampaign($user_id, $campaign_id);
                
                $campaignUser->amount_pending += $_POST['amount'];
                $campaignUser->amount_earned -= $_POST['amount'];

                $payoutModel->user_id = $user_id;
                $payoutModel->campaign_id = $campaign_id;
                $payoutModel->payout_way = $_POST['payout_way'];
                $payoutModel->amount = $_POST['amount'];
                $payoutModel->end_amount = $campaignUser->amount_earned;
                $payoutModel->created_at = DateHandler::now();
                $payoutModel->status = 'pending';
                $payoutModel->details = json_encode($details);
                
                if($payoutModel->save())
                {
                    if($campaignUser->save())
                        $response['result'] = 'success';
                    else
                        $response['errors'] = $campaignUser->getErrors(); // the same row once !!!!!!!!!!!!!! (a-to-do) (???)
                }
                else
                    $response['errors'] = $payoutModel->getErrors(); // the same row twice !!!!!!!!!!!!!! (a-to-do) (???)
            }
            else
            {
                $response['errors'] = $payoutForm->getErrors(); // the same row the third time !!!!!!!!!!!!!! (a-to-do) (???)
            }
        }

        exit(json_encode($response));
    }

    /**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return User the loaded model
	 * @throws CHttpException
	 */
	public function loadUser($id)
	{
		$user=User::model()->findByPk($id);
		if($user===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $user;
	}
}