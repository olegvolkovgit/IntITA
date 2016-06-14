<?php

class RepresentativeController extends TeacherCabinetController
{
    public function hasRole(){
        return Yii::app()->user->model->isAccountant();
    }

    public function actionIndex()
    {
        $this->renderPartial('index', array(), false, true);
    }

    public function actionGetRepresentativesList(){
        echo CorporateRepresentative::representativesList();
    }

    public function actionRenderAddForm(){
        $this->renderPartial('_addForm', array(), false, true);
    }

    public function actionViewRepresentative($id){
        $model = CorporateRepresentative::model()->findByPk($id);
        $companies = $model->companies();

        $this->renderPartial('_viewRepresentative', array(
            'model' => $model,
            'companies' => $companies
        ), false, true);
    }

    public function actionNewRepresentative(){

        $name = Yii::app()->request->getPost('full_name', '');
        $position = Yii::app()->request->getPost('position', '');
        $order =  Yii::app()->request->getPost('order', 0);
        $representative = Yii::app()->request->getPost('representative', '');
        if($representative == 0){
            $model = new CorporateRepresentative();
            $model->full_name = $_POST;
            $model->save();
        } else {
            $model = CorporateRepresentative::model()->findByPk($representative);
        }
        if ($model){
            $model->addCompany();
        } else {
            echo "Неправильно введені дані.";
        }
    }

    public function actionRepresentativeByQuery($query){
        if ($query) {
            $users = CorporateRepresentative::representativesByQuery($query);
            echo $users;
        } else {
            throw new \application\components\Exceptions\IntItaException('400');
        }
    }
}