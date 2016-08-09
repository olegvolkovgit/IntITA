<?php

class CompanyController extends TeacherCabinetController
{
    public function hasRole(){
        return Yii::app()->user->model->isAccountant();
    }

    public function actionIndex()
    {
        $this->renderPartial('index', array(), false, true);
    }

    public function actionCitiesByQuery($query){
        echo AddressCity::citiesByQuery($query);
    }

    public function actionGetCompaniesList(){
        echo CorporateEntity::companiesList();
    }

    public function actionRenderAddForm(){
        $this->renderPartial('_addForm', array(), false, true);
    }

    public function actionNewCompany(){
        $model = new CorporateEntity();
        $model->attributes = $_POST;
        $cityLegal = Yii::app()->request->getPost('legal_address_city_code', 0);
        $cityActual = Yii::app()->request->getPost('actual_address_city_code', 0);
        $cityLegalVal = Yii::app()->request->getPost('legal_address_city_value', '');
        $cityActualVal = Yii::app()->request->getPost('actual_address_city_value', '');
        if(!AddressCity::model()->findByPk($cityLegal)){
            $model->legal_address_city_code = AddressCity::newCity(AddressCountry::model()->findByPk(AddressCountry::UKRAINE), $cityLegalVal, $cityLegalVal, $cityLegalVal)->id;
        }
        if(!AddressCity::model()->findByPk($cityActual)){
            $model->actual_address_city_code = AddressCity::newCity(AddressCountry::model()->findByPk(AddressCountry::UKRAINE), $cityActualVal, $cityLegalVal, $cityLegalVal)->id;
        }
        if($model->validate()){
            $model->save();
            echo "Компанію успішно створено.";
        } else {
            echo "Неправильні дані.";
        }
    }

    public function actionViewCompany($id){
        $model = CorporateEntity::model()->findByPk($id);

        $this->renderPartial('_viewCompany', array(
            'model' => $model
        ), false, true);
    }

    public function actionCompaniesByQuery($query){
        if ($query) {
            $users = CorporateEntity::companiesByQuery($query);
            echo $users;
        } else {
            throw new \application\components\Exceptions\IntItaException('400');
        }
    }
}