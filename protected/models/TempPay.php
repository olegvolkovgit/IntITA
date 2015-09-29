<?php

/**
 * This is the model class for table "temp_pay".
 *
 * The followings are the available columns in table 'temp_pay':
 * @property integer $id_account
 * @property integer $id_user
 * @property integer $date
 * @property integer $id_course
 * @property integer $id_module
 * @property double $summa
 *
 * The followings are the available model relations:
 * @property Course $idCourse
 * @property Module $idModule
 * @property User $idUser
 */
class TempPay extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'temp_pay';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_user, summa', 'required'),
            array('id_user, id_course, id_module', 'numerical', 'integerOnly' => true),
            array('summa', 'numerical'),

            array('id_account, id_user, date, id_course, id_module, summa', 'safe', 'on' => 'search'),
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
            'idCourse' => array(self::BELONGS_TO, 'Course', 'id_course'),
            'idModule' => array(self::BELONGS_TO, 'Module', 'id_module'),
            'idUser' => array(self::BELONGS_TO, 'User', 'id_user'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id_account' => 'Id Account',
            'id_user' => 'Id User',
            'date' => 'Date',
            'id_course' => 'Id Course',
            'id_module' => 'Id Module',
            'summa' => 'Summa',
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
        $criteria = new CDbCriteria;

        $criteria->compare('id_account', $this->id_account);
        $criteria->compare('id_user', $this->id_user);
        $criteria->compare('date', $this->date, true);
        $criteria->compare('id_course', $this->id_course);
        $criteria->compare('id_module', $this->id_module);
        $criteria->compare('summa', $this->summa);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return TempPay the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public static function addAccount($user, $course, $module, $summa)
    {
        $model = new TempPay();

        $model->id_user = $user;
        $model->id_course = ($course != 0) ? $course : null;
        $model->id_module = ($module != 0) ? $module : null;
        $model->summa = $summa;

        $model->save();

        return TempPay::model()->findByAttributes(array('date'=>$model->date))->id_account;
    }

    protected function beforeSave()
    {
        if ($this->isNewRecord) {
            $this->date = time();
        }
        parent::beforeSave();
        return true;
    }
}
