<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}
    
	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}

	/**
	 * Displays the index page
	 */
	public function actionIndex($id, $code)
	{
        Yii::app()->session['campaign_id'] = (int) $id;
        
		$loginModel = new LoginForm('user');
        $userModel = new User;
        $passwordModel = new PasswordForm(false);
        $campaign = $this->loadCampaign($id, $code);
        $campaignUser = CampaignUser::findByUserAndCampaign(Yii::app()->user->id, $id);
		
		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($loginModel);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$loginModel->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($loginModel->validate() && $loginModel->login())
			{
                $user_id = Yii::app()->user->id;
                $campaignUser = CampaignUser::findByUserAndCampaign($user_id, $id);
                if(!$campaignUser)
                    CampaignUser::addWithUserAndCampaign($user_id, $id);
                if (Yii::app()->user->returnUrl != '/')
				    $this->redirect(Yii::app()->user->returnUrl);
                else
                    $this->redirect(Yii::app()->request->url);
			}
		}
        
        $user = null;
        if(!Yii::app()->user->isGuest)
            $user = $this->loadUser(Yii::app()->user->id);
        
		$this->render('index', array(
            'campaign'=>$campaign,
            'user'=>$user,
            'loginModel'=>$loginModel,
            'userModel'=>$userModel,
            'passwordModel'=>$passwordModel,
            'campaignUser'=>$campaignUser,
        ));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
        $this->redirect(Yii::app()->request->urlReferrer);
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
		$model=Campaign::model()->findByPk($id);
		if($model===null || $model->code != $code)
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