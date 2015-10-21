<?php

class CampaignController extends AdminController
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
		$model=new Campaign;
        $model->setting=new CampaignSetting;
        $model->user_id=Yii::app()->user->id;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Campaign']))
		{
			$model->attributes=$_POST['Campaign'];
            if(isset($_POST['CampaignSetting'])) {
                $model->setting->attributes=$_POST['CampaignSetting'];
                $model->setting->campaign_id = 0;
            }

            if($model->validate() && $model->setting->validate()) {
    			if($model->save())
                    $this->redirect(array('index'));
            }
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

        if (!isset($model->setting))
        {
            $model->setting = new CampaignSetting;
            $model->setting->campaign_id = $id;
            $model->save();
        }
        
        // Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Campaign']))
		{
			$model->attributes=$_POST['Campaign'];
            if(isset($_POST['CampaignSetting']))
                $model->setting->attributes=$_POST['CampaignSetting'];

			if($model->validate() && $model->setting->validate()) {
                if($model->save())
    				$this->redirect(array('index'));
            }
		}
        
        $link = Yii::app()->createAbsoluteUrl('track', array('id'=>$model->id, 'code'=>$model->code));

		$this->render('update',array(
			'model'=>$model,
			'link'=>$link,
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
		$model=new Campaign('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Campaign']))
			$model->attributes=$_GET['Campaign'];

		$this->render('index',array(
			'model'=>$model,
		));
	}

	public function actionGrid()
	{
		$parametres = $_GET;
		$providerConfig = jqCondition::getProviderConfig($parametres);
        $providerConfig['criteria']['with'] = array('organization', 'user', 'setting');
		$dataProvider = new CActiveDataProvider('Campaign', $providerConfig);
		
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
				$data->alias,
				$data->organization->name,
				$data->user->mail,
                $data->user->first_name . ' ' . $data->user->last_name,
				$data->site_url,
				CHtml::image(!empty($data->image) ? $data->getImagePath(true) : '/images/user.png', 'Logo', array('height' => 20)),
				$data->active,
				$data->setting->referral_prize,
				$data->setting->recipient_prize,
				$data->setting->min_payout,
				CampaignClick::getClicksAmount($data->id),
				CampaignPurchase::getPurchaseAmount($data->id),
				CampaignPurchase::getPurchaseTotal($data->id),
				$data->setting->enable_mail,
				$data->setting->enable_facebook,
				$data->setting->enable_twitter,
				$data->setting->enable_link,
                jqCondition::getGridButtons('admin/campaign', $data->id, array('update', 'delete')),
			);
		}
		
		echo json_encode($response);
	}

	public function actionDeleteImage($id)
	{
		$response = array();
		$response['result'] = 'fail';
		$model = $this->loadModel($id);
		if(!empty($model))
		{
			$image = new Image('campaign');
			$image->deleteImage($model->image);
			$model->image = '';
			if($model->save())
				$response = 'success';
		}
		exit (json_encode($response));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Campaign the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Campaign::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Campaign $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='campaign-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
