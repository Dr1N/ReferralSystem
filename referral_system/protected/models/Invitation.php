<?php

/**
 * This is the model class for table "{{invitation}}".
 *
 * The followings are the available columns in table '{{invitation}}':
 * @property integer $id
 * @property integer $user_id
 * @property integer $inviter_id
 * @property integer $organization_id
 * @property string $status
 * @property string $code
 *
 * The followings are the available model relations:
 * @property User $user
 * @property User $inviter
 */
class Invitation extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Invitation the static model class
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
		return '{{invitation}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, inviter_id, organization_id, code', 'required'),
			array('user_id, inviter_id, organization_id', 'numerical', 'integerOnly'=>true),
			array('status', 'length', 'max'=>10),
			array('code', 'length', 'max'=>16),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, inviter_id, organization_id, status, code', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
			'inviter' => array(self::BELONGS_TO, 'User', 'inviter_id'),
            'organization' => array(self::BELONGS_TO, 'Organization', 'organization_id'),            
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'inviter_id' => 'Inviter',
			'organization_id' => 'Organization',
			'status' => 'Status',
			'code' => 'Verification Code',
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('inviter_id',$this->inviter_id);
		$criteria->compare('organization_id',$this->organization_id);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('code',$this->code,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public static function findByUserAndCode($user_id, $code)
    {
        $params=array(
            ':user_id'=>$user_id,
            ':code'=>$code,
        );
        return self::model()->find('user_id=:user_id AND code=:code', $params);
    }

    public static function findByUserInviterAndOrganization($user_id, $inviter_id, $organization_id)
    {
        $params=array(
            ':user_id'=>$user_id,
            ':inviter_id'=>$inviter_id,
            ':organization_id'=>$organization_id
        );
        return self::model()->find('user_id=:user_id AND inviter_id=:inviter_id AND organization_id=:organization_id', $params);
    }
}