<?php

class FacebookController extends Controller
{
	public function actionSendFacebook()
    {
        $response = array();
       	$response['result'] = 'fail';
       	
        if(isset($_REQUEST['facebook-text']))                      //save message
            Yii::app()->session['facebook-text'] = $_REQUEST['facebook-text'];

        if(Yii::app()->request->isAjaxRequest)					   //from widget   
        {
            if(!empty(Yii::app()->session['facebook-text']))
            { 
    			$userid = Yii::app()->facebook->getUser();
    			if(!$userid)        								//no user - get authorization link
    			{
    				$params = array(
    					'scope' => 'publish_stream',
    				);
    				$loginUrl = Yii::app()->facebook->getLoginUrl($params);
    				$response['url'] = $loginUrl;
    			}
    			else 												//send message
    				$this->_sendMessage($response);
            }
            else
                $response['errors'] = 'Message can\'t be blank';
			
			exit(json_encode($response));
        }
        else
        { 												    	   //from facebook(after authorization) in popup window
            $this->_sendMessage($response);
            $this->render('facebookSend', array('response'=>$response));
        }
    }

    private function _sendMessage(&$response)
    {
        /*$campaign_id = (int) Yii::app()->session['campaign_id'];
        $model = CampaignSetting::findByCampaignId($campaign_id);
        $message = $model->message_facebook;*/

        $message = Yii::app()->session['facebook-text'];
        try
        {
            $data = array('message'=>$message);
            $results = Yii::app()->facebook->api("/me/feed", "POST", $data);
            $response['result'] = 'success';
            unset(Yii::app()->session['facebook-text']);
        }
        catch(FacebookApiException $e)
        {
            $response['errors'] = $e->getMessage();
        }
    }
}