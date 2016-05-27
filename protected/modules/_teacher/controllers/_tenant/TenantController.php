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
    public function actionSavePhrase($phrase){

        $tmp=Tenant::savePhrase($phrase);
        return true;

    }
    public function actionEditPhrase($id){

        $tmp=Tenant::editPhrase($id);

        $this->renderPartial('/_tenant/editPhrase', array('phrase'=>$tmp,'id'=>$id), false, true);
    }
    public function actionUpdatePhrase($phrase,$id){

        $tmp=Tenant::updatePhrase($phrase,$id);
            return true;

    }
    public function actionDeletePhrase($id){

        $tmp=Tenant::deletePhrase($id);
        $this->renderPartial('/_tenant/allPhrases', array(), false, true);


    }
    public function actionSearchChats()
    {


        $this->renderPartial('/_tenant/searchChats', array(), false, true);
    }
    public function actionFindChats($user1,$user2)
    {
            echo Tenant::getListOfChatsBetweenUsers($user1,$user2);


    }
    public function actionShowChats($user1,$user2)
    {


        $this->renderPartial('/_tenant/showChats', array('user1'=>$user1,'user2'=>$user2), false, true);
    }
}