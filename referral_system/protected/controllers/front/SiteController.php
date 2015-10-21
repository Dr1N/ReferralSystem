<?php

class SiteController extends Controller
{
    public $defaultAction = 'index';
    
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */

    
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
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				if(Mailer::sendContact($model))
				{
					Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
					$this->refresh();
				}
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the index page
	 */
	public function actionIndex()
	{
		$model=new LoginForm('insider');
        $userModel = new User;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
			{
				$user_id = Yii::app()->user->id;
				$user = User::model()->findByPk($user_id);
                Yii::app()->user->setState('organization_id', $user->organization_id);
				if ($user->save())
					$this->redirect(Yii::app()->user->returnUrl);
			}
		}
        
        $page = $this->getPage('index');
        
		// display the login form
		$this->render('index',array(
            'model'=>$model,
            'userModel'=>$userModel,
            'page'=>$page
        ));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
    
	/**
	 * The help page.
	 */
	public function actionHelp()
	{
		$page = $this->getPage('help');
        $this->render('page', array('page'=>$page));
	}
    
	/**
	 * The help page.
	 */
	public function actionTerms()
	{
		$page = $this->getPage('terms');
        $this->render('page', array('page'=>$page));
	}
    
	/**
	 * This is the default 'info' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	protected function getPage($page)
	{
        $page=Page::findByPageUrl('site/'.$page);
		if($page===null)
			throw new CHttpException(404,'The requested page does not exist.');
		
        return $page;
	}
 }