<?php

class TemplateController extends TeacherCabinetController
{
    public function hasRole(){
        $allowedActions=['getAgreementTemplate'];

        return Yii::app()->user->model->isAuditor() ||
            (Yii::app()->user->model->isAccountant() || Yii::app()->user->model->isStudent()
                && in_array(Yii::app()->controller->action->id,$allowedActions));
    }

    public function actionIndex($id=0)
    {
        $this->renderPartial('index', array(), false, true);
    }

    public function actionOffer()
    {
        $this->renderPartial('offer',array(),false,true);
    }

    public function actionEditOffer($lang){
        $this->renderPartial('_editOffer',array(
            'lang' => $lang
        ),false,true);
    }

    public function actionUpdateOffer(){
        $lang = Yii::app()->request->getPost('lang', '');
        $text = Yii::app()->request->getPost('text', '');

        $url = 'files/offers/offer_' . $lang . '.html';
        if(file_put_contents($url, $text)){
            echo 'Зміни успішно збережено.';
        } else {
            echo 'Зміни не вдалося зберегти.';
        }
    }

    public function actionWrittenAgreementsList()
    {
        $this->renderPartial('writtenAgreementsList', array(), false, true);
    }

    public function actionWrittenAgreement()
    {
        $this->renderPartial('writtenAgreement', array('scenario'=>'create'), false, true);
    }

    public function actionWrittenAgreementView()
    {
        $this->renderPartial('writtenAgreement', array('scenario'=>'view'), false, true);
    }

    public function actionWrittenAgreementUpdate()
    {
        $this->renderPartial('writtenAgreement', array('scenario'=>'update'), false, true);
    }

    public function actionWrittenAgreementsApplied()
    {
        $this->renderPartial('writtenAgreementsApplied', array(), false, true);
    }

    public function actionCreate(){
        $template = Yii::app()->request->getPost('template');

        $model = new WrittenAgreementTemplate();
        $model->attributes=$template;
        $model->id_organization=Yii::app()->user->model->getCurrentOrganization()->id;
        $model->create_by=Yii::app()->user->getId();
        $model->save();
    }

    public function actionUpdate(){
        $template = Yii::app()->request->getPost('template');
        $model=WrittenAgreementTemplate::model()->findByPk($template['id']);
        Yii::app()->user->model->hasAccessToOrganizationModel($model);
        $model->attributes=$template;
        $model->create_by=Yii::app()->user->getId();
        $model->save();
    }

    public function actionGetAgreementTemplate(){
        $params = array_filter($_POST);
        if(isset($params['agreementId'])){
            $agreement=UserAgreements::model()->findByPk($params['agreementId']);
            $writtenAgreementTemplate=$agreement->getActualWrittenTemplate();
        }else{
            $writtenAgreementTemplate=WrittenAgreementTemplate::model()->findByPk($params['id']);
            Yii::app()->user->model->hasAccessToOrganizationModel($writtenAgreementTemplate);
        }
        $data['data']=$writtenAgreementTemplate;
        echo CJSON::encode($data);
    }

    public function actionGetAgreementWrittenTemplateList() {
        $requestParams = $_GET;
        $ngTable = new NgTableAdapter('WrittenAgreementTemplate', $requestParams);
        $criteria =  new CDbCriteria();
        $criteria->alias = 't';
        $criteria->addCondition('t.id_organization='.Yii::app()->user->model->getCurrentOrganization()->id);
        $ngTable->mergeCriteriaWith($criteria);
        $result = $ngTable->getData();
        echo json_encode($result);
    }

    public function actionGetTemplatesList()
    {
        $criteria = new CDbCriteria();
        $criteria->condition='id_organization='.Yii::app()->user->model->getCurrentOrganization()->id;

        echo CJSON::encode(WrittenAgreementTemplate::model()->findAll($criteria));
    }

    public function actionSaveUpdateAgreement(){
        $agreementId = Yii::app()->request->getPost('agreementId');
        $template = Yii::app()->request->getPost('template');
        $userWrittenAgreement=UserWrittenAgreement::model()->findByAttributes(array(
            'id_agreement'=>$agreementId,
            'actual'=>UserWrittenAgreement::ACTUAL,
        ));
        if($userWrittenAgreement){
            $userWrittenAgreement->html_for_edit=$template;
        }else{
            $userWrittenAgreement= new UserWrittenAgreement();
            $userWrittenAgreement->id_agreement=$agreementId;
            $userWrittenAgreement->html_for_edit=$template;
            $userWrittenAgreement->actual=UserWrittenAgreement::ACTUAL;
        }

        $userWrittenAgreement->save();
    }

    public function actionCancelAppliedAgreement()
    {
        $params = array_filter($_POST);
        $service=Service::model()->findByPk($params['service_id']);
        $service->written_agreement_template_id=WrittenAgreementTemplate::DEFAULT_TEMPLATE;
        $service->save();
    }

    public function actionApplyWrittenAgreementForService()
    {
        $params = array_filter($_POST);
        $service=Service::model()->findByPk($params['service_id']);
        $service->written_agreement_template_id=$params['written_agreement_template_id'];
        $service->save();
    }
}