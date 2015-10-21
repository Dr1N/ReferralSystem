<?php

class PayoutController extends AdminController
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
		$model=new Payout;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Payout']))
		{
			$model->attributes=$_POST['Payout'];
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

		if(isset($_POST['Payout']))
		{
			$model->attributes=$_POST['Payout'];
			if($model->save())
				$this->redirect(array('index'));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
	}

	public function actionConfirmPayment($id)
	{
        $model = $this->loadModel($id); 
        $model->status = 'completed';
        if($model->save())
			$this->redirect(array('index'));     
	}

	public function actionRejectPayment($id)
	{
        $model = $this->loadModel($id); 
        $model->status = 'rejected';
        if($model->save())
			$this->redirect(array('index'));     
	}

	public function actionPendingPayment($id)
	{
        $model = $this->loadModel($id); 
        $model->status = 'pending';
        if($model->save())
			$this->redirect(array('index'));     
	}

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
		$model=new Payout('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Payout']))
			$model->attributes=$_GET['Payout'];

		$this->render('index',array(
			'model'=>$model,
		));
	}

	public function actionGrid()
	{
		$parametres = $_GET;
		$providerConfig = jqCondition::getProviderConfig($parametres);
        $providerConfig['criteria']['with'] = array('user', 'campaign');
		$dataProvider = new CActiveDataProvider('Payout', $providerConfig);
		
        $response = new stdClass;
		$response->page = $page;
		$response->records = $dataProvider->getTotalItemCount();
		$response->total = ceil($response->records / $parametres['rows']);
		$rows = $dataProvider->getData();
		
		foreach ($rows as $i=>$data) 
		{
			$buttons =  array();
			$buttons[] =  'update';
			if ($data->status != 'pending')
				$buttons[] =  array('pendingPayment', 'Pending Payment', 'id/' . $data->id);
			if ($data->status != 'completed')
				$buttons[] =  array('confirmPayment', 'Confirm Payment', 'id/' . $data->id);
			if ($data->status != 'rejected')
				$buttons[] =  array('rejectPayment', 'Reject Payment', 'id/' . $data->id);
			$buttons[] =  'delete';
			
			$response->rows[$i]['id'] = $data['id'];
			$response->rows[$i]['cell'] = array(
				$data->id,
				$data->user->mail,
				$data->user->first_name . ' ' . $data->user->last_name,
                $data->campaign->name,
				$data->amount,
				$data->end_amount,
                DateHandler::dateTimeView($data->created_at),
                $data->status,
				$data->payout_way,
				Payout::parseDetails($data->details),
				jqCondition::getGridButtons('admin/payout', $data->id, $buttons));
			}
		
		echo json_encode($response);
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Payout the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Payout::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Payout $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='payout-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
