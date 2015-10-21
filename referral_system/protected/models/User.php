<?php

/**
 * This is the model class for table "{{user}}".
 *
 * The followings are the available columns in table '{{user}}':
 * @property integer $id
 * @property integer $organization_id
 * @property string $mail
 * @property string $first_name
 * @property string $last_name
 * @property string $password
 * @property integer $country_id
 * @property string $address
 * @property string $phone
 * @property string $image
 * @property string $birthday
 * @property string $type
 * @property string $verified
 * @property string $active
 *
 * The followings are the available model relations:
 * @property Invitation[] $invitations
 * @property Invitation[] $invitations1
 * @property Payout[] $payouts
 * @property Purchase[] $purchases
 * @property Organization $organization
 * @property UserStatistic[] $userStatistics
 */
class User extends CActiveRecord
{
	public static $type = array(
		'admin' => 	 'Super Admin',
		'insider' => 'Insider (Organization Admin or Member)',
		'user' => 	 'User'
	);
    
    public static $salt = '1a4a5f89';
    private static $_maxImageSize = 1048576;  // !!!!!!!!!! (a-to-do) move this setting to the config
	private static $_entityName = 'user';
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{user}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array('mail, password', 'required'), // password?? 
			array('organization_id, country_id, phone', 'numerical', 'integerOnly'=>true), // phone ??????? !!!!!!!!!!!!!
			array('mail, first_name, last_name, city, address', 'length', 'max'=>100),
			array('mail','email'),
			array('mail','unique'),
			array('password', 'length', 'min'=>6, 'max'=>32),
			array('phone', 'length', 'max'=>14),
			array('image', 'file', 'types'=>'jpg, gif, png', 'allowEmpty'=>true, 'maxSize'=>self::$_maxImageSize), 
			array('type', 'length', 'max'=>7),
			array('verified, active', 'length', 'max'=>3),
			array('birthday, registered_at, last_login_at', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, organization_id, mail, first_name, last_name, password, country_id, address, phone, image, birthday, type, verified, active, city, registered_at, last_login_at', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
            'campaigns' => array(self::HAS_MANY, 'Campaign', 'user_id'),
            'clicks' => array(self::HAS_MANY, 'CampaignClick', 'owner_id'),
            'purchases' => array(self::HAS_MANY, 'CampaignPurchase', 'owner_id'),
            'campaignUsers' => array(self::HAS_MANY, 'CampaignUser', 'user_id'),
            'inviters' => array(self::HAS_MANY, 'Invitation', 'inviter_id'),
			'invites' => array(self::HAS_MANY, 'Invitation', 'user_id'),
			'payouts' => array(self::HAS_MANY, 'Payout', 'user_id'),
			'organization' => array(self::BELONGS_TO, 'Organization', 'organization_id'),
			'country' => array(self::BELONGS_TO, 'Country', 'country_id'),
			'importedMails' => array(self::HAS_MANY, 'ImportedMail', 'user_id'),
            //'userStatistics' => array(self::HAS_MANY, 'UserStatistic', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'organization_id' => 'Organization',
			'mail' => 'Mail',
			'first_name' => 'First Name',
			'last_name' => 'Last Name',
			'password' => 'Password',
			'country_id' => 'Country',
			'city' => 'City',
			'address' => 'Address',
			'phone' => 'Phone',
			'image' => 'Image',
			'birthday' => 'Birthday',
			'type' => 'Type',
			'verified' => 'Verified',
			'registered_at' => 'Registered At',
			'last_login_at' => 'Last Login At',
			'active' => 'Active',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('organization_id',$this->organization_id);
		$criteria->compare('mail',$this->mail,true);
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('country_id',$this->country_id);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('birthday',$this->birthday,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('verified',$this->verified,true);
		$criteria->compare('registered_at',$this->registered_at,true);
		$criteria->compare('last_login_at',$this->last_login_at,true);
		$criteria->compare('active',$this->active,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    protected function beforeSave()
    {
        if ($this->isNewRecord)
        {
            $this->password = $this->hashPassword($this->password);
            $this->registered_at = DateHandler::now();
            if (empty($this->country_id))
            {
            	$location = Yii::app()->geoip->getMyGeoLocation();
                $country = Country::findByName($location['country_name']);
                $this->country_id = $country->id;
                $this->city = $location['city'];
            }
        }
        if (strtotime($this->birthday))
            $this->birthday = DateHandler::date($this->birthday);
        $this->saveImage();
        return parent::beforeSave();
    }

    private function saveImage()
    {
    	if(!empty($_FILES['User']['name']['image']))
    	{
    		$fileName  = date('YmdHis');
    		$image = new Image(self::$_entityName);
    		$image->setFile($_FILES);
    		
    		if(!empty($this->image))
	    		$image->deleteImage($this->image);
	        	        
	        $image->saveImage($fileName) ? $this->image = $image->savedFileName : $this->addError('image', $image->errors);
	    }
	}

	protected function afterDelete()
	{
		$image = new Image(self::$_entityName);
		
		if(!empty($this->image))
	    	$image->deleteImage($this->image);
	}

	/**
	 * Checks if the given password is correct.
	 * @param string the password to be validated
	 * @return boolean whether the password is valid
	 */
	public function validatePassword($password)
	{
		return $this->hashPassword($password) === $this->password;
	}

	/**
	 * Generates the password hash.
	 * @param string password
	 * @param string salt
	 * @return string hash
	 */
	public function hashPassword($password)
	{
		return md5(md5($password) . self::$salt);
	}
    
	public static function getUsers()
	{
		$criteria = new CDbCriteria;
		$criteria->order = 'mail ASC';
		$usersList = User::model()->findAll($criteria);
		
		$users = array();
		for ($i = 0; $i < count($usersList); $i++) {
			$users[$usersList[$i]->id] = $usersList[$i]->mail;
            $usersList[$i]->first_name . ' ' . $usersList[$i]->last_name;
		}

		return $users;
	}
    
    public static function findByMail($mail)
    {
        return self::model()->find('mail=:mail', array(':mail'=>$mail));
    }

    public static function __callStatic($name, $arguments) // !!!!!!!!!!!!!!!!!!!!!!
    {
        //Yii::app()->user->lastLoginTime = '222';
        //echo Yii::app()->user->lastLoginTime;
  		$user = User::model()->findByPk(Yii::app()->user->id);
        $value = null;
        
        switch ($name)
        {
            case 'fullName':
                $value = trim($user->first_name . ' ' . $user->last_name);
                if (empty($value))
                    $value = Yii::app()->user->name;
                break;
            case 'avatar':
                if (!empty($user->image))
                    $value = Yii::app()->params['user']['path'] . 'thumb/' . $user->image;
                break;
            case 'organizationId':
                $value = $user->organization_id;
                break;
            case 'hasSociety':
                $value = empty($user->organization_id) ? false : true;
                break;
            default:
                $value = $user->$name;
                break;
        }

        return $value;
    }

    public function getImagePath($thumb = false)
    {
    	return Yii::app()->params['user']['path'] . ($thumb ? 'thumb/' : '') . $this->image;
    }
}