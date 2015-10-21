<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class PasswordForm extends CFormModel
{
	public $old_password;
	public $password;
	public $confirm_password;

	private $_admin;

	public function __construct($admin = false)
	{
		$this->_admin = $admin;
	}

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		if (!$this->_admin)
        {
			return array(
				array('old_password', 'validatePassword'),
				array('old_password, password, confirm_password', 'required'),
				array('old_password, password, confirm_password', 'length', 'min'=>6, 'max'=>32),
				array('confirm_password', 'compare', 'compareAttribute'=>'password'),
            );
		}
        
		return array(
			array('password, confirm_password', 'required'),
			array('password, confirm_password', 'length', 'min'=>6, 'max'=>32),
			array('confirm_password','compare', 'compareAttribute'=>'password'),
        );
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'old_password'=>'Old Password',
			'password'=>'New Password',
			'confirm_password'=>'Confirm Password',
		);
	}

	public function validatePassword()
	{
		$user = User::model()->findByPk(Yii::app()->user->id);
		
        if(!empty($this->old_password) && !$user->validatePassword($this->old_password))
            $this->addError('old_password', 'Password is incorrect');
	}

	public function changePassword($id)
	{
		$user=User::model()->findByPk($id);
		$user->password = $user->hashPassword($this->password);
		return $user->save();
	}
}
