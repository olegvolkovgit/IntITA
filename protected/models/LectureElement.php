<?php

/**
 * This is the model class for table "lecture_element".
 *
 * The followings are the available columns in table 'lecture_element':
 * @property integer $id_lecture
 * @property integer $block_order
 * @property string $type
 * @property string $html_block
 *
 * The followings are the available model relations:
 * @property Lecture $idLecture
 */
class LectureElement extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'lecture_element';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_lecture, block_order, type, html_block', 'required'),
			array('id_lecture, block_order', 'numerical', 'integerOnly'=>true),
			array('type', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_lecture, block_order, type, html_block', 'safe', 'on'=>'search'),
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
			'idLecture' => array(self::BELONGS_TO, 'Lectures', 'id_lecture'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_lecture' => 'Id Lecture',
			'block_order' => 'Block Order',
			'type' => 'Type',
			'html_block' => 'Html Block',
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

		$criteria->compare('id_lecture',$this->id_lecture);
		$criteria->compare('block_order',$this->block_order, true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('html_block',$this->html_block,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort' => array (
                'defaultOrder'=>array(
                    'block_order'=>CSort::SORT_ASC,
                )
            ),
            'pagination'=>array(
                'pageSize'=>count($criteria),
            ),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return LectureElement the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
