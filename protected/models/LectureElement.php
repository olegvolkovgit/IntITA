<?php

/**
 * This is the model class for table "lecture_element".
 *
 * The followings are the available columns in table 'lecture_element':
 * @property integer $id_block
 * @property integer $id_lecture
 * @property integer $block_order
 * @property integer $id_type
 * @property string $html_block
 *
 * The followings are the available model relations:
 * @property ElementType $idType
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
			array('id_lecture, block_order, id_type, html_block', 'required'),
			array('id_lecture, block_order, id_type', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_block, id_lecture, block_order, id_type, html_block', 'safe', 'on'=>'search'),
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
			'idType' => array(self::BELONGS_TO, 'ElementType', 'id_type'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_block' => 'Id Block',
			'id_lecture' => 'Id Lecture',
			'block_order' => 'Block Order',
			'id_type' => 'Id Type',
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

		$criteria->compare('id_block',$this->id_block);
		$criteria->compare('id_lecture',$this->id_lecture);
		$criteria->compare('block_order',$this->block_order);
		$criteria->compare('id_type',$this->id_type);
		$criteria->compare('html_block',$this->html_block,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort' => array(
                'defaultOrder'=>array(
                    'block_order'=>CSort::SORT_ASC,
                )
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

    public static function addNewTaskBlock($idLecture, $condition, $taskType){
        $model = new LectureElement();

        $order = LectureElement::model()->count('id_lecture = :id', array(':id' => $idLecture));
        $model->block_order = ++$order;

        if ($taskType == 'final'){
            //$model->type = 'final task';
            $model->id_type = 6;
        } else {
            //$model->type = 'task';
            $model->id_type = 5;
        }

        $model->html_block = $condition;
        $model->id_lecture = $idLecture;

        if ($model->save(true)) {
            return LectureElement::model()->findByAttributes(array('block_order'=>$order, 'id_lecture' => $idLecture))->id_block;
        } else {
            return false;
        }
    }

    public static function addNewTestBlock($idLecture, $condition, $testType){
        $model = new LectureElement();

        $order = LectureElement::model()->count('id_lecture = :id', array(':id' => $idLecture));
        $model->block_order = ++$order;

        if ($testType == 'final'){
            //$model->type = 'final test';
            $model->id_type = 13;
        } else {
            //$model->type = 'test';
            $model->id_type = 12;
        }
        $model->html_block = $condition;
        $model->id_lecture = $idLecture;

        if ($model->save()) {
            return LectureElement::model()->findByAttributes(array('block_order'=>$order, 'id_lecture' => $idLecture))->id_block;
        } else {
            return false;
        }
    }
}
