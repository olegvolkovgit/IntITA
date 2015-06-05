<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 04.06.2015
 * Time: 16:06
 */

class PayController extends Controller{

    public function actionIndex()
    {
        $this->render('index');
    }

    public function actionPayNow(){
        $permission = new Permissions();
        $permission->setRead($_POST['user'], $_POST['module']);


        $this->redirect(Yii::app()->request->urlReferrer);
    }
}