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

    public function actionAddCountry(){
        $this->renderPartial('_addCountry', array(), false, true);
    }

    public function actionAddCity(){
        $this->renderPartial('_addCity', array(), false, true);
    }
}