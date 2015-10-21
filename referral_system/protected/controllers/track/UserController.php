<?php

class UserController extends Controller
{
	public function actionUpdate()
	{
		$user = $this->loadModel(Yii::app()->user->id);
        $response = array();
        $response['result'] = 'fail';
               
        if(Yii::app()->request->isAjaxRequest)
        {
        	$user->attributes = $_POST['User'];
        	$user->birthday = DateHandler::date($user->birthday);
        	if($user->save())
                $response['result'] = 'success';
            else
                $response['errors'] = $user->getErrors();
        }
        
        exit(json_encode($response));
    }

    public function actionChangePassword()
	{
		$model = new PasswordForm(false);
		$user = $this->loadModel(Yii::app()->user->id);
        $response = array();
        $response['result'] = 'fail';
               
        if(Yii::app()->request->isAjaxRequest)
        {
        	$model->attributes = $_POST["PasswordForm"];
            $user->password = $user->hashPassword($model->password);
        	if($model->validate() && $user->save())
                $response['result'] = 'success';
            else
                $response['errors'] = array_merge($user->getErrors(), $model->getErrors());
        }
       	
        exit(json_encode($response));
    }
    
	public function actionRegister()
	{
		$model = new User;
        $response = array();
        $response['result'] = 'fail';
        
		if(isset($_POST['mail']))
		{
			$model->mail=$_POST['mail'];
        	$password = CodeGenerator::generatePassword();
            $model->password = $password;
            if($model->save() && Mailer::sendRegistration($model, $password))
	            $response['result'] = 'success';
            else
                $response['errors'] = $model->getErrors();
		}
        
        exit(json_encode($response));
	}
    
    public function actionConfirm()
    {
		$model=new LoginForm('user');
        $response = array();
        $response['result'] = 'fail';

		if(isset($_POST['mail']) && isset($_POST['password']))
		{
			$model->username = $_POST['mail'];
            $model->password = $_POST['password'];
            
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
			{
				$user_id = Yii::app()->user->id;
				$user = User::model()->findByPk($user_id);
                $user->verified='yes';
				$user->save();
                $campaign_id = (int) Yii::app()->session['campaign_id'];
                $campaignUser = CampaignUser::findByUserAndCampaign($user_id, $campaign_id);
                if(!$campaignUser)
                    CampaignUser::addWithUserAndCampaign($user_id, $campaign_id);
                $response['result'] = 'success';
			} else {
                $response['errors'] = $model->getErrors();
            }

		}
        
        exit(json_encode($response));
    }
    
	public function actionRestorePassword()
	{
		$model = new User;
		$response = array();
        $response['result'] = 'fail';
        
		if(isset($_POST['mail']))
		{
            $model->mail = $_POST['mail'];          
            $user = User::findByMail($model->mail);
			
			if ($user)
			{
				$password = CodeGenerator::generatePassword();
				$user->password = $user->hashPassword($password);
                if ($user->save() && Mailer::sendRestorePassword($user, $password))
                	$response['result'] = 'success';
                else
                    $response['errors'] = $user->getErrors();
            }
            elseif (!$model->validate())
            	$response['errors'] = $model->getErrors();
			else
				$response['errors'] = array('mail' => array('The entered mail is not registered.'));
		}
        
        exit(json_encode($response));
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
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return User the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=User::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
}