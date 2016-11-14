<?php

/**
 * This is the model class for table "teacher_module".
 *
 * The followings are the available columns in table 'teacher_module':
 * @property integer $id
 * @property integer $idTeacher
 * @property integer $idModule
 * @property string $start_time
 * @property string $end_time
 */
class UserAuthor extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'teacher_module';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idTeacher, idModule, start_time', 'required'),
			array('idTeacher, idModule', 'numerical', 'integerOnly'=>true),
			array('end_time', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, idTeacher, idModule, start_time, end_time', 'safe', 'on'=>'search'),
		);
	}
    public function getRoleName()
    {
        return 'Автор';
    }
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
				'user' => array(self::BELONGS_TO, 'StudentReg', ['idTeacher'=>'id']),
				'authorActive' => array(self::BELONGS_TO, 'StudentReg', ['idTeacher'=>'id'],'condition'=>'end_time IS NULL', 'group'=>'idTeacher'),
				'modules' => array(self::HAS_MANY, 'Module', ['module_ID'=>'idModule']),
                'moduleAuthor' => array(self::BELONGS_TO, 'Module', ['idModule'=>'module_ID']),
                'assigned_by_user' => array(self::BELONGS_TO, 'StudentReg', ['assigned_by'=>'id']),
                'cancelled_by_user' => array(self::BELONGS_TO, 'StudentReg',['cancelled_by'=>'id']),
                'activeMembers' => array(self::BELONGS_TO, 'StudentReg', ['idTeacher'=>'id'],'condition'=>'end_time IS NULL AND activeMembers.cancelled=0'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'idTeacher' => 'Id Teacher',
			'idModule' => 'Id Module',
			'start_time' => 'Start Time',
			'end_time' => 'End Time',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('idTeacher',$this->idTeacher);
		$criteria->compare('idModule',$this->idModule);
		$criteria->compare('start_time',$this->start_time,true);
		$criteria->compare('end_time',$this->end_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UserAuthor the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function findAll($condition='',$params=array())
	{
		Yii::trace(get_class($this).'.findAll()','system.db.ar.CActiveRecord');
		$criteria=$this->getCommandBuilder()->createCriteria($condition,$params);
		$criteria->mergeWith(array(
				'group'=>'idTeacher',
		));
		//return parent::findAll();
		return parent::findAll($criteria);
	}
}
