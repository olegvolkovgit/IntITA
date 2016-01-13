<?php

class PaymentsController extends Controller
{
    public function filters()
    {
        return array(
            'accessControl',
        );
    }

    public function accessRules()
    {
        return array(
            array('allow',
                'expression' => array($this, 'hasAccountAccess'),
            ),
            array('deny',
                'message' => "У вас недостатньо прав для перегляду та редагування сторінки.
                Для отримання доступу увійдіть з логіном адміністратора сайту.",
                'users' => array('*'),
            ),
        );
    }

    public function hasAccountAccess()
    {
        $id = Yii::app()->user->getId();
        if($id) {
            $user = StudentReg::model()->findByPk($id);
            return $user->isAdmin() || $user->isAccountant();
        } else {
            return false;
        }
    }

    public function actionIndex($account, $nolayout = false)
    {
        $model = TempPay::model()->findByPk($account);
        if(!$account->id_user == Yii::app()->user->getId()){
            throw new \application\components\Exceptions\IntItaException('403', 'У вас немає доступу до цього рахунка');
        }
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