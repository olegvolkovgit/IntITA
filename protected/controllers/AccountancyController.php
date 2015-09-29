<?php

/**
 * Description of AccountancyController
 *
 * @author alterego4
 */
class AccountancyController extends Controller
{
    public function actionIndex($account)
    {
        $model = TempPay::model()->findByPk($account);

        $this->render('index', array('account'=>$model));
    }

    public function actionNewAccount(){
        $courseId = Yii::app()->request->getPost('course', '0');
        $moduleId = Yii::app()->request->getPost('module', '0');
        $summaNum = Yii::app()->request->getPost('summaNum', '0');

        $summa = CourseHelper::getSummaBySchemaNum($courseId, $summaNum);

        if($courseId != 0) {
            $course = Course::model()->findByPk($courseId);
            $summa = CourseHelper::getSummaBySchemaNum($courseId, $summaNum);
        } else {
            $course = 0;
        }
        if($moduleId != 0){
            $module = Module::model()->findByPk($moduleId);
            $summa = ModuleHelper::getSummaBySchemaNum($moduleId, $summaNum);
        } else {
            $module = 0;
        }

        if (isset($_GET['print'])) {
            $this->layout = false;
        } else {
            $accountId = TempPay::addAccount(Yii::app()->user->getId(), $courseId, $moduleId, $summa);
        }

        echo (isset($accountId))?$accountId:'0';
    }
}