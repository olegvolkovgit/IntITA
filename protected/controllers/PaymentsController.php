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

        $typeBillableObject = TempPay::checkBillableObjectType($courseId, $moduleId);
        echo $typeBillableObject;die();
        if($courseId != 0) {
            if($moduleId != 0){
                $summa = ModuleHelper::getModuleSumma($moduleId, $courseId);
             } else {
                $summa = CourseHelper::getSummaBySchemaNum($courseId, $summaNum);
            }
        } else {
            if($moduleId != 0){
                $summa = ModuleHelper::getModuleSumma($moduleId, $courseId);
            } else {
                $summa = 0;
            }
        }
        $accountId = TempPay::addAccount($user, $courseId, $moduleId, $summa);

        if($moduleId != 0) {
            UserAgreements::moduleAgreement($user, $moduleId, 1);
        } else{
            if($courseId != 0) {
                UserAgreements::courseAgreement($user, $courseId, $summaNum);
            }
        }

        echo (isset($accountId))?$accountId:'0';
    }
}