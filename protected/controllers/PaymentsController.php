<?php

class PaymentsController extends Controller
{
    public function hasAccountAccess($owner)
    {
        $id = Yii::app()->user->getId();
        if ($id) {
            $user = StudentReg::model()->findByPk($id);
            if($id == $owner){
                return true;
            }
            return $user->isAdmin() || $user->isAccountant();
        } else {
            return false;
        }
    }

    public function actionIndex($account, $nolayout = false)
    {
        $model = TempPay::model()->findByPk($account);
        if ($this->hasAccountAccess($model->id_user)) {

            if ($nolayout) {
                $this->layout = false;
            }
            $this->render('index', array('account' => $model));
        } else {
            throw new \application\components\Exceptions\IntItaException(403, 'У вас немає доступу до цього рахунка.');
        }
    }

    public function actionNewAccount()
    {
        $user = Yii::app()->request->getPost('user', '0');
        $courseId = Yii::app()->request->getPost('course', '0');
        $moduleId = Yii::app()->request->getPost('module', '0');
        $summaNum = Yii::app()->request->getPost('summaNum', '0');

        if ($courseId != 0) {
            if ($moduleId != 0) {
                $summa = Module::getModuleSumma($moduleId, $courseId);
            } else {
                $summa = Course::getSummaBySchemaNum($courseId, $summaNum);
            }
        } else {
            if ($moduleId != 0) {
                $summa = Module::getModuleSumma($moduleId, $courseId);
            } else {
                $summa = 0;
            }
        }

        $accountId = TempPay::addAccount($user, $courseId, $moduleId, $summa);

        echo (isset($accountId)) ? $accountId : '0';
    }
}