<?php

class CampaignController extends Controller
{
    public $defaultAction = 'list';
    
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
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'index' page.
	 */
	public function actionCreate()
	{
		$user_id = Yii::app()->user->id;
		$user = User::model()->findByPk($user_id);
		$model=new Campaign;
        $model->setting=new CampaignSetting;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Campaign']))
		{
            $model->attributes=$_POST['Campaign'];
			$model->user_id = $user_id;
			$model->organization_id = $user->organization_id;
            if(isset($_POST['CampaignSetting'])) {
                $model->setting->attributes=$_POST['CampaignSetting'];
                $model->setting->campaign_id = 0;
            }
            
            if($model->validate() && $model->setting->validate()) {
    			if($model->save())
                    $this->redirect(array('list'));
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
    				$this->redirect(array('list'));
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
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('list'));
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
	 * Manages all models.
	 */
	public function actionList()
	{
        $user_id = Yii::app()->user->id;
		$user = User::model()->findByPk($user_id);
		$model = new Campaign;


        // !!!!!!!!
        $campaigns = null;
        if ($user->organization_id)
        {
            $limit = 20;
            $page = 1;
            $sort = 'ASC';
            $order = 'name ' . $sort;
            $where = 't.organization_id =' . $user->organization_id;
    		$providerConfig = array(
    			'pagination'=>array(
    				'pageSize'=>$limit,
    				'currentPage'=>$page-1,
    			),
    			'sort'=>array(
    				'defaultOrder'=>array(
    					$sidx=>$sorter,
    				),
    			),
    			'criteria'=>array(
    				'condition'=>$where,
                    'order'=>$order
    				//'with'=>array('user', 'setting'),
    			),
    		);
            $dataProvider = new CActiveDataProvider('Campaign', $providerConfig);
            $campaigns = $dataProvider->getData();
        }
        // !!!!!!!!


		$this->render('list',array(
            'model' => $model,
			'campaigns'=>$campaigns, // !!!!!!!!
		));
	}

	public function actionGrid() // do not need this function!!!!!!!!!!!!!!
	{
		$parametres = $_GET;
        $user_id = Yii::app()->user->id;
        $user = User::model()->findByPk($user_id);
       	
       	$providerConfig = jqCondition::getProviderConfig($parametres);
        $condition = empty($providerConfig['criteria']['condition']) ? '' : $providerConfig['criteria']['condition'] . ' AND ';
		$condition .= '(t.organization_id =' . $user->organization_id . ')';
        $providerConfig['criteria']['condition'] = $condition;
        $providerConfig['criteria']['with'] = array('user', 'setting');                
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
                jqCondition::getGridButtons('campaign', $data->id, array('update', 'delete', array('users', 'User List', 'id/'. $data->id), )),
			);
		}
		
		echo json_encode($response);
	}
    
    
    
    
    
    
    
    
    
    
    
    
    
    // Finish !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! V
    
    
    
    
	/**
	 * Lists all models.
	 */
	public function actionUsers($id)
	{
        $model=$this->loadModel($id);
		
		//check organization
		$user_id = Yii::app()->user->id;
		$user = User::model()->findByPk($user_id);

		$this->render('users', array(
			'model'=>$model,
			'user'=>$user,
		));
	}
    
	public function actionUsersGrid($id)
	{
		$parametres = $_GET;
        //$user_id = Yii::app()->user->id;
		//$user=User::model()->findByPk($user_id);
		$providerConfig = jqCondition::getProviderConfig($parametres);
        $providerConfig['criteria']['with'] = array('country');
        $condition = empty($providerConfig['criteria']['condition']) ? '' : $providerConfig['criteria']['condition'] . ' AND ';
        $condition .= '(t.id IN (SELECT user_id FROM rf_campaign_user WHERE campaign_id = ' . $id . '))';
        $providerConfig['criteria']['condition'] = $condition;
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
				$data->mail,
				$data->first_name . ' ' . $data->last_name,
				$data->country->name,
				$data->city,
				$data->address,
				$data->phone,
                DateHandler::dateView($data->birthday),
                DateHandler::dateTimeView($data->registered_at),
                DateHandler::dateTimeView($data->last_login_at),
				$data->verified,
				$data->active,
                // Clicks
                CampaignClick::getClicksAmount($id, 'mail', $data->id),
        		CampaignClick::getClicksAmount($id, 'facebook', $data->id),
        		CampaignClick::getClicksAmount($id, 'twitter', $data->id),
        		CampaignClick::getClicksAmount($id, 'link', $data->id),
                // Purchases
        		CampaignPurchase::getPurchaseAmount($id, 'mail', $data->id),
        		CampaignPurchase::getPurchaseAmount($id, 'facebook', $data->id),
        		CampaignPurchase::getPurchaseAmount($id, 'twitter', $data->id),
        		CampaignPurchase::getPurchaseAmount($id, 'link', $data->id),
				jqCondition::getGridButtons('colleague', $data->id, array('view', array('deleteLink', 'Delete from Organization', 'id/'. $data->id))),
			);
		}
		
		echo json_encode($response);
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
		$organization_id = (int) Yii::app()->user->getState('organization_id');
		if($model===null || $model->organization_id != $organization_id)
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
