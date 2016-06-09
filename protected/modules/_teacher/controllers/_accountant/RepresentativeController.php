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

        $this->renderPartial('_viewRepresentative', array(
            'model' => $model
        ), false, true);
    }
}