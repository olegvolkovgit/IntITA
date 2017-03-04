<?php

/**
 * This is the model class for table "acc_promotion_payment_schema".
 *
 * The followings are the available columns in table 'acc_promotion_payment_schema':
 * @property integer $id
 * @property integer $id_template
 * @property integer $courseId
 * @property integer $moduleId
 * @property integer $serviceType
 * @property string $showDate
 * @property string $startDate
 * @property string $endDate
 */
class PromotionPaymentScheme extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'acc_promotion_payment_schema';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_template', 'required'),
            array('courseId, moduleId, id_template', 'numerical', 'integerOnly' => true),
            // The following rule is used by search().
            array('id, courseId, moduleId, id_template, showDate, endDate, startDate, serviceType', 'safe'),
            // @todo Please remove those attributes that should not be searched.
            array('id, courseId, moduleId, id_template, showDate, endDate, startDate, serviceType', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'schemesTemplate' => array(self::BELONGS_TO, 'PaymentSchemeTemplate', ['id_template'=>'id']),
            'course' => array(self::BELONGS_TO, 'Course', 'courseId'),
            'module' => array(self::BELONGS_TO, 'Module', 'moduleId'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'id_template' => 'Id шаблону схем',
            'courseId' => 'Id курса',
            'moduleId' => 'Id модуля',
            'showDate' => 'початок відображення спеціальної пропозиції',
            'endDate' => 'початок дії шаблону схем',
            'startDate' => 'закінчення дії шаблону схем',
            'serviceType' => 'Тип сервісу, на який застосовується шаблон'
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
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id, true);
        $criteria->compare('id_template', $this->id_template, true);
        $criteria->compare('courseId', $this->courseId, true);
        $criteria->compare('moduleId', $this->moduleId, true);
        $criteria->compare('showDate', $this->showDate, true);
        $criteria->compare('startDate', $this->startDate, true);
        $criteria->compare('endDate', $this->endDate);
        $criteria->compare('serviceType', $this->serviceType);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return PromotionPaymentScheme the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
}
