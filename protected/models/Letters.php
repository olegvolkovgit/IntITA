<?php

/**
 * This is the model class for table "letters".
 *
 * The followings are the available columns in table 'letters':
 * @property integer $id
 * @property integer $sender_id
 * @property integer $addressee_id
 * @property string $text_letter
 * @property integer $status
 * @property string $theme
 * @property string $date
 */
class Letters extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'letters';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sender_id, addressee_id, text_letter,theme, date', 'required', 'message'=>Yii::t('error','0268')),
			array('sender_id, addressee_id, status', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, sender_id, addressee_id, text_letter, status, rapport', 'safe', 'on'=>'search'),
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
			'sender_id' => 'Відправник',
			'addressee_id' => Yii::t("letter", "0539"),
			'text_letter' => Yii::t("letter", "0540"),
			'status' => Yii::t("letter", "0528"),
            'theme' => Yii::t("letter", "0527"),
            'date' => 'Дата',
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
		$criteria->compare('sender_id',$this->sender_id);
		$criteria->compare('addressee_id',$this->addressee_id);
		$criteria->compare('text_letter',$this->text_letter,true);
		$criteria->compare('status',$this->status);
        $criteria->compare('theme',$this->theme);
        $criteria->compare('date',$this->date);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Letters the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    protected function afterSave()
    {
        if(StudentReg::model()->findByPk($this->addressee_id)){
        $addresse = StudentReg::model()->findByPk($this->addressee_id)->email;

        $link = Yii::app()->createUrl('/studentreg/profile', array('idUser' => $this->addressee_id));

        $from = Yii::app()->user->name;

        $theme = "У Вас нове повідомлення на INTITA";

        $text = 'У Вас нове повідомлення на INTITA<br>'
            .'Від користувача '. $from . '<br>
            Ви зможете його переглянути <a href ='.$link.'>тут</a>';

        mail($addresse,$theme,$text);

        parent::afterSave();

        }

    }
    public static function sendAssignedConsultantLetter($consult,$idPlainTaskAnswer)
    {

        $plainTaskAnswer = PlainTaskAnswer::model()->findByPk($idPlainTaskAnswer);

        $path = Config::getBaseUrl()."_teacher/teacher/checkPlainTaskAnswer/".$plainTaskAnswer->id;

        $model = new Letters();

        $model->addressee_id = $consult;

        $model->sender_id = (int) Yii::app()->user->getId();

        $model->text_letter = 'Вітаємо
        Вам додано нова задача до перевірки <br>
        Ви можете переглянути її за посиланням <a href="$path">сюда</a>';
        $model->date = date("Y-m-d H:i:s");
        $model->theme = "Нова задача";

        if($model->validate()) {
            $model->save();
        }
    }
}
