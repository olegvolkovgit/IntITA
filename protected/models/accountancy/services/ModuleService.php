<?php

/**
 * This is the model class for table "acc_module_service".
 *
 * The followings are the available columns in table 'acc_module_service':
 * @property string $service_id
 * @property integer $module_id
 * @property integer $education_form
 *
 * The followings are the available model relations:
 * @property Service $service
 * @property Module $module
 * @property EducationForm $educForm
 *
 * Behaviours
 * @property ServiceAccessBehavior access
 */
class ModuleService extends AbstractIntITAService
{
    public $module;
    public $service;

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'acc_module_service';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('service_id, module_id, education_form', 'required'),
            array('service_id, module_id, education_form', 'numerical', 'integerOnly' => true),
            array('service_id', 'length', 'max' => 10),
            // The following rule is used by search().
            array('service_id, module_id, education_form', 'safe', 'on' => 'search'),
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
            'service' => array(self::BELONGS_TO, 'Service', 'service_id'),
            'moduleModel' => array(self::BELONGS_TO, 'Module', 'module_id'),
            'educForm' => array(self::BELONGS_TO, 'EducationForm', 'education_form')
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'service_id' => 'Service',
            'module_id' => 'Module',
            'education_form' => 'Education form',
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

        $criteria->compare('service_id', $this->service_id, true);
        $criteria->compare('module_id', $this->module_id);
        $criteria->compare('education_form', $this->education_form);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return ModuleService the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function behaviors() {
        return [
            'access' => [
                'class' => 'ModuleServiceAccess'
            ]
        ];
    }

    public function primaryKey() {
        return array('module_id', 'education_form');
    }

    protected function primaryKeyValue()
    {
        return $this->module_id;
    }

    protected function descriptionFormatted()
    {
        return "Модуль " . $this->module->title_ua . " (".$this->educForm->title_ua.")";
    }

    protected function mainModel()
    {
        return Module::model();
    }

    public function getService($idModule, EducationForm $educForm)
    {
        return parent::_getService(__CLASS__, "module_id", $idModule, $educForm);
    }

    protected function setMainModel($module, $educForm)
    {
        if ($moduleService = ModuleService::model()->findByAttributes(array('module_id' => $module->module_ID,'education_form'=>$educForm))) {
            $this->service = Service::model()->findByPk($moduleService->service_id);
        }
        $this->module = $module;
    }

    public function getDuration()
    {
        return $this->module->getDuration();
    }

    public function getBillableObject()
    {
        if (!$this->module) {
            $this->setModelIfNeeded();
        }
        return $this->module;
    }

    public function getProductTitle()
    {
        if (!$this->module) {
            $this->setModelIfNeeded();
        }
        return "Модуль №" . $this->module->module_number . ". " . $this->module->title_ua . ', ' .
        $this->module->level();
    }

    public static function getAllModulesList()
    {
        $criteria = new CDbCriteria;
        $criteria->mergeWith(array(
            'join' => 'LEFT JOIN acc_user_agreements ua ON ua.service_id = t.service_id',
            'condition' => 'ua.service_id = t.service_id'
        ));
        return ModuleService::model()->findAll($criteria);
    }

    public function checkAccess($idModule)
    {
        if ($this->module_id == $idModule) {
            $billable = $this->service->billable;
            if ($billable)
                return true;
        }
        return false;
    }

    public function getEducationForm(){
        return $this->educForm;
    }

    /**
     * @param EducationForm $educationForm
     * @return array
     */
    public function getPaymentSchemas(EducationForm $educationForm) {
        $user = StudentReg::model()->findByPk(Yii::app()->user->getId());
        $paymentSchemas = PaymentScheme::model()->getPaymentScheme($user, $this);
        $calculator = $paymentSchemas->getSchemaCalculator($educationForm,'module');
        $result = [];

        foreach ($calculator as $schema) {
            $payment = $schema->getPaymentProperties();
            $totalPayment = $schema->getSumma($this->moduleModel);
            $paymentsCount = key_exists('paymentsCount', $payment) ? (int) $payment['paymentsCount'] : 1;
            $payment['fullPrice'] = $educationForm->id==EducationForm::ONLINE?sprintf("%01.2f",$this->moduleModel->getBasePrice()):sprintf("%01.2f",$this->moduleModel->getBasePrice()*Config::getCoeffModuleOffline());
            $payment['price'] = sprintf ("%01.2f",$totalPayment);
            $payment['approxMonthPayment'] = round($totalPayment / $paymentsCount, 2);
            $payment['educForm'] = $educationForm->id==EducationForm::ONLINE?'online':'offline';
            $payment['schemeId'] = $schema->id;
            if($schema->payCount==PaymentScheme::ADVANCE){
                if($educationForm->id==EducationForm::ONLINE){
                    $payment['inCourse']=$this->moduleModel->modulePrice(1);
                }else{
                    $payment['inCourse']=$this->moduleModel->modulePrice(1)*$educationForm->getCoefficient();
                }
            }
            
            $result[] = $payment;
        }

        return $result;
    }
}
