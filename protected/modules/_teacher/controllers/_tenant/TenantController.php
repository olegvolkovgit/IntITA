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
        $adapter = new NgTableAdapter('ChatPhrases',$_GET);
        echo json_encode($adapter->getData());
        //echo Tenant::getAllPhrases();

    }
    public function actionRenderAddPhrase()
    {

        $model=new ChatPhrases;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        $this->performAjaxValidation($model);

        if(isset($_POST['ChatPhrases']))
        {
            $model->attributes=$_POST['ChatPhrases'];
            $valid=$model->validate();
            if($valid) {
                $model->save();
                echo CJSON::encode(array(
                    'status' => 'success'
                ));
                Yii::app()->end();
            }
            else{
                $error = CActiveForm::validate($model);
                if($error!='[]')
                    echo $error;
                Yii::app()->end();
            }
//
//
//            $model->attributes=$_POST['ChatPhrases'];
//            if($model->save())
//                $this->redirect(array('view','id'=>$model->id));
        }

        $this->renderPartial('/_tenant/_form',array(
            'model'=>$model,
        ));


//        $view = '/_tenant/addPhrase';
//        $this->renderPartial($view, array(), false, true);
    }
    public function actionSavePhrase($phrase){

        $tmp=Tenant::savePhrase($phrase);
        return true;

    }
    public function actionEditPhrase($id){

            $model=$this->loadModel($id);

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

            if(isset($_POST['ChatPhrases']))
            {
                $model->attributes=$_POST['ChatPhrases'];
                if($model->save())
                    $this->redirect(array('view','id'=>$model->id));
            }

            $this->renderPartial('/_tenant/_form',array(
                'model'=>$model,
            ));


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

        $params["page"] = $_GET["page"];
        $params["count"] = $_GET["count"];
        $criteria = new CDbCriteria();
        $criteria->with =['author','roomUsers'];
        if (isset($_GET["author"]) && isset($_GET["user"])) {
            $criteria->addCondition('author.id =:author AND roomUsers.users_id=:userId');
            $criteria->params = [':author' => $_GET["author"], ':userId' => $_GET["user"]];
        }
        elseif(isset($_GET["author"])){
            $criteria->addCondition('author.id =:author');
            $criteria->params = [':author' => $_GET["author"]];
        }
        elseif(isset($_GET["user"])){
            $criteria->addCondition('roomUsers.users_id=:userId');
            $criteria->params = [':userId' => $_GET["user"]];
        }
        $criteria->together = true;
        $ngTable = new NgTableAdapter('ChatRoom',$params);
        $ngTable->mergeCriteriaWith($criteria);
        echo json_encode($ngTable->getData());

        //echo Tenant::getListOfChatsBetweenUsers($author,$user);


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

    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='chat-phrases-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function loadModel($id)
    {
        $model=ChatPhrases::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

}