<?php

class ExternalSourcesController extends TeacherCabinetController
{
    public function hasRole(){
        return Yii::app()->user->model->isAccountant();
    }

    /**
     * Manages all models.
     */
    public function actionIndex()
    {
        $sources = ExternalSources::model()->findAll();

        $this->renderPartial('index',array(
            'sources'=>$sources,
        ), false, true);
    }

    public function actionGetSources() {
        $models = ExternalSources::model()->findAll();
        echo json_encode(AccountancyHelper::toAssocArray($models));
    }

}