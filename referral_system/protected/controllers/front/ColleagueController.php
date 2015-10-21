<?php

class ColleagueController extends Controller
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
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDeleteLink($id)
	{
		$user=User::model()->findByPk($id);
		$user->organization_id = null;

		if($user->save())
			$this->redirect(array('list'));
	}

	/**
	 * Lists all models.
	 */
	public function actionList()
	{
		$model=new User;
		
		$this->render('list', array(
			'model'=>$model,
		));
	}
 
	public function actionGrid()
	{
		$parametres = $_GET;
        $user_id = Yii::app()->user->id;
		$user=User::model()->findByPk($user_id);
		$providerConfig = jqCondition::getProviderConfig($parametres);
        $providerConfig['criteria']['with'] = array('country');
        $condition = empty($providerConfig['criteria']['condition']) ? '' : $providerConfig['criteria']['condition'] . ' AND ';
        $condition .= '(t.organization_id =' . $user->organization_id . ')';
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
                strtotime($data->birthday) ? DateHandler::dateView($data->birthday) : '',
				strtotime($data->registered_at) ? DateHandler::dateTimeView($data->registered_at) : '',
				strtotime($data->last_login_at) ? DateHandler::dateTimeView($data->last_login_at) : '',
                CHtml::image(!empty($data->image) ? $data->getImagePath(true) : '/images/user.png', 'Avatar', array('height' => 20)),
				$data->verified,
				$data->active,
				jqCondition::getGridButtons('colleague', $data->id, array('view', array('deleteLink', 'Delete from Organization', 'id/'. $data->id))),
			);
		}
		
		echo json_encode($response);
	}
 
	public function actionInvite()
	{
		$model = new User;
		
		if(Yii::app()->request->isAjaxRequest)
		{
			$response = array();
			$response['result'] = 'fail';
			$newUserPassword = null;
			$isNewUser = false;
			$mail = $_POST['User']['mail'];
			$user = User::findByMail($mail);

            // New user
			if(empty($user))
			{
				$user = new User;
				$user->attributes = $_POST['User'];
				$user->password = CodeGenerator::generatePassword();
				$user->type = 'insider';
				$user->image = CUploadedFile::getInstance($user, 'image');
				$isNewUser = true;
				$newUserPassword = $user->password;
				if (!$user->save())
					$response['errors'] = $user->getErrors();
			}
			
            // Send invite
			if(!empty($user) && !empty($user->id))
			{
				// Organization exists
				if($user->organization_id == null)
				{
            		$inviter_id = Yii::app()->user->id;
            		$inviter = User::model()->findByPk($inviter_id);
					$invite = Invitation::findByUserInviterAndOrganization($user->id, $inviter_id, $inviter->organization_id);
                    // New invitation
					if(!isset($invite))
					{  
						$invite = new Invitation;
						$invite->user_id = $user->id;
						$invite->inviter_id = $inviter_id;
						$invite->organization_id = $inviter->organization_id;	
						$invite->status = 'invited';
						$invite->code = CodeGenerator::generateCode();
						if(!$invite->save())
							$response['errors'] = $invite->getErrors();;
					}
					Mailer::sendInvitation($user, $invite->code, $newUserPassword ? $newUserPassword : null);
					$response['result'] = 'success';
				} 
			}
			exit(json_encode($response));
		}

		$this->render('invite', array(
			'model'=>$model,
		));
	}

	public function actionCheckUser()
	{
		$response = array();
		$response['result'] = 'success';
				
		$model = new User;
		$mail = $_POST['mail'];
		$user = User::findByMail($mail);
		
		if(empty($user)) //newuser
		{
			$model->mail = $mail;
			$model->password = CodeGenerator::generatePassword();
			if($model->validate())
				$response['user'] = 'newuser';
			else
			{
				$response['result'] = 'fail';
				$response['errors'] = $model->getErrors();
			}
		} 
		else //user and organization == null
		{
			if($user->organization_id == null)
			{
				$response['user'] = array(
					'first_name' => $user->first_name,
					'last_name' => $user->last_name,
					'image' => $user->image
				);
			} 
			else //user with organization
				$response['result'] = 'exists';
		}

		echo json_encode($response);
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
		$organization_id = (int) Yii::app()->user->getState('organization_id');
		if($model===null || $model->organization_id != $organization_id)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
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
}
