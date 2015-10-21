<?php

class PayoutController extends Controller
{
    public $defaultAction = 'list';
    
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'list' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		$this->render('_form', array(
			'model'=>$model,
		));
	}

	public function actionUpdatePayout()
	{
		$response = array();
    	$response['result'] = 'fail';
    	$id = $_POST['Payout']['id'];
		$model = $this->loadModel($id);
		$model->attributes = $_POST['Payout'];
		$model->save() ? $response['result'] = 'success' : $response['errors'] = $model->getErrors();
		exit(json_encode($response));
   	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('list'));
	}

	public function actionConfirmPayment($id)
	{
        $model = $this->loadModel($id); 
        $model->status = 'completed';
        if($model->save())
			$this->redirect(array('list'));
		else
			$this->redirect(array('list'));
	}

	public function actionRejectPayment($id)
	{
        $model = $this->loadModel($id); 
        $model->status = 'rejected';
        if($model->save())
			$this->redirect(array('list'));     
	}

	public function actionPendingPayment($id)
	{
        $model = $this->loadModel($id); 
        $model->status = 'pending';
        if($model->save())
			$this->redirect(array('list'));     
	}

	/**
	 * Manages all models.
	 */
	public function actionList()
	{
		$model=new Payout;
        
        // to-do !!!!!!!!!!!!!!!!!!!!!!!!!
        $statistic = Payout::findStatistic(1);
        $data = array();
        $dataS = array();
        for ($i = 0; $i < count($statistic); $i++)
        {
            $data[strtotime($statistic[$i]['date'])] = $statistic[$i]['total'];
        }

        $days = \DateTime::createFromFormat('Y#m#d', $statistic[0]['date'])->diff(new \DateTime($statistic[count($statistic)]['date']))->days;
        
        for ($i = 0; $i < $days; $i++)
        {
            $day = strtotime($statistic[0]['date'] . "+" . $i . " day");
            $dataS[] = array(($day + 2 * 14400) * 1000, isset($data[$day]) ? (int)$data[$day] : 0);
        }
        // to-do !!!!!!!!!!!!!!!!!!!!!!!!!

		$this->render('list',array(
			'model'=>$model,
            'data'=>$dataS, // to-do !!!!!!!!!!!!!!!!!!!!!!!!!
		));
	}

	public function actionGrid()
	{
		$parametres = $_GET;
		$user_id = Yii::app()->user->id;
		$user=User::model()->findByPk($user_id);
		
		$providerConfig = jqCondition::getProviderConfig($parametres);
        $condition = empty($providerConfig['criteria']['condition']) ? '' : $providerConfig['criteria']['condition'] . ' AND ';
        $condition .= '(t.campaign_id IN (SELECT id FROM rf_campaign WHERE organization_id = ' . $user->organization_id . '))';
        $providerConfig['criteria']['condition'] = $condition;
		$providerConfig['criteria']['with'] = array('user', 'campaign');
		$dataProvider = new CActiveDataProvider('Payout', $providerConfig);
		
        $response = new stdClass;
		$response->page = $page;
		$response->records = $dataProvider->getTotalItemCount();
		$response->total = ceil($response->records / $parametres['rows']);
		$rows = $dataProvider->getData();
		
		foreach ($rows as $i=>$data) 
		{
			$buttons =  array();
			$buttons[] =  'update';
			if ($data->status != 'pending')
				$buttons[] =  array('pendingPayment', 'Pending Payment', 'id/' . $data->id);
			if ($data->status != 'completed')
				$buttons[] =  array('confirmPayment', 'Confirm Payment', 'id/' . $data->id);
			if ($data->status != 'rejected')
				$buttons[] =  array('rejectPayment', 'Reject Payment', 'id/' . $data->id);
			$buttons[] =  'delete';
			
			$response->rows[$i]['id'] = $data['id'];
			$response->rows[$i]['cell'] = array(
				$data->id,
				$data->user->mail,
				$data->user->first_name . ' ' . $data->user->last_name,
                $data->campaign->name,
				$data->amount,
				$data->end_amount,
                DateHandler::dateTimeView($data->created_at),
                $data->status,
				$data->payout_way,
				Payout::parseDetails($data->details),
				jqCondition::getGridButtons('payout', $data->id, $buttons)
            );
		}
		echo json_encode($response);
	}

	public function actionCheckMail()
	{
		$response = array();
		$response['result'] = 'fail';
		$response['campaign'] = '';
		$mail = $_POST['mail'];
			
		if(!empty($mail))
		{
			$response['errors'] = 'User with the entered email does not use the referral system';
			$user = User::findByMail($mail);
			if(!empty($user))
			{
				$user_id = $user->id;
				$frontUserId = Yii::app()->user->id;
				$frontUser = User::model()->findByPk($frontUserId);
				$organization_id = $frontUser->organization_id;
								
				$camapigns = Campaign::getCampaignsByUserOrganization($user_id, $organization_id);
				if(!empty($camapigns))
				{
					$response['result'] = 'success';
					$response['errors'] = '';
					$response['campaign'] = $camapigns; 
				}
			}
		}
		else
			$response['errors'] = 'Mail can\'t be blank';
		echo json_encode($response);
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
          
            $userMail = $_POST['User']['mail'];
            $campaign_id = $_POST['campaign'];
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
            	$country = Country::model()->findByPk($details['country']);
            	$details['country'] = $country->name;

            	$user = User::findByMail($userMail);
            	$user_id = $user->id;

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

	public function actionPaypal()
    {
        $this->renderPartial('_paypal');
    }

    public function actionWesternunion()
    {
        $this->renderPartial('_westernunion');
    }

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Payout the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Payout::model()->findByPk($id);
        $campaign=Campaign::model()->findByPk($model->campaign_id);
        $organization_id = (int) Yii::app()->user->getState('organization_id');
        if($model===null || $campaign->organization_id != $organization_id)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Payout $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='payout-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
