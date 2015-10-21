<?php

class MailController extends Controller
{
	public function actionSendMail()
	{
		$response = array();
        $response['result'] = 'fail';
        $user_id = Yii::app()->user->id;
        $campaign_id = (int) Yii::app()->session['campaign_id'];
       
        if(Yii::app()->request->isAjaxRequest)
        {
            $models = array();
        	$mails = trim($_POST['mails']);
        	$mailsList = explode(',', $mails);
        	$mailsList = array_unique($mailsList);
        	$isValid = true;
        	
			foreach ($mailsList as $mail) 
        	{	
                $model = new ImportedMail;
				$model->user_id = $user_id;
				$model->campaign_id = $campaign_id;
        		$model->mail = trim($mail);
                $model->status = 'sent';
                $models[] = $model;
    			if (!$model->validate())
    			{
    				$isValid = false;
    				$response['errors'] = $model->getErrors();
    			}
           	}
			
			if (!$_POST['message'])
			{	
				$isValid = false;
				$response['errors']['message'] = array('Message cannot be blank.');
			}
			
			if ($isValid)
			{
				$message = $_POST['message'];
				$user = $this->loadUser($user_id);
				$campaign = $this->loadCampaign($campaign_id);
				for($i = 0; $i < count($models); $i++)
				{
                    $model = ImportedMail::findByUserCampaignAndMail($user_id, $campaign_id, $models[$i]->mail);
                    if(!$model) 
						$model = $models[$i];
					$model->sent_at = DateHandler::now();
					
					if ($model->save() && Mailer::sendReferral($model->mail, $message, $user, $campaign))
						$response['result'] = 'success';
					else
						$response['errors'] = $model->getErrors();
				}
			}
        }

        exit(json_encode($response));
	}
   
   	public function actionList()
	{
        $user_id = Yii::app()->user->id;
        $campaign_id = (int) Yii::app()->session['campaign_id'];
		$model = ImportedMail::findByUserCampaignAndMail($user_id, $campaign_id);
        $this->renderPartial('_list', array(
			'model'=>$model,
		));
    }
    
    public function actionMailGrid()
    {
    	$parametres = $_GET;
        $user_id = Yii::app()->user->id;
        $campaign_id = (int) Yii::app()->session['campaign_id'];

		$providerConfig = jqCondition::getProviderConfig($parametres);
        $condition = empty($providerConfig['criteria']['condition']) ? '' : $providerConfig['criteria']['condition'] . ' AND ';
        $condition .= '(t.user_id=' . $user_id . ' AND t.campaign_id=' . $campaign_id . ')';
        $providerConfig['criteria']['condition'] = $condition;
		$dataProvider = new CActiveDataProvider('ImportedMail', $providerConfig);
		$response = new stdClass;
		$response->page = $page;
		$response->records = $dataProvider->getTotalItemCount();
		$response->total = ceil($response->records / $parametres['rows']);
		$rows = $dataProvider->getData();
		
		foreach ($rows as $i=>$data) {
			$response->rows[$i]['id'] = $data['id'];
			$response->rows[$i]['cell'] = array(
				$data->mail,
                DateHandler::dateTimeView($data->sent_at),
				$data->status,
				$data->added_type,
				CHtml::CheckBox('ckeck-box', false, array('class' => 'mail-box', 'value' => $data->mail)),
			);
		}
		
		echo json_encode($response);
    }
   
	/**
	 * Returns the campaign model based on the primary key and the code field given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Campaign the loaded model
	 * @throws CHttpException
	 */
	public function loadCampaign($id)
	{
		$model=Campaign::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
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
		$model=User::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
}