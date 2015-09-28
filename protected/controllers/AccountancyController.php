<?php

/**
 * Description of AccountancyController
 *
 * @author alterego4
 */
class AccountancyController extends Controller
{
    public function actionIndex($courseId=0, $moduleId=0, $summa)
    {
        if($courseId != 0) {
            $course = Course::model()->findByPk($courseId);
        } else {
            $course = 0;
        }
        if($moduleId != 0){
            $module = Module::model()->findByPk($moduleId);
        } else {
            $module = 0;
        }

        if (isset($_GET['print'])) {
            $this->layout = false;
        }

        TempPay::addAccount(Yii::app()->user->getId(), ($courseId != 0)?$courseId:null,
            ($moduleId != 0)?$moduleId:null, $summa);

        $this->render('index', array(
            'course' => $course,
            'module' => $module,
        ));
    }
}