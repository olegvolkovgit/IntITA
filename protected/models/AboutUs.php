<?php

/**
 * This is the model class for table "aboutus".
 *
 * The followings are the available columns in table 'aboutus':
 * @property integer $block_id
 * @property string $iconImage
 */
class Aboutus extends CActiveRecord
{
    public $titleTextExp;
    public $line2Image;
    public $titleText;
    public $textAbout;
    public $drop1Text;
    public $drop2Text;
    public $drop3Text;
    public $tab;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'aboutus';
	}

	function AboutUs($id){

	}

	public function setValuesById($id)
	{
		$this->line2Image = StaticFilesHelper::createPath('image', 'aboutus', 'line2.png');
		$this->iconImage = StaticFilesHelper::createPath('image', 'aboutus', $this->findByPk($id)->iconImage);
        $this->tab = $id;
        return 'aboutus';
	}
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('iconImage', 'required'),
			array('iconImage', 'length', 'max'=>255),
			// The following rule is used by search().
			array('block_id, iconImage', 'safe', 'on'=>'search'),
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

    public function setStartBlock(){
        $this->isStart = true;
        $this->redirect(array('studentreg/index'));
    }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'block_id' => 'Block',
			'iconImage' => 'Icon Image',
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

		$criteria->compare('block_id',$this->block_id);
		$criteria->compare('iconImage',$this->iconImage,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Aboutus the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
