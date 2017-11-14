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
        $ngTable = new NgTableAdapter(UserAgreements::model()->with('service')->belongsToOrganization($organization), $requestParams);
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

    public function actionGetActualWrittenAgreementsCount()
    {
        echo count(UserWrittenAgreement::model()->with('agreement','agreement.organization')->findAll(
            'organization.id='.Yii::app()->user->model->getCurrentOrganization()->id.' 
            and t.checked_by_user='.UserWrittenAgreement::CHECKED.' and  t.checked='.UserWrittenAgreement::NOT_CHECKED));
    }

    public function actionAgreementsRequests()
    {
        $this->renderPartial('agreementsrequests',array(),false,true);
    }

    public function actionWrittenAgreementsList()
    {
        $this->renderPartial('writtenagreementslist',array(),false,true);
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

    public function actionGetWrittenAgreementsNgTable()
    {
        $requestParams = $_GET;
        $criteria =  new CDbCriteria();
        $criteria->join = 'left join acc_user_agreements ua on ua.id=t.id_agreement';
        $criteria->join .= ' left join acc_corporate_entity ce on ce.id=ua.id_corporate_entity';
        if(isset($requestParams['filter']['status'])) {
            switch ($requestParams['filter']['status']) {
                case 1:
                    $criteria->condition = 't.checked=' . UserWrittenAgreement::CHECKED;
                    break;
                case 2:
                    $criteria->condition = 't.checked_by_accountant=' . UserWrittenAgreement::CHECKED.' and t.checked_by_user=' . UserWrittenAgreement::NOT_CHECKED;
                    break;
                case 3:
                    $criteria->condition = 't.checked_by_user=' . UserWrittenAgreement::CHECKED.' and t.checked=' . UserWrittenAgreement::NOT_CHECKED;
                    break;
                default:
                    break;
            }
            unset($requestParams['filter']['status']);
        }

        $criteria->addCondition('ce.id_organization='.Yii::app()->user->model->getCurrentOrganization()->id.' and t.actual='.UserWrittenAgreement::ACTUAL);
        $ngTable = new NgTableAdapter('UserWrittenAgreement', $requestParams);
        $ngTable->mergeCriteriaWith($criteria);
        $result = $ngTable->getData();
        echo json_encode($result);
    }

    public function actionGetWrittenAgreementsAppliedNgTable()
    {
        $requestParams = $_GET;
        $criteria =  new CDbCriteria();
        $criteria->with=['courseServices.courseModel','moduleServices.moduleModel'];
        $criteria->addCondition('(courseModel.id_organization='.Yii::app()->user->model->getCurrentOrganization()->id.' 
        or moduleModel.id_organization='.Yii::app()->user->model->getCurrentOrganization()->id.') and t.written_agreement_template_id!='.WrittenAgreementTemplate::DEFAULT_TEMPLATE);
        $ngTable = new NgTableAdapter('Service', $requestParams);
        $ngTable->mergeCriteriaWith($criteria);
        $result = $ngTable->getData();
        echo json_encode($result);
    }

    public function actionWrittenAgreementView($request=null)
    {
        if($request){
            $model=MessagesWrittenAgreementRequest::model()->findByPk($request);
            Yii::app()->user->model->hasAccessToOrganizationModel($model->agreement->corporateEntity);

            $this->renderPartial('writtenAgreementView',array('agreement'=>$model->agreement,'type'=>'request'),false,true);
        }
    }

    public function actionGetWrittenAgreementData($id)
    {
        $agreement = UserAgreements::model()->with('user','invoice','corporateEntity','checkingAccount'
            ,'service.moduleServices.moduleModel.lectures',
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

    public function actionCheckAgreementPdf($agreementId)
    {
        $data['data']=ActiveRecordToJSON::toAssocArrayWithRelations(UserWrittenAgreement::model()->with('user','lastEditedUserDocument')->findByAttributes(
            array('id_agreement'=>$agreementId,'actual'=>UserWrittenAgreement::ACTUAL)));
        echo json_encode($data);
    }

    public function actionApproveAgreement()
    {
        $result = ['message' => 'OK'];
        $statusCode = 201;

        $transaction = null;
        if (Yii::app()->db->getCurrentTransaction() == null) {
            $transaction = Yii::app()->db->beginTransaction();
        }
        try {
            $params = array_filter($_POST);
            $idRequest=isset($params['idRequest'])?$params['idRequest']:false;
            $idWrittenAgreement=isset($params['writtenAgreementId'])?$params['writtenAgreementId']:false;
            $idAgreement=isset($params['id_agreement'])?$params['id_agreement']:false;
            $sessionTime=$params['sessionTime'];

            $agreement=UserAgreements::agreementByType($idAgreement, $idRequest, $idWrittenAgreement);

            Yii::app()->user->model->hasAccessToOrganizationModel($agreement->corporateEntity);
            $agreement->makePrivatePerson($sessionTime);

            if($idRequest){
                $request=MessagesWrittenAgreementRequest::model()->findByPk($idRequest);
                $request->setApproved();
            }else{
                $request=MessagesWrittenAgreementRequest::model()->findByAttributes(array('id_user'=>$agreement->user_id,'id_agreement'=>$agreement->id,'status'=>null));
                if($request)
                    $request->setApproved();
            }

            $actualWrittenAgreement = $agreement->checkAndGetWrittenAgreement($params);
            $actualWrittenAgreement->saveAgreementPdf();

            $transaction->commit();
        } catch (Exception $error) {
            $transaction->rollback();
            $statusCode = 500;
            $result = ['message' => 'error', 'reason' => $error->getMessage()];
        }
        $this->renderPartial('//ajax/json', ['statusCode' => $statusCode, 'body' => json_encode($result)]);
    }

    public function actionAgreementRequestToUser()
    {
        $result = ['message' => 'OK'];
        $statusCode = 201;

        $transaction = null;
        if (Yii::app()->db->getCurrentTransaction() == null) {
            $transaction = Yii::app()->db->beginTransaction();
        }
        try {
            $params = array_filter($_POST);
            $userAgreement=UserAgreements::model()->findByPk($params['id_agreement']);
            $userAgreement->sendAgreementRequestToUser($params);

            $transaction->commit();
        } catch (Exception $error) {
            $transaction->rollback();
            $statusCode = 500;
            $result = ['message' => 'error', 'reason' => $error->getMessage()];
        }
        $this->renderPartial('//ajax/json', ['statusCode' => $statusCode, 'body' => json_encode($result)]);
    }

    public function actionCancelAgreementRequestToUser()
    {
        $result = ['message' => 'OK'];
        $statusCode = 201;

        $transaction = null;
        if (Yii::app()->db->getCurrentTransaction() == null) {
            $transaction = Yii::app()->db->beginTransaction();
        }
        try {
            $params = array_filter($_POST);
            $agreement=UserWrittenAgreement::model()->findByPk($params['id']);
            $agreement->checked_by_accountant=UserWrittenAgreement::NOT_CHECKED;
            $agreement->checked_by_user=UserWrittenAgreement::NOT_CHECKED;
            $agreement->save();

            $transaction->commit();
        } catch (Exception $error) {
            $transaction->rollback();
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
    public function actionWrittenAgreement($id)
    {
        $model=UserWrittenAgreement::model()->findByPk($id);
        Yii::app()->user->model->hasAccessToOrganizationModel($model->agreement->corporateEntity);

        $this->renderPartial('writtenAgreementView',array('agreement'=>$model->agreement,'type'=>'agreement'),false,true);
    }

    public function actionCreateUserWrittenAgreement()
    {
        $result = ['message' => 'OK'];
        $statusCode = 201;

        $transaction = null;
        if (Yii::app()->db->getCurrentTransaction() == null) {
            $transaction = Yii::app()->db->beginTransaction();
        }
        try {
            $params = array_filter($_POST);
            $agreement=UserWrittenAgreement::model()->findByPk($params['id']);
            $agreement->checked_by_accountant=UserWrittenAgreement::NOT_CHECKED;
            $agreement->save();

            $transaction->commit();
        } catch (Exception $error) {
            $transaction->rollback();
            $statusCode = 500;
            $result = ['message' => 'error', 'reason' => $error->getMessage()];
        }
        $this->renderPartial('//ajax/json', ['statusCode' => $statusCode, 'body' => json_encode($result)]);
    }

    public function actionStudentAgreement($id)
    {
        $agreement = UserAgreements::model()->findByPk($id);
        if (!isset($agreement)) {
            throw new \application\components\Exceptions\IntItaException(400, 'Договір не знайдено.');
        }
        Yii::app()->user->model->hasAccessToOrganizationModel($agreement->corporateEntity);
        $this->renderPartial('writtenAgreementView',array('agreement'=>$agreement,'type'=>'agreement'),false,true);
    }

    public function actionSetAgreementForStudents()
    {
        $result = ['message' => 'OK'];
        $statusCode = 201;

        $transaction = null;
        if (Yii::app()->db->getCurrentTransaction() == null) {
            $transaction = Yii::app()->db->beginTransaction();
        }
        try {
            $params = $_POST;
            $errorMessage=[];
            $allStudents = filter_var($params['allStudents'], FILTER_VALIDATE_BOOLEAN);
            $students=isset($params['students'])?$params['students']:[];
            $courseId=isset($params['courseId'])?$params['courseId']:null;
            $moduleId=isset($params['moduleId'])?$params['moduleId']:null;

            if($allStudents){
                $students=OfflineStudents::groupStudents($params['group']);
            }
            if ($params['scheme']['educForm'] == 'online') $educationForm = EducationForm::ONLINE;
            else if ($params['scheme']['educForm'] == 'offline') $educationForm = EducationForm::OFFLINE;
            else $educationForm = EducationForm::ONLINE;

            foreach ($students as $studentId){
                $userAgreement=UserAgreements::agreementByParams(
                    ucfirst($params['serviceType']), $studentId, $moduleId, $courseId, $params['scheme']['schemeId'], $educationForm);
                if(!$userAgreement){
                    array_push($errorMessage,StudentReg::model()->findByPk($studentId)->fullName());
                }
                if($params['templateId'] && $userAgreement){
                    $userAgreement->sendAgreementRequestToUser([],$params['templateId']);
                }
            }

            if(!empty($errorMessage)){
                $result='Деяким студентам не вдалося згенерувати договір. Можливо дана схема проплат для них не є актуальною.
                Студенти: '.   implode(", ", $errorMessage);
            }else{
                $result='Договора згенеровано успішно';
            }

            if ($transaction) {
                $transaction->commit();
            }
        } catch (Exception $error) {
            if ($transaction) {
                $transaction->rollback();
            }
            $statusCode = 500;
            $result = ['message' => 'error', 'reason' => $error->getMessage()];
        }
        $this->renderPartial('//ajax/json', ['statusCode' => $statusCode, 'body' => json_encode($result)]);
    }

    public function actionRemoveWrittenAgreement()
    {
        $result = ['message' => 'OK'];
        $statusCode = 201;

        $transaction = null;
        if (Yii::app()->db->getCurrentTransaction() == null) {
            $transaction = Yii::app()->db->beginTransaction();
        }
        try {
            $params = array_filter($_POST);
            $agreement=UserWrittenAgreement::model()->findByPk($params['id']);
            $agreement->delete();

            $transaction->commit();
        } catch (Exception $error) {
            $transaction->rollback();
            $statusCode = 500;
            $result = ['message' => 'error', 'reason' => $error->getMessage()];
        }
        $this->renderPartial('//ajax/json', ['statusCode' => $statusCode, 'body' => json_encode($result)]);
    }

    public function actionRemove($userId, $serviceId)
    {
        $data['data']=UserAgreements::model()->findByAttributes(array('user_id'=>$userId,'service_id'=>$serviceId,'cancel_date'=>null));
        echo json_encode($data);
    }

    public function actionGetAgreementFile($id){
        $agreement=UserAgreements::model()->findByPk($id);
        $file = Yii::app()->basePath . "/../files/documents/agreements/".$agreement->user_id."/a".$id.".pdf";
        if (file_exists($file)){
            $result['data']=StaticFilesHelper::fullPathToFiles("documents/agreements").'/'.$agreement->user_id.'/a'.$id.'.pdf';
            echo json_encode($result);
        } else {
            throw new CHttpException(404,'Документ не знайдено');
        }
    }
}