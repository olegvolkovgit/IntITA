<?php

class PaymentsController extends Controller
{
    public function actionInvoice($id, $nolayout = false)
    {
        $model = Invoice::model()->findByPk($id);
        if($nolayout){
            $this->layout = false;
        }
        $this->render('invoice', array('invoice'=>$model));
    }

    public function actionIndex(){
        $request = Yii::app()->request;
        $user = $request->getPost('user', '0');
        $course = $request->getPost('course', '0');
        $module =$request->getPost('module', '0');
        $type = $request->getPost('type', '');
        $schemaNum = $request->getPost('payment', '0');

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
                'pageSize' => 60,
            )
        );

        $this->render('index', array(
           'dataProvider' => $dataProvider,
           'agreement' => $agreement->id,
        ));
    }
}