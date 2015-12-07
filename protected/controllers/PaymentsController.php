<?php

class PaymentsController extends Controller
{
    public function actionIndex($account, $nolayout = false)
    {
        $model = TempPay::model()->findByPk($account);
        if($nolayout){
            $this->layout = false;
        }
        $this->render('index', array('account'=>$model));
    }

    public function actionNewAccount(){
        $user = Yii::app()->request->getPost('user', '0');
        $courseId = Yii::app()->request->getPost('course', '0');
        $moduleId = Yii::app()->request->getPost('module', '0');
        $summaNum = Yii::app()->request->getPost('summaNum', '0');

        if($courseId != 0) {
            if($moduleId != 0){
                $summa = Module::getModuleSumma($moduleId, $courseId);
            } else {
                $summa = Course::getSummaBySchemaNum($courseId, $summaNum);
            }
        } else {
            if($moduleId != 0){
                $summa = Module::getModuleSumma($moduleId, $courseId);
            } else {
                $summa = 0;
            }
        }
        $accountId = TempPay::addAccount($user, $courseId, $moduleId, $summa);

        echo (isset($accountId))?$accountId:'0';
    }
}