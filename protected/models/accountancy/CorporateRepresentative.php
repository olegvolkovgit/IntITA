<?php

/**
 * This is the model class for table "acc_corporate_representative".
 *
 * The followings are the available columns in table 'acc_corporate_representative':
 * @property integer $id
 * @property string $full_name
 * @property string $position
 *
 * The followings are the available model relations:
 */
class CorporateRepresentative extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'acc_corporate_representative';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('full_name, position', 'required'),
			array('full_name', 'length', 'max'=>255),
			array('position', 'length', 'max'=>100),
			// The following rule is used by search().
			array('id, full_name, position', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'full_name' => 'ПІБ',
			'position' => 'Посада',
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

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('full_name',$this->full_name,true);
		$criteria->compare('position',$this->position,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CorporateRepresentative the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function representativesList(){
        $courses = CorporateRepresentative::model()->findAll();
        $return = array('data' => array());

        foreach ($courses as $record) {
            $row = array();

            $row["title"]["name"] = CHtml::encode($record->full_name);
            $row["title"]["url"] = Yii::app()->createUrl('/_teacher/_accountant/company/viewRepresentative',
                array('id' => $record->id));
            $row["position"] = $record->position;
            $row["companies"] = 1;

            array_push($return['data'], $row);
        }

        return json_encode($return);
	}
}
