<?php

/**
 * This is the model class for table "task1".
 *
 * The followings are the available columns in table 'task1':
 * @property integer $id
 * @property string $language
 * @property integer $assignment
 * @property integer $condition
 * @property integer $author
 * @property string $table
 *
 * The followings are the available model relations:
 */
class Task extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'task1';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('condition', 'required'),
			array('assignment, condition, author', 'numerical', 'integerOnly'=>true),
			array('language', 'length', 'max'=>15),
			array('table', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, language, assignment, condition, author, table', 'safe', 'on'=>'search'),
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
			'language' => 'Language',
			'assignment' => 'Assignment',
			'condition' => 'Condition',
			'author' => 'Author',
			'table' => 'Table',
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
		$criteria->compare('language',$this->language,true);
		$criteria->compare('assignment',$this->assignment);
		$criteria->compare('condition',$this->condition);
		$criteria->compare('author',$this->author);
		$criteria->compare('table',$this->table,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Task the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public static function addNewTask($condition, $language, $author, $assignment, $table)
    {
        $model = new Task();
        $model->condition = $condition;
        $model->author = $author;
        $model->language = $language;
        $model->assignment = $assignment;
        $model->table = $table;

        $model->save();
    }

    public static function deleteTask($condition){
        $task = Task::model()->findByAttributes(array('condition' => $condition));
        $task->delete();
    }
}
