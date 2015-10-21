<?php

class TwitterController extends Controller
{
	public function actionSendTweet()
    {
        $response = array();
        $response['result'] = 'fail';
        $response['token'] = true;
        $access_token = Yii::app()->session['access_token'];
        
        if(isset($_REQUEST['tweet-text']))
            Yii::app()->session['tweet-text'] = $_REQUEST['tweet-text'];
        
        if(Yii::app()->request->isAjaxRequest)
        {
            if(!empty(Yii::app()->session['tweet-text']))
            {   
                if(isset($access_token))
                    $this->sendMessage($access_token, $response);
                else
                {
                    $response['token'] = false;
                    $response['url'] = $this->actionLoginUrl();
                }
            }
            else
               $response['errors'] = 'Tweet can\'t be blank';
            exit(json_encode($response));
        } 
        if(isset($access_token))
        {
            $this->sendMessage($access_token, $response);
            $this->render('twitterSend', array('response'=>$response));
        }
    }

    public function sendMessage($token, &$response) // = _sendMessage !!!!!!!!!!!!!!!!! (a-to-do)(a-done)
    {
        $twitter = Yii::app()->twitter->getTwitterTokened($token['oauth_token'], $token['oauth_token_secret']);
        $result = $twitter->post('statuses/update', array('status' => Yii::app()->session['tweet-text']));
        if(isset($result->errors[0]))
            $response['errors'] = $result->errors[0]->message;
        else
        {
            $response['result'] = 'success';
            unset(Yii::app()->session['tweet-text']);
        }    
    }

    public function actionGetToken()
    {
        if(!isset($_REQUEST['oauth_token']))
        {
            $twitter = Yii::app()->twitter->getTwitter();
            $request_token = $twitter->getRequestToken(NULL);
            
            Yii::app()->session['oauth_token'] = $token = $request_token['oauth_token'];
            Yii::app()->session['oauth_token_secret'] = $request_token['oauth_token_secret'];
            
            if($twitter->http_code == 200)
            {
                $url = $twitter->getAuthorizeURL($token);
                $this->redirect($url);
            } else {
                $this->redirect(Yii::app()->homeUrl);
            }
        }
        else
        {
            /* If the oauth_token is old redirect to the connect page. */
            if (isset($_REQUEST['oauth_token']) && Yii::app()->session['oauth_token'] !== $_REQUEST['oauth_token'])
            {
                Yii::app()->session['oauth_status'] = 'oldtoken';
            }
            /* Create TwitteroAuth object with app key/secret and token key/secret from default phase */
            $twitter = Yii::app()->twitter->getTwitterTokened(Yii::app()->session['oauth_token'], Yii::app()->session['oauth_token_secret']);   
            /* Request access tokens from twitter */
            $access_token = $twitter->getAccessToken($_REQUEST['oauth_verifier']);
            /* Save the access tokens. Normally these would be saved in a database for future use. */
            Yii::app()->session['access_token'] = $access_token;
            /* Remove no longer needed request tokens */
            unset(Yii::app()->session['oauth_token']);
            unset(Yii::app()->session['oauth_token_secret']);
            
            if (200 == $twitter->http_code) 
            {
                /* The user has been verified and the access tokens can be saved for future use */
                Yii::app()->session['status'] = 'verified';
                $this->redirect(array('sendTweet'));
            } else {
                $this->redirect(Yii::app()->homeUrl);
            }
        }
    }

	public function actionLoginUrl()
    {
        return Yii::app()->request->getBaseUrl(true) . '/track/twitter/getToken';
    }
}