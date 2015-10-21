<?php

class UserController extends AdminController
{
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
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'index' page.
	 */
	public function actionCreate()
	{
		$model=new User;
    	$location = Yii::app()->geoip->getMyGeoLocation();
        $country = Country::findByName($location['country_name']);
        $model->country_id = $country->id;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['User']))
		{
			$model->attributes = $_POST['User'];
			$model->verified = 'yes';
        	if($model->save())						//(a-done)
				$this->redirect(array('index'));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['User']))
		{
			$model->attributes = $_POST['User'];
            if($model->save())						//(a-done)
				$this->redirect(array('index'));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	public function actionDeleteImage($id)
	{
		$response = array();
		$response['result'] = 'fail';
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

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$model=$this->loadModel($id);
		$model->delete();
		// if AJAX request (triggered by deletion via index grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model=new User('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['User']))
			$model->attributes=$_GET['User'];

		$this->render('index',array(
			'model'=>$model,
		));
	}

	public function actionGrid()
	{
		$parametres = $_GET;
		$providerConfig = jqCondition::getProviderConfig($parametres);
		$providerConfig['criteria']['with'] = array('organization','country');
		$dataProvider = new CActiveDataProvider('User', $providerConfig);

        $response = new stdClass;
		$response->page = $page;
		$response->records = $dataProvider->getTotalItemCount();
		$response->total = ceil($response->records / $parametres['rows']);
		$rows = $dataProvider->getData();
		
		foreach ($rows as $i=>$data) {
			$response->rows[$i]['id'] = $data['id'];
			$response->rows[$i]['cell'] = array(
				$data->id,
				$data->organization->name,
				$data->mail,
				$data->first_name,
				$data->last_name,
				$data->country->name,
				$data->city,
				$data->address,
				$data->phone,
                strtotime($data->birthday) ? DateHandler::dateView($data->birthday) : '',
				strtotime($data->registered_at) ? DateHandler::dateTimeView($data->registered_at) : '',
				strtotime($data->last_login_at) ? DateHandler::dateTimeView($data->last_login_at) : '',
				$data->type,
				CHtml::image(!empty($data->image) ? $data->getImagePath(true) : '/images/user.png', 'Avatar', array('height' => 20)),
				$data->verified,
				$data->active,
				jqCondition::getGridButtons('admin/user', $data->id, array('update', array('password', 'Change Password', 'id/'. $data->id), 'delete'))
			);
		}
		
		echo json_encode($response);
	}

	/**
	 * Performs the AJAX validation.
	 * @param User $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionPassword($id)
	{
		$model=new PasswordForm(true);

		// Collect user input data
		if(isset($_POST['PasswordForm']))
		{
			$model->attributes=$_POST['PasswordForm'];
			// Validate user input and redirect to the previous page if valid
			if ($model->validate() && $model->changePassword($id))
				$this->redirect(array('index'));
		}
        // Display the change password form
		$this->render('password',array(
            'model'=>$model,
            'id'=>$id
        ));
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