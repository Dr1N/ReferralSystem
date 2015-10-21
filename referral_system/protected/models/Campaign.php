<?php

/**
 * This is the model class for table "{{campaign}}".
 *
 * The followings are the available columns in table '{{campaign}}':
 * @property integer $id
 * @property integer $organization_id
 * @property integer $user_id
 * @property string $name
 * @property string $alias
 * @property string $site_url
 * @property string $code
 * @property string $active
 *
 * The followings are the available model relations:
 * @property CampaignSetting[] $campaignSettings
 */
class Campaign extends CActiveRecord
{	
	private static $_maxImageSize = 1048576; // !!!!!!!!!! (a-to-do) move this setting to the config
	private static $_entityName = 'campaign'; // ??????????????????

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Campaign the static model class
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
		return '{{campaign}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('organization_id, name, code', 'required'),
            array('organization_id, user_id', 'numerical', 'integerOnly'=>true),
			array('name, alias', 'length', 'max'=>100),
			array('site_url', 'length', 'max'=>255),
			array('image', 'file', 'types'=>'jpg, gif, png', 'allowEmpty'=>true, 'maxSize'=>self::$_maxImageSize),
            array('code', 'length', 'max'=>16),
			array('active', 'length', 'max'=>3),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, organization_id, user_id, name, alias, site_url, image, code, active', 'safe', 'on'=>'search'),
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
			'organization' => array(self::BELONGS_TO, 'Organization', 'organization_id'),
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
			'setting' => array(self::HAS_ONE, 'CampaignSetting', 'campaign_id'),
            'clicks' => array(self::HAS_MANY, 'CampaignClick', 'campaign_id'),
            'purchases' => array(self::HAS_MANY, 'CampaignPurchase', 'campaign_id'),
            'campaignUsers' => array(self::HAS_MANY, 'CampaignUser', 'campaign_id'),
            'payouts' => array(self::HAS_MANY, 'Payout', 'campaign_id'),
			'importedMails' => array(self::HAS_MANY, 'ImportedMail', 'campaign_id'),
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
            'user_id' => 'Created By',
			'name' => 'Name',
			'alias' => 'Alias',
			'site_url' => 'Site Url',
			'image' => 'Image',
            'code' => 'Code',
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
		$criteria->compare('organization_id',$this->organization_id,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('alias',$this->alias,true);
		$criteria->compare('site_url',$this->site_url,true);
		$criteria->compare('image',$this->image,true);
        $criteria->compare('code',$this->code,true);
		$criteria->compare('active',$this->active,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    protected function beforeValidate()
    {
        if ($this->isNewRecord)
            $this->code = CodeGenerator::generateCode();
        $this->setting->validate();
        return parent::beforeValidate();
    }
    
    protected function afterSave(){
        $this->setting->campaign_id = $this->id;
        return $this->setting->save() && parent::afterSave();
    }

    public static function getCampaigns($organizationId = null)
	{
		$criteria = new CDbCriteria;
		$criteria->order = 'name ASC';
        if (!empty($organizationId))
            $criteria->condition = 'organization_id = ' . $organizationId;
		$campaignsList = self::model()->findAll($criteria);
		
		$campaigns = array();
		for ($i = 0; $i < count($campaignsList); $i++) {
			$campaigns[$campaignsList[$i]->id] = $campaignsList[$i]->name;
		}

		return $campaigns;
	}

	public static function getCampaignsByUserOrganization($userId, $organizationId = null)
	{
		$criteria = new CDbCriteria;
		$criteria->order = 'name ASC';
		$criteria->condition = 'user_id = :user_id AND organization_id = :organization_id';
		$criteria->params = array(':user_id'=>$userId, ':organization_id'=>$organizationId);
		$campaignsList = self::model()->findAll($criteria);

		$campaigns = array();
		for ($i = 0; $i < count($campaignsList); $i++) {
			$campaigns[$campaignsList[$i]->id] = $campaignsList[$i]->name;
		}
		
		return $campaigns;
	}

	protected function beforeSave()
    {
        $this->saveImage();
        return parent::beforeSave();
    }

    private function saveImage()
    {
    	if(!empty($_FILES['Campaign']['name']['image']))
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

	public function getImagePath($thumb = false)
    {
    	return Yii::app()->params['logo']['path'] . ($thumb ? 'thumb/' : '')  . $this->image;
    }
}