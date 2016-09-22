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

        $view = '/_tenant/addPhrase';
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
    public function actionFindChats($author=0,$user=0)
    {
        $ngTable = new NgTableAdapter('ChatRoom',['page'=>1,'count'=>'10000']);
        $test = json_encode($ngTable->getData());

        echo Tenant::getListOfChatsBetweenUsers($author,$user);


    }
    public function actionFindChat($id)
    {
        echo Tenant::getListOfMessagesBetweenUsers($id);


    }

    public function actionShowChats($author,$user)
    {


        $this->renderPartial('/_tenant/showChats', array('author'=>$author,'user'=>$user), false, true);
    }
    public function actionBots()
    {
        $this->renderPartial('/_tenant/bots', array(), false, true);
    }

    public function actionGetCharUsersByQuery($query){
        $query = urlencode($query);
        $criteria = new CDbCriteria();
        $criteria->alias ='t';
        $criteria->addCondition('t.nick_name IS NOT NULL');
        $criteria->addSearchCondition('LOWER(nick_name)',strtolower($query),true,'AND');
        $criteria->addSearchCondition('LOWER(user.firstName)',$query,true,'OR');
        $criteria->addSearchCondition('LOWER(user.middleName)',$query,true,'OR');
        $criteria->addSearchCondition('LOWER(user.secondName)',$query,true,'OR');
        $criteria->addSearchCondition('LOWER(user.email)',$query,true,'OR');
        $records = ChatUser::model()->with('user')->findAll($criteria);
        $result = ["results"];
        foreach($records as $record){
            $result["results"][] = $record->getAttributes();
        }
        echo json_encode($result);

    }

}