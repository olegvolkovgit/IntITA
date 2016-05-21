<?php
/**
 * Created by PhpStorm.
 * User: Игорь
 * Date: 18.05.2016
 * Time: 20:05
 */


class TenantController extends TeacherCabinetController
{
    public function hasRole(){
        return Yii::app()->user->model->isTenant();
    }

    public function actionShowPhrases()
    {


        $this->renderPartial('/_tenant/allPhrases', array(), false, true);
    }
    public function actionGetAllPhrases()
    {

        echo Tenant::getAllPhrases();

    }
    public function actionRenderAddPhrase()
    {

        $view = "/_tenant/addPhrase";
        $this->renderPartial($view, array(), false, true);
    }
    public function savePhrase(){

        Tenant::savePhrase();
    }
}