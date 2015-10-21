<?php

class PurchaseController extends AdminController
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
		$model=new CampaignPurchase;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['CampaignPurchase']))
		{
			$model->attributes=$_POST['CampaignPurchase'];
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

		if(isset($_POST['CampaignPurchase']))
		{
			$model->attributes=$_POST['CampaignPurchase'];
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

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
		$model=new CampaignPurchase('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['CampaignPurchase']))
			$model->attributes=$_GET['CampaignPurchase'];

		$this->render('index',array(
			'model'=>$model,
		));
	}

	public function actionGrid()
	{
		$parametres = $_GET;
		$providerConfig = jqCondition::getProviderConfig($parametres);
        $providerConfig['criteria']['with'] = array('owner', 'campaign');
		$dataProvider = new CActiveDataProvider('CampaignPurchase', $providerConfig);
		
        $response = new stdClass;
		$response->page = $page;
		$response->records = $dataProvider->getTotalItemCount();
		$response->total = ceil($response->records / $parametres['rows']);
		$rows = $dataProvider->getData();
		
		foreach ($rows as $i=>$data) {
			$response->rows[$i]['id'] = $data['id'];
			$response->rows[$i]['cell'] = array(
				$data->id,
				$data->owner->first_name . ' ' . $data->owner->last_name,
                $data->campaign->name,
				$data->used_way, 
				long2ip($data->ip_address),
				$data->amount,
                DateHandler::dateTimeView($data->paid_at),
				jqCondition::getGridButtons('admin/purchase', $data->id),
			);
			
		}
		
		echo json_encode($response);
	}
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Purchase the loaded model
	 * @throws CHttpException
	 */

	public function loadModel($id)
	{
		$model=CampaignPurchase::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Purchase $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='purchase-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
