<?php

/**
 * Description of AbstractService
 *
 * @author alterego4
 */
abstract class AbstractIntITAService extends CActiveRecord
{
    abstract protected function setMainModel($model);
    abstract protected function mainModel();
    abstract protected function primaryKeyValue();
    abstract protected function descriptionFormatted();
    abstract public function getProductTitle();
    abstract public function getBillableObject();
    abstract public function getEducationForm();

    protected static function createService($serviceClass,$service_param,$service_param_value, EducationForm $educForm)
    {
        $service = new $serviceClass();
        $service->$service_param = $service_param_value;
        $service->education_form = $educForm->id;
        $service->save();

        return $service;
    }

    protected static function getService($serviceClass,$service_param,$service_param_value, EducationForm $educForm)
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
        $this->setMainModel($this->mainModel()->findByPk($this->primaryKeyValue()));
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
}