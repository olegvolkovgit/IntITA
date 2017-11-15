<?php

/**
 * Description of AbstractService
 *
 * @author alterego4
 */
abstract class AbstractIntITAService extends CActiveRecord
{
    abstract protected function setMainModel($model, $educForm);
    abstract protected function mainModel();
    abstract protected function primaryKeyValue();
    abstract protected function descriptionFormatted();
    abstract public function getProductTitle();
    abstract public function getBillableObject();
    abstract public function getEducationForm();
    abstract protected function getService($serviceId, EducationForm $educationForm);

    protected static function createService($serviceClass,$service_param,$service_param_value, EducationForm $educForm)
    {
        $service = new $serviceClass();
        $service->$service_param = $service_param_value;
        $service->education_form = $educForm->id;
        $service->save();

        return $service;
    }

    protected static function _getService($serviceClass, $service_param, $service_param_value, EducationForm $educForm)
    {
        if (!$serviceClass::model()->exists($service_param.'='.$service_param_value.' and education_form='.$educForm->id))
        {
            return self::createService($serviceClass,$service_param,$service_param_value, $educForm);
        } else {
            return $serviceClass::model()->findByAttributes(array(
                $service_param => $service_param_value,
                'education_form' => $educForm->id
            ));
        }
    }

    protected function beforeValidate()
    {
        $this->setModelIfNeeded();
        return parent::beforeValidate();
    }

    protected function setModelIfNeeded()
    {
        $this->setMainModel($this->mainModel()->findByPk($this->primaryKeyValue()),  $this->education_form);
        if (!$this->service) {
            $service = new Service();
            $service->description = $this->descriptionFormatted();
            $service->save();
            $this->service = $service;
            $this->service_id = $service->service_id;
        }
    }

    public static function getServiceById($serviceId){
        if (CourseService::model()->exists('service_id = :id', array(':id' => $serviceId))){
            return CourseService::model()->findByAttributes(array('service_id' => $serviceId));
        } else {
            if(ModuleService::model()->exists('service_id = :id', array(':id' => $serviceId))){
                return ModuleService::model()->findByAttributes(array('service_id' => $serviceId));
            }
        }
        return null;
    }

    public static function getServiceTitle($serviceId){
        return AbstractIntITAService::getServiceById($serviceId)->getProductTitle();
    }

    /**
     * @param EducationForm $educationForm
     * @param $userId
     * @return array
     */
    public function getPaymentSchemas(EducationForm $educationForm, $userId=null) {
        if(Yii::app()->user->model->isAccountant() && $userId){
            $user = StudentReg::model()->findByPk($userId);
        }else{
            $user = StudentReg::model()->findByPk(Yii::app()->user->getId());
        }
        $paymentSchemas = PaymentScheme::model()->getPaymentScheme($user, $this);
        $calculator = $paymentSchemas->getSchemaCalculator($educationForm,'module');
        $result = [];
        switch ($this->getServiceType()){
            case ModuleService::MODULE_SERVICE:
                $model = 'moduleModel';
                break;
            case CourseService::COURSE_SERVICE:
                $model = 'courseModel';
                break;
        }
        
        foreach ($calculator as $schema) {
            $payment = $schema->getPaymentProperties();
            $totalPayment = $schema->getSumma($this->$model);
            $paymentsCount = key_exists('paymentsCount', $payment) ? (int) $payment['paymentsCount'] : 1;
            $payment['fullPrice'] = $educationForm->id==EducationForm::ONLINE?sprintf("%01.2f",$this->$model->getBasePrice()):sprintf("%01.2f",$this->$model->getBasePrice()*Config::getCoeffModuleOffline());
            $payment['price'] = sprintf ("%01.2f",$totalPayment);
            $payment['approxMonthPayment'] = round($totalPayment / $paymentsCount, 2);
            $payment['educForm'] = $educationForm->id==EducationForm::ONLINE?'online':'offline';
            $payment['schemeId'] = $schema->id;

            if($this->getServiceType()==ModuleService::MODULE_SERVICE) {
                if($schema->payCount==PaymentScheme::ADVANCE){
                    if($educationForm->id==EducationForm::ONLINE){
                        $payment['inCourse']=$this->$model->modulePrice(1);
                    }else{
                        $payment['inCourse']=$this->$model->modulePrice(1)*$educationForm->getCoefficient();
                    }
                }
            }

            $result[] = $payment;
        }

        return $result;
    }
    
    public function getPaymentSchemasByTemplate(EducationForm $educationForm, $templateId) {
        $paymentSchemeTemplate = PaymentSchemeTemplate::model()->findByPk($templateId);

        $calculator = $paymentSchemeTemplate->getSchemaCalculator($educationForm);
        $result = [];
        switch ($this->getServiceType()){
            case ModuleService::MODULE_SERVICE:
                $model = 'moduleModel';
                break;
            case CourseService::COURSE_SERVICE:
                $model = 'courseModel';
                break;
        }
        foreach ($calculator as $schema) {
            $payment = $schema->getPaymentProperties();
            $totalPayment = $schema->getSumma($this->$model);
            $paymentsCount = key_exists('paymentsCount', $payment) ? (int) $payment['paymentsCount'] : 1;
            $payment['fullPrice'] = $educationForm->id==EducationForm::ONLINE?sprintf("%01.2f",$this->$model->getBasePrice()):sprintf("%01.2f",$this->$model->getBasePrice()*Config::getCoeffModuleOffline());
            $payment['price'] = sprintf ("%01.2f",$totalPayment);
            $payment['approxMonthPayment'] = round($totalPayment / $paymentsCount, 2);
            $payment['educForm'] = $educationForm->id==EducationForm::ONLINE?'online':'offline';
            $payment['schemeId'] = $schema->id;

            $result[] = $payment;
        }

        return $result;
    }
}