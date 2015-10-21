<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
    const ERROR_TYPE_INVALID = 3;
    
	private $_id;
	private $_accessLevel = 'insider';
    private $_accessTypes = array(
        'admin' => array('admin'),
        'insider' => array('admin', 'insider'),
        'user' => array('admin', 'insider', 'user'),
    );
    

	/**
	 * Authenticates a user.
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		$criteria=new CDbCriteria;
        $criteria->condition='mail=:mail';
		$criteria->params=array(':mail'=>$this->username);
		$user=User::model()->find($criteria);
        if($user===null)
            $this->errorCode=self::ERROR_USERNAME_INVALID;
  		else if(!$user->validatePassword($this->password))
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
  		else if(!$this->getAccess($user->type))
            $this->errorCode=self::ERROR_TYPE_INVALID;
        else
        {
            $this->_id=$user->id;
            $this->username=$user->mail;
            //$this->setState('lastLoginTime', 'test'); // opportunity to use the data in this way Yii::app()->user->lastLoginTime
			$user->last_login_at = DateHandler::now();
			$user->save();
            $this->errorCode=self::ERROR_NONE;
        }
        return !$this->errorCode;
	}
    
    public function setAccessLevel($accessLevel)
	{
        $this->_accessLevel = $accessLevel;
    }

    public function getAccess($userType)
	{
        return in_array($userType, $this->_accessTypes[$this->_accessLevel]);
    }

	/**
	 * @return integer the ID of the user record
	 */
	public function getId()
	{
		return $this->_id;
	}
}