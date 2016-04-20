<?php

class AddressController extends TeacherCabinetController
{
    public function hasRole(){
        return Yii::app()->user->model->isAdmin();
    }

    public function actionIndex()
    {
        $this->renderPartial('index', array(), false, true);
    }

    public function actionGetCountriesList(){
        echo AddressCountry::countriesList();
    }

    public function actionGetCitiesList(){
        echo AddressCity::citiesList();
    }
}