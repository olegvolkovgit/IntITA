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
        $this->renderPartial('_addForm', array(), false, true);
    }

    public function actionNewCompany(){
        $model = new CorporateEntity();
        $model->attributes = $_POST;
        var_dump($model);die;
    }

    public function actionViewCompany($id){
        $model = CorporateEntity::model()->findByPk($id);

        $this->renderPartial('_viewCompany', array(
            'model' => $model
        ), false, true);
    }
}