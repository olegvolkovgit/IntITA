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
        if (isset($_GET['print'])) {
            $this->layout = false;
        }
        $model = TempPay::model()->findByPk($account);
        setcookie("idModule", '', 1, '/');
        setcookie("idCourse", '', 1, '/');
        $this->render('index', array('account'=>$model));
    }

    public function actionNewAccount(){
        $user = Yii::app()->request->getPost('user', '0');
        $courseId = Yii::app()->request->getPost('course', '0');
        $moduleId = Yii::app()->request->getPost('module', '0');
        $summaNum = Yii::app()->request->getPost('summaNum', '0');

        //var_dump($_POST);die();
        if($courseId != 0) {
            if($moduleId != 0){
                $module = Module::model()->findByPk($moduleId);
                $summa = ModuleHelper::getSummaBySchemaNum($moduleId, $summaNum);
            } else {
                $course = Course::model()->findByPk($courseId);
                $summa = CourseHelper::getSummaBySchemaNum($courseId, $summaNum);
            }
        } else {
            $course = 0;
            $summa = 0;
        }
        $accountId = TempPay::addAccount($user, $courseId, $moduleId, $summa);

        echo (isset($accountId))?$accountId:'0';
    }

    public function actionAccountPrint($account){
        $model = TempPay::model()->findByPk($account);
        setcookie("idModule", '', 1, '/');
        setcookie("idCourse", '', 1, '/');
        $this->layout = false;
        $this->renderPartial('index', array('account'=>$model));
    }
}