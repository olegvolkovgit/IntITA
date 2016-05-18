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

    public function actionShowPhrases($id)
    {
        $tmp = 1;
        $tmp2 = 2;
        $tmp3 = 3;

        $this->renderPartial('/_tenant/_allPhrases', array(
            'modules' => $tmp,
            'user' => $tmp2
        ), false, true);
    }

}