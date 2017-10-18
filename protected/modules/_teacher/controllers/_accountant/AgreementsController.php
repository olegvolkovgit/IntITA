<?php

class AgreementsController extends TeacherCabinetController {
    public function hasRole() {
        $allowedTrainerActions = ['renderUserAgreements','getUserAgreementsList','agreement','getAgreement'];
        $allowedAuditorsActions = ['index','getAgreementsList','agreement','getAgreement'];
        $action = Yii::app()->controller->action->id;
        return Yii::app()->user->model->isAccountant() ||
            (Yii::app()->user->model->isTrainer() && in_array($action, $allowedTrainerActions)) ||
            (Yii::app()->user->model->isAuditor() && in_array($action, $allowedAuditorsActions));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return UserAgreements the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = UserAgreements::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param UserAgreements $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'user-agreements-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /**
     * Lists all models.
     * @param $organization
     */
    public function actionIndex($organization) {
        $this->renderPartial('index', array('organization'=>$organization));
    }

    public function actionGetAgreementsList() {
        $requestParams = $_GET;
        $organization = Yii::app()->user->model->getCurrentOrganization();
        $ngTable = new NgTableAdapter(UserAgreements::model()->belongsToOrganization($organization), $requestParams);
        $result = $ngTable->getData();
        echo json_encode($result);
    }

    public function actionGetUserAgreementsList() {
//        $requestParams = $_GET;
//        $organization = Yii::app()->user->model->getCurrentOrganization();
//        $ngTable = new NgTableAdapter(UserAgreements::model()->belongsToOrganization($organization), $requestParams);
//        $result = $ngTable->getData();
//        echo json_encode($result);

//        todo
        $requestParams = $_GET;
        $ngTable = new NgTableAdapter('UserAgreements', $requestParams);
        $criteria =  new CDbCriteria();
        $criteria->alias = 't';
        $criteria->join = 'left join acc_course_service cs on cs.service_id=t.service_id';
        $criteria->join .= ' left join course c on c.course_ID=cs.course_id';
        $criteria->join .= ' left join acc_module_service ms on ms.service_id=t.service_id';
        $criteria->join .= ' left join module m on m.module_ID=ms.module_id';
        $criteria->addCondition('t.user_id='.$requestParams['user'].' and (m.id_organization='.Yii::app()->user->model->getCurrentOrganization()->id.' 
        or c.id_organization='.Yii::app()->user->model->getCurrentOrganization()->id.')');
        $ngTable->mergeCriteriaWith($criteria);
        $result = $ngTable->getData();
        echo json_encode($result);
    }
    
    public function actionGetTypeahead($query) {
        $agreements = new Agreements();
        $models = $agreements->getTypeahead($query);
        echo json_encode($models);
    }

    public function actionConfirm($id = 0) {
        $model = UserAgreements::model()->findByPk($id);
        $response = [];
        if ($model && $model->confirm(Yii::app()->user)) {
            $response['result'] = 'success';
        } else {
            $response['result'] = 'fail';
        }

        echo json_encode($response);
    }

    public function actionCancel($id = 0) {
        $model = UserAgreements::model()->findByPk($id);
        $response = [];
        if ($model && $model->cancel(Yii::app()->user)) {
            $response['result'] = 'success';
        } else {
            $response['result'] = 'fail';
        }
        echo json_encode($response);
    }

    public function actionAgreement($id) {
        $agreement=UserAgreements::model()->findByPk($id);
        if(!$agreement->checkAgreementView()){
            throw new \application\components\Exceptions\IntItaException(403, 'Ти не маєш доступу до дії в межах даної організації');
        }

        $this->renderPartial('agreement');
    }

    public function actionGetAgreement($id) {
        $agreements = new Agreements();
        $agreements->getUserAgreement($id);
        echo json_encode($agreements->getUserAgreement($id), JSON_FORCE_OBJECT);
    }

    public function actionRenderUserAgreements($idUser) {
        Yii::app()->user->model->hasAccessToOrganizationModel(
            TrainerStudent::model()->findByAttributes(
                array(
                    'student'=>$idUser,
                    'trainer'=>Yii::app()->user->getId(),
                    'id_organization'=>Yii::app()->user->model->getCurrentOrganization()->id,
                    'end_time'=>null,
                )
            ));
        $this->renderPartial('userAgreements');
    }

    public function actionGetActualWrittenAgreementRequestsCount()
    {
        echo count(MessagesWrittenAgreementRequest::model()->with('agreement','agreement.organization')->findAll(
            'organization.id='.Yii::app()->user->model->getCurrentOrganization()->id.' 
            and t.status is null'));
    }

    public function actionAgreementsRequests()
    {
        $this->renderPartial('agreementsrequests',array(),false,true);
    }

    public function actionGetAgreementRequestsNgTable()
    {
        $requestParams = $_GET;
        $criteria =  new CDbCriteria();
        $criteria->join = 'left join acc_user_agreements ua on ua.id=t.id_agreement';
        $criteria->join .= ' left join acc_corporate_entity ce on ce.id=ua.id_corporate_entity';
        $criteria->join .= ' left join organization o on o.id=ce.id_organization';
        if(isset($requestParams['filter']['status']) && $requestParams['filter']['status']=='null'){
            $criteria->condition = 't.status is null';
            unset($requestParams['filter']);
        }
        $criteria->addCondition('ce.id_organization='.Yii::app()->user->model->getCurrentOrganization()->id);
        $ngTable = new NgTableAdapter('MessagesWrittenAgreementRequest', $requestParams);
        $ngTable->mergeCriteriaWith($criteria);
        $result = $ngTable->getData();
        echo json_encode($result);
    }

    public function actionWrittenAgreementView($request=null)
    {
        if($request){
            $model=MessagesWrittenAgreementRequest::model()->findByPk($request);
            Yii::app()->user->model->hasAccessToOrganizationModel($model->agreement->corporateEntity);

            $this->renderPartial('writtenAgreementView',array('agreement'=>$model->agreement),false,true);
        }
    }

    public function actionGetWrittenAgreementData($id)
    {
        $agreement = UserAgreements::model()->with('user','invoice','corporateEntity','checkingAccount'
            ,'service',
            'corporateEntity.latestCheckingAccount',
            'corporateEntity.actualRepresentatives',
            'corporateEntity.actualRepresentatives.representative')->findByPk($id);

        $documents=$agreement->user->getActualUserDocuments();

        $data['agreement']=ActiveRecordToJSON::toAssocArray($agreement);
        $data['agreementModules']= ActiveRecordToJSON::toAssocArray(UserAgreements::model()->with('service.courseServices.courseModel.module.moduleInCourse.lectures','service.moduleServices.moduleModel')->findByPk($id));
        $data['documents']=ActiveRecordToJSON::toAssocArray($documents);
        $date = new DateTime(null, new DateTimeZone(Config::getServerTimezone()));
        $data['sessionTime']=$date->getTimestamp() + $date->getOffset();
        echo json_encode($data, JSON_FORCE_OBJECT);
    }

    public function actionGetAgreementContract($id)
    {
        $data['personParty']=ActiveRecordToJSON::toAssocArrayWithRelations(
            UserAgreementContractingParty::model()->with(
            'agreement.service','agreement.invoice','contractingParty','contractingParty.contractingPartyPrivatePerson',
                    'contractingParty.type', 'contractingParty.contractingPartyPrivatePerson.documents.documentsFiles',
                'contractingParty.contractingPartyPrivatePerson.documents.documentType',
                'contractingParty.contractingPartyPrivatePerson.privatePersonDocuments'
        )->findByAttributes(array('user_agreement_id'=>$id,'role_id'=>ContractingParty::ROLE_STUDENT))
        );

        $data['corporateParty']=ActiveRecordToJSON::toAssocArrayWithRelations(
            UserAgreementContractingParty::model()->with(
                'agreement','contractingParty','contractingParty.contractingPartyCorporateEntity.corporateEntity',
                    'contractingParty.contractingPartyCorporateEntity.checkingAccount',
                    'contractingParty.contractingPartyCorporateEntityRepresentatives','contractingParty.type',
                'contractingParty.corporateEntityRepresentatives.representative'
            )->findByAttributes(array('user_agreement_id'=>$id,'role_id'=>ContractingParty::ROLE_COMPANY))
        );
        echo json_encode(array_filter($data), JSON_FORCE_OBJECT);
    }

    public function actionApproveAgreementRequest()
    {
        $result = ['message' => 'OK'];
        $statusCode = 201;
        try {
            $params = array_filter($_POST);
            $idMessage=$params['idMessage'];
            $sessionTime=$params['sessionTime'];

            $model=MessagesWrittenAgreementRequest::model()->findByPk($idMessage);
            Yii::app()->user->model->hasAccessToOrganizationModel($model->agreement->corporateEntity);
            $model->setApproved($sessionTime);

            $model->saveAgreementPdf($params['content'],$model->agreement->user_id, $model->agreement->id);
        } catch (Exception $error) {
            $statusCode = 500;
            $result = ['message' => 'error', 'reason' => $error->getMessage()];
        }
        $this->renderPartial('//ajax/json', ['statusCode' => $statusCode, 'body' => json_encode($result)]);
    }

    public function actionRejectAgreementRequest()
    {
        $comment=$_POST['reject_comment']?$_POST['reject_comment']:null;
        $model=MessagesWrittenAgreementRequest::model()->findByPk($_POST['id_message']);
        Yii::app()->user->model->hasAccessToOrganizationModel($model->agreement->corporateEntity);
        $model->setCancelled($comment);
    }

    public function actionGetAgreementRequestStatus($idMessage)
    {
        $data['status']=MessagesWrittenAgreementRequest::model()->findByPk($idMessage)->status;
        echo json_encode($data);
    }
}