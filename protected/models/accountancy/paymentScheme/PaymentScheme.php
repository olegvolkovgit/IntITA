<?php

/**
 * This is the model class for table "acc_payment_schema".
 *
 * The followings are the available columns in table 'acc_payment_schema':
 * @property integer $id
 * @property integer $id_template
 * @property integer $userId
 * @property integer $serviceId
 * @property integer $payCount
 * @property string $startDate
 * @property string $endDate
 */
class PaymentScheme extends CActiveRecord {

    use WithGetSchemaCalculator;

    const COURSE_SERVICE = 1;
    const MODULE_SERVICE = 2;
    
    const DEFAULT_COURSE_SCHEME = 1;
    const PROMOTIONAL_COURSE_SCHEME = 2;
    const DEFAULT_MODULE_SCHEME = 3;
    const PROMOTIONAL_MODULE_SCHEME = 4;

    const ADVANCE = 1;
    const BASE_TWO_PAYS = 2;
    const BASE_FOUR_PAYS = 3;
    const MONTHLY = 4;
    const CREDIT_TWO_YEARS = 5;
    const CREDIT_THREE_YEARS = 6;
    const CREDIT_FOUR_YEARS = 7;
    const CREDIT_FIVE_YEARS = 8;
    const BASE_THREE_PAYS = 9;
    const BASE_SIX_PAYS = 10;


    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'acc_payment_schema';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_template', 'required'),
            array('userId, serviceId, id_template', 'numerical', 'integerOnly' => true),
            // The following rule is used by search().
            array('id, userId, serviceId, id_template, endDate, startDate', 'safe'),
            // @todo Please remove those attributes that should not be searched.
            array('id, userId, serviceId, id_template, endDate, startDate', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'schemes' => array(self::HAS_MANY, 'TemplateSchemes', ['id_template'=>'id_template'], 'order' => 'schemes.pay_count'),
            'schemesTemplate' => array(self::BELONGS_TO, 'PaymentSchemeTemplate', ['id_template'=>'id']),
            'user' => array(self::BELONGS_TO, 'StudentReg', 'userId'),
            'service' => array(self::HAS_ONE, 'Service', ['service_id' => 'serviceId']),
        );
    }


    protected function beforeDelete() {
        if ($this->id==PaymentScheme::DEFAULT_COURSE_SCHEME || $this->id==PaymentScheme::PROMOTIONAL_COURSE_SCHEME
        || $this->id==PaymentScheme::DEFAULT_MODULE_SCHEME || $this->id==PaymentScheme::PROMOTIONAL_MODULE_SCHEME) {
            return false;
        }
        return parent::beforeDelete();
    }
    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'id_template' => 'Id шаблону схем',
            'userId' => 'Id користувача',
            'serviceId' => 'Id сервіса',
            'endDate' => 'Закінчення дії шаблону схем',
            'startDate' => 'Початок дії шаблону схем',
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
        $criteria->compare('userId', $this->userId);
        $criteria->compare('serviceId', $this->serviceId, true);
        $criteria->compare('startDate', $this->startDate, true);
        $criteria->compare('endDate', $this->endDate);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return PaymentScheme the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /* @TODO 06.10.16 remove static method */
    public static function getSchema($id, $educFormId) {
        $schema = null;
        $educForm = EducationForm::model()->findByPk($educFormId);
        $model = PaymentScheme::model()->findByPk($id);
        return $model->getSchemaCalculator($educForm)[0];
    }

    public static function getActualAdvancePaymentSchema($courseId,$educFormId) {
        $educForm = EducationForm::model()->findByPk($educFormId);
        return PaymentScheme::model()->getActualAdvancePaymentSchemaCalculator($courseId,$educForm);
    }

    public function getPaymentScheme($user, $service, $schemeId=null) {
        $specialOffersFactory = new SpecialOfferFactory($user, $service, $schemeId);
        $specialOffer = $specialOffersFactory->getSpecialOffer();

        if (!empty($specialOffer)) {
            return $specialOffer;
        } else {
            if (isset($service->course_id)) {
                $id=PaymentScheme::PROMOTIONAL_COURSE_SCHEME;
            } else if (isset($service->module_id)) {
                $id=PaymentScheme::PROMOTIONAL_MODULE_SCHEME;
            }
            return PaymentScheme::model()->findByPk($id);
        }
    }

    public static function getPaymentIco($count, $check=false) {
        if($count==1){
            if($check) return StaticFilesHelper::createPath('image', 'course', 'checkWallet.png');
            else return StaticFilesHelper::createPath('image', 'course', 'wallet.png');
        }else if($count==2){
            if($check) return StaticFilesHelper::createPath('image', 'course', 'checkCoins.png');
            else return StaticFilesHelper::createPath('image', 'course', 'coins.png');
        }else if($count==4){
            if($check) return StaticFilesHelper::createPath('image', 'course', 'checkMoreCoins.png');
            else return StaticFilesHelper::createPath('image', 'course', 'moreCoins.png');
        }else if($count==12){
            if($check) return StaticFilesHelper::createPath('image', 'course', 'checkCalendar.png');
            else return StaticFilesHelper::createPath('image', 'course', 'calendar.png');
        }else{
            if($check) return StaticFilesHelper::createPath('image', 'course', 'checkPercent.png');
            else return StaticFilesHelper::createPath('image', 'course', 'percent.png');
        }
    }
    
    public static function getPaymentType($count) {
        switch ($count) {
            case 1:
                return PaymentScheme::ADVANCE;
            case 2:
                return PaymentScheme::BASE_TWO_PAYS;
            case 3:
                return PaymentScheme::BASE_THREE_PAYS;
            case 4:
                return PaymentScheme::BASE_FOUR_PAYS;
            case 6:
                return PaymentScheme::BASE_SIX_PAYS;
            case 12:
                return PaymentScheme::MONTHLY;
            case 24:
                return PaymentScheme::CREDIT_TWO_YEARS;
            case 36:
                return PaymentScheme::CREDIT_THREE_YEARS;
            case 48:
                return PaymentScheme::CREDIT_FOUR_YEARS;
            case 60:
                return PaymentScheme::CREDIT_FIVE_YEARS;
            default:
                return PaymentScheme::ADVANCE;
        }
    }

    public static function getPaymentName($agreement) {
        if(isset($agreement->service->getConcreteServiceModel()->module_id)){
            $service='module';
        }else{
            $service='course';
        }
        $param=Yii::app()->session["lg"]?$service."_title_".Yii::app()->session["lg"]:$service."_title_ua";
        $payCount=TemplateSchemes::model()->findByPk($agreement->payment_schema)->pay_count;
        return SchemesName::model()->findByPk($payCount)->$param;
    }

    public static function getCourseActualSchemeTemplate() {
        $criteria = new CDbCriteria();
        $criteria->addCondition("id=" . PaymentScheme::PROMOTIONAL_COURSE_SCHEME);
        $criteria->addCondition('NOW() BETWEEN startDate and endDate');
        $paymentSchemas = PaymentScheme::model()->find($criteria);

        return !empty($paymentSchemas) ? $paymentSchemas : PaymentScheme::model()->findByPk(PaymentScheme::DEFAULT_COURSE_SCHEME);
    }

    public static function getModuleActualSchemeTemplate() {
        $criteria = new CDbCriteria();
        $criteria->addCondition("id=" . PaymentScheme::PROMOTIONAL_MODULE_SCHEME);
        $criteria->addCondition('NOW() BETWEEN startDate and endDate');
        $paymentSchemas = PaymentScheme::model()->find($criteria);

        return !empty($paymentSchemas) ? $paymentSchemas : PaymentScheme::model()->findByPk(PaymentScheme::DEFAULT_MODULE_SCHEME);
    }
    
}
