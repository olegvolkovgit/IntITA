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
 * @property integer $id_organization
 * @property integer $id_user_approved
 * @property string $approved_date
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
            array('id_template, id_user_approved', 'required'),
            array('courseId, moduleId, id_template', 'numerical', 'integerOnly' => true),
            // The following rule is used by search().
            array('id, courseId, moduleId, id_template, showDate, endDate, startDate, serviceType, id_organization, id_user_approved, approved_date', 'safe'),
            // @todo Please remove those attributes that should not be searched.
            array('id, courseId, moduleId, id_template, showDate, endDate, startDate, serviceType, id_organization, id_user_approved, approved_date', 'safe', 'on' => 'search'),
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
            'organization' => array(self::BELONGS_TO, 'Organization', 'id_organization'),
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
            'serviceType' => 'Тип сервісу, на який застосовується шаблон',
            'id_organization' => 'ID organization',
            'id_user_approved' => 'ID користувача, котрий установив акцію',
            'approved_date' => 'Дата встановлення акції',
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
        $criteria->compare('id_organization', $this->id_organization, true);
        $criteria->compare('id_user_approved', $this->id_user_approved, true);
        $criteria->compare('approved_date', $this->approved_date, true);

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
