<?php

class UserController extends Controller
{
    public $defaultAction = 'profile';
    
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',   // allow all users to perform actions
				'users'=>array('@'),
			),
			array('allow',
				'actions'=>array('register','confirm','restorePassword','verify'),
				'users'=>array('?'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
    
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
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionProfile()
	{
		$user_id = Yii::app()->user->id;
        $model = $this->loadModel($user_id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			if($model->save())
				$this->redirect(array('profile'));
		}

		$this->render('profile',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate()
	{
		$user_id = Yii::app()->user->id;
        $model = $this->loadModel($user_id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			if($model->save())							//(a-done)
				$this->redirect(array('profile'));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	public function actionDeleteImage($id)
	{
		$response = array();
		$response['result'] = 'fail';
		$user_id = Yii::app()->user->id;
		$model = $this->loadModel($id);
		if(!empty($model))
		{
			$image = new Image('user');
			$image->deleteImage($model->image);
			$model->image = '';
			if($model->save())
				$response = 'success';
		}
		exit (json_encode($response));
	}

	public function actionVerify($id, $code)
	{
		$result = 'fail';
		$user = User::model()->findByPk($id);
		$invite = Invitation::findByUserAndCode($id, $code);
        $organization = null;
		if (!empty($user) && !empty($invite))
		{
            $organization = Organization::model()->findByPk($invite->organization_id);
			$invite->status = 'registered';
			$user->organization_id = $invite->organization_id;
			$user->verified = 'yes';
            if ($user->type == 'user')
				$user->type = 'insider';
			if ($invite->save() && $user->save())
				$result = 'success';
		}
		$this->render('verify', array(
            'result'=>$result,
            'organization'=>$organization,
        ));
	}
    
	/**
	 * Displays the change password page
	 */
	public function actionChangePassword()
	{
		$model=new PasswordForm(false);

		// Collect user input data
		if(isset($_POST['PasswordForm']))
		{
			$model->attributes=$_POST['PasswordForm'];
			if($model->validate())
            {
                $user = User::model()->findByPk(Yii::app()->user->id);
                $user->password = $user->hashPassword($model->password);
                if ($user->save())
				    $this->redirect('profile');
            }
		}
        // display the change password form
		$this->render('changePassword',array(
            'model'=>$model,
        ));
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
           	$model->type = 'insider';
			if($model->save() && Mailer::sendRegistration($model, $password))
	            $response['result'] = 'success';
            else
                $response['errors'] = $model->getErrors();
		}
        exit(json_encode($response));
	}

    public function actionConfirm()
    {
		$model=new LoginForm('insider');
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
                $user->verified = 'yes';
				$user->save();
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
				$response['errors'] = array('mail' => array('User with entered password is not found.'));
		}
        
        exit(json_encode($response));
	}
    
    public function actionRegistered()
    {
        $this->render('registered');
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
