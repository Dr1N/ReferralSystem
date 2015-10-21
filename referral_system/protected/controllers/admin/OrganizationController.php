<?php

class OrganizationController extends AdminController
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
		$model=new Organization;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Organization']))
		{
			$model->attributes=$_POST['Organization'];
			if($model->save())
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

		if(isset($_POST['Organization']))
		{
			$model->attributes=$_POST['Organization'];
			if($model->save())
				$this->redirect(array('index'));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via index grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
	}

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
		$model=new Organization('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Organization']))
			$model->attributes=$_GET['Organization'];

		$this->render('index',array(
			'model'=>$model,
		));
	}
    
	public function actionGrid()
	{
		$parametres = $_GET;
		$providerConfig = jqCondition::getProviderConfig($parametres);
		$dataProvider = new CActiveDataProvider('Organization', $providerConfig);
		
        $response = new stdClass;
		$response->page = $page;
		$response->records = $dataProvider->getTotalItemCount();
		$response->total = ceil($response->records / $parametres['rows']);
		$rows = $dataProvider->getData();
		
		foreach ($rows as $i=>$data) {
			$response->rows[$i]['id'] = $data['id'];
			$response->rows[$i]['cell'] = array(
				$data->id,
				$data->name,
				$data->site_url,
				$data->country->name,
				$data->postal_code,
				$data->state,
				$data->city,
				$data->address_line_1,
				$data->address_line_2,
				$data->industry ? $data->industry->name : Industry::$_emptyCaption,
				$data->description,
                jqCondition::getGridButtons('admin/organization', $data->id, array('update', 'delete')),
			);
		}
		
		echo json_encode($response);
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
