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
        $course = Yii::app()->request->getPost('course', '0');
        $module = Yii::app()->request->getPost('module', '0');
        $summaNum = Yii::app()->request->getPost('summaNum', '0');

        $typeBillableObject = TempPay::checkBillableObjectType($course, $module);
        $summa = 0;
        if ($typeBillableObject == 'Module')

        if($typeBillableObject == 'Module') {
            $summa = $typeBillableObject::model()->findByPk($module)->getBasePrice();
            UserAgreements::moduleAgreement($user, $module, 1);
        }
        if($typeBillableObject == 'Course') {
            $summa = $typeBillableObject::model()->findByPk($course)->getBasePrice();
            UserAgreements::courseAgreement($user, $course, $summaNum);
        }

        $accountId = TempPay::addAccount($user, $course, $module, $summa);
        echo (isset($accountId))?$accountId:'0';
    }
}