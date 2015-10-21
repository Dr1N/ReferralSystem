<?php

class SiteController extends AdminController
{
    public $defaultAction = 'login';
    
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
				'actions'=>array('login'),
				'users'=>array('?'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
    
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
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
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm('admin');

		// If it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// Collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// Validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
            {
            	$user_id = Yii::app()->user->id;
				$user = User::model()->findByPk($user_id);
				if ($user->save())
				{
	                if (Yii::app()->user->returnUrl != '/')
					    $this->redirect(Yii::app()->user->returnUrl);
	                else
	                    $this->redirect(Yii::app()->user->returnUrl . 'admin');
                }
            }
		}
		// Display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl . 'admin');
	}
	
	/**
	 * The help page.
	 */
	public function actionHelp()
	{
		$this->render('help');
	}
}