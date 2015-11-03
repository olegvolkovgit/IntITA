<?php

class PaymentsController extends Controller
{
    public function actionAccount($id, $nolayout = false)
    {
        $model = Invoice::model()->findByPk($id);
        if($nolayout){
            $this->layout = false;
        }
        $this->render('account', array('invoice'=>$model));
    }

    public function actionIndex(){
        $user = Yii::app()->request->getPost('user', '0');
        $course = Yii::app()->request->getPost('course', '0');
        $module = Yii::app()->request->getPost('module', '0');
        $type = Yii::app()->request->getPost('type', '');
        $schemaNum = Yii::app()->request->getPost('payment', '0');

        switch ($type){
            case 'Module':
                $agreement = UserAgreements::moduleAgreement($user, $module, 1);
                break;
            case 'Course':
                $agreement = UserAgreements::courseAgreement($user, $course, $schemaNum);
                break;
            default :
                $agreement = null;
                break;
        }

        $criteria = new CDbCriteria();
        $criteria->addCondition('agreement_id='.$agreement->id);

        $dataProvider = new CActiveDataProvider('Invoice');
        $dataProvider->criteria = $criteria;
        $dataProvider->setPagination(array(
                'pageSize' => 24,
            )
        );

        $this->render('index', array(
           'dataProvider' => $dataProvider,
           'agreement' => $agreement->id,
        ));
    }
}