<?php

class OrganizationController extends Controller
{
    public $defaultAction = 'profile';
    
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
		$user = User::model()->findByPk($user_id);
        $model = empty($user->organization_id) ? null : $user->organization;
        
		$this->render('profile',array(
			'model'=>$model,
        ));
	}
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'index' page.
	 */
	public function actionCreate()
	{
		$model=new Organization;
        $user_id = Yii::app()->user->id;
		$user = User::model()->findByPk($user_id);
        
        if (!empty($user->organization_id))
            $this->redirect(Yii::app()->user->returnUrl);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Organization']))
		{
			$model->attributes=$_POST['Organization'];
			if($model->save())
			{
				$user->organization_id = $model->id;
				if($user->save())
                {
                    Yii::app()->user->setState('organization_id', $user->organization_id);
					$this->redirect(array('profile'));
                }
			}
		}
		$this->render('create',array(
			'model'=>$model,
		));
	}
		    
	public function actionUpdate()
	{
		$user_id = Yii::app()->user->id;
		$user = User::model()->findByPk($user_id);
		$model = Organization::model()->findByPk($user->organization_id);
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Organization']))
		{
			$model->attributes=$_POST['Organization'];
			if($model->save())
				$this->redirect(array('profile'));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Organization the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Organization::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
 
	/**
	 * Performs the AJAX validation.
	 * @param Organization $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='organization-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
