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

    public function actionGetCompaniesList(){
        echo CorporateEntity::companiesList();
    }

    public function actionRenderAddForm(){
        $this->renderPartial('_addCompanyForm', array(), false, true);
    }
}