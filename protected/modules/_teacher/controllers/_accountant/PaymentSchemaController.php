<?php

class PaymentSchemaController extends TeacherCabinetController
{
    public function hasRole() {
        $allowedTrainerActions = ['getSchemas'];
        $action = Yii::app()->controller->action->id;
        return Yii::app()->user->model->isAccountant() || Yii::app()->user->model->isAdmin() ||
        (Yii::app()->user->model->isTrainer() || Yii::app()->user->model->isAuditor() && in_array($action, $allowedTrainerActions));
    }

    public function actionGetSchemas() {
        echo json_encode(ActiveRecordToJSON::toAssocArray(SchemesName::model()->findAll()));
    }

    public function actionCreateSchema () {
        $result = ['message' => 'OK'];
        $statusCode = 201;
        try {
            $params = array_filter($_POST);
            $educationFrom = EducationForm::model()->findByPk($params['educationForm']);

            $service = null;
            $user = null;
            if (key_exists('courseId', $params)) {
                $service = CourseService::model()->getService($params['courseId'], $educationFrom);
            } else if (key_exists('moduleId', $params)) {
                $service = ModuleService::model()->getService($params['moduleId'], $educationFrom);
            }

            if (key_exists('userId', $params)) {
                $user = StudentReg::model()->findByPk($params['userId']);
            }

            $offer = null;
            $soFactory = new SpecialOfferFactory($user, $service);
            $offer = $soFactory->createSpecialOffer($params);
            if ($offer === null) {
                $offer = new PaymentScheme();
                $offer->setAttributes($params);
                $offer->save();

                if (count($offer->getErrors())) {
                    throw new Exception(json_encode($offer->getErrors()));
                }
            }
        } catch (Exception $error) {
            $statusCode = 500;
            $result = ['message' => 'error', 'reason' => $error->getMessage()];
        }
        $this->renderPartial('//ajax/json', ['statusCode' => $statusCode, 'body' => json_encode($result)]);
    }

    public function actionSchemasTemplates($organization)
    {
        $this->renderPartial('schemasTemplates',array('organization'=>$organization),false,true);
    }

    public function actionApplyTemplateView($request=null)
    {
        if($request){
            $model=MessagesServiceSchemesRequest::model()->findByPk($request);
            if(!$model->isApprovable())
                throw new Exception('Статус запиту не дозволяє його застосувати');
            if($model->service->courseServices){
                $contentModel=$model->service->courseServices->courseModel;
            }else{
                $contentModel=$model->service->moduleServices->moduleModel;
            }
            Yii::app()->user->model->hasAccessToOrganizationModel($contentModel);
        }

        $this->renderPartial('applyTemplateView',array('scenario'=>'create'),false,true);
    }

    public function actionAppliedTemplatesList($organization)
    {
        $this->renderPartial('appliedTemplatesList',array('organization'=>$organization),false,true);
    }
    
    public function actionViewSchemasTemplate($id)
    {
        $paymentSchema=PaymentSchemeTemplate::model()->findByPk($id);
        $canEdit=$paymentSchema->canEditPaymentSchema();
        $this->renderPartial('update', array('canEdit'=>$canEdit), false, true);
    }
    
    public function actionTemplateCreate($organization)
    {
        $this->renderPartial('create',array('scenario'=>'create','organization'=>$organization),false,true);
    }

    public function actionDisplayPromotionSchemes()
    {
        $this->renderPartial('displayPromotionSchemesView',array('scenario'=>'create'),false,true);
    }

    public function actionDisplayPromotionSchemesList($organization)
    {
        $this->renderPartial('displayPromotionSchemesList',array('organization'=>$organization),false,true);
    }

    public function actionSchemesRequests()
    {
        $this->renderPartial('schemesrequests',array(),false,true);
    }
    
    public function actionPromotionUpdate($id)
    {
        $promotion = PromotionPaymentScheme::model()->findByPk($id);
        Yii::app()->user->model->hasAccessToOrganizationModel($promotion);
        if(!$promotion)
            throw new \application\components\Exceptions\IntItaException('404', 'Данного акційної пропозиції не існує');
        $this->renderPartial('displayPromotionSchemesView',array('scenario'=>'update'),false,true);
    }

    public function actionAppliedTemplateUpdate($id)
    {
        $paymentScheme = PaymentScheme::model()->findByPk($id);
        Yii::app()->user->model->hasAccessToOrganizationModel($paymentScheme);
        if(!$paymentScheme)
            throw new \application\components\Exceptions\IntItaException('404', 'Данного сторінки не існує');
        $this->renderPartial('applyTemplateView',array('scenario'=>'update'),false,true);
    }

    public function actionCreateSchemeTemplate()
    {
        $template=json_decode(Yii::app()->request->getParam('template'));
        $templateModel= new PaymentSchemeTemplate();
        $templateModel->template_name_ua=$template->name_ua;
        $templateModel->template_name_ru=isset($template->name_ru)?$template->name_ru:null;
        $templateModel->template_name_en=isset($template->name_en)?$template->name_en:null;
        $templateModel->description_ua=isset($template->description_ua)?$template->description_ua:null;
        $templateModel->description_ru=isset($template->description_ru)?$template->description_ru:null;
        $templateModel->description_en=isset($template->description_en)?$template->description_en:null;
        $templateModel->id_organization=$template->id_organization;
        $transaction = Yii::app()->db->beginTransaction();

        try {
            if($templateModel->save()){
                foreach ($template->schemes as $scheme){
                    $model= new TemplateSchemes();
                    $model->id_template=$templateModel->id;
                    $model->pay_count=$scheme->pay_count;
                    $model->discount=$scheme->discount;
                    $model->loan=$scheme->loan;
                    $model->save();
                }
                if(!TemplateSchemes::model()->findByAttributes(array('id_template'=>$templateModel->id,'pay_count'=>1))){
                    throw new \application\components\Exceptions\IntItaException(500, "Шаблон повинен містити 'проплату наперід'");
                }

            }
            $transaction->commit();
            echo "Шаблон схем успішно створено";
        } catch (Exception $e) {
            $transaction->rollback();
            throw new \application\components\Exceptions\IntItaException(500, "Створити шаблон схем не вдалося");
        }
    }

    public function actionUpdateSchemeTemplate()
    {
        $template=json_decode(Yii::app()->request->getParam('template'));
        $templateModel= PaymentSchemeTemplate::model()->findByPk($template->id);
        if(!($templateModel->id_organization===null && Yii::app()->user->model->isAuditor()))
            Yii::app()->user->model->hasAccessToOrganizationModel($templateModel);
        $templateModel->template_name_ua=$template->name_ua;
        $templateModel->template_name_ru=isset($template->name_ru)?$template->name_ru:null;
        $templateModel->template_name_en=isset($template->name_en)?$template->name_en:null;
        $templateModel->description_ua=isset($template->description_ua)?$template->description_ua:null;
        $templateModel->description_ru=isset($template->description_ru)?$template->description_ru:null;
        $templateModel->description_en=isset($template->description_en)?$template->description_en:null;
        $templateModel->update();
        $transaction = Yii::app()->db->beginTransaction();

        try {
//            delete not actual scheme
            foreach ($templateModel->schemes as $modelScheme){
                $isInActualModel=false;
                foreach ($template->schemes as $key=>$scheme){
                    if(isset($scheme->id)) {
                        if ($modelScheme->id == $scheme->id) {
                            $isInActualModel = true;
                            break;
                        }
                    }
                }
                if(!$isInActualModel) {
                    $modelScheme->delete();
                }
            }
//            update old scheme
            foreach ($template->schemes as $scheme){
                if(isset($scheme->id)){
                    TemplateSchemes::model()->updateByPk($scheme->id,
                        array('pay_count'=>$scheme->pay_count,'discount'=>$scheme->discount,'loan'=>$scheme->loan));
                }else{
                    $newScheme=new TemplateSchemes();
                    $newScheme->id_template=$templateModel->id;
                    $newScheme->pay_count=$scheme->pay_count;
                    $newScheme->discount=$scheme->discount;
                    $newScheme->loan=$scheme->loan;
                    $newScheme->save();
                }
            }
            if(!TemplateSchemes::model()->findByAttributes(array('id_template'=>$templateModel->id,'pay_count'=>1))){
                throw new \application\components\Exceptions\IntItaException(500, "Шаблон повинен містити 'проплату наперід'");
            }
            $transaction->commit();
            echo "Шаблон схем успішно оновлено";
        } catch (Exception $e) {
            $transaction->rollback();
            throw new \application\components\Exceptions\IntItaException(500, "Оновити шаблон схем не вдалося");
        }
    }

    public function actionGetPaymentSchemasTemplatesNgTable()
    {
        $requestParams = $_GET;
        $ngTable = new NgTableAdapter('PaymentSchemeTemplate', $requestParams);
        if($_GET['organization']){
            $criteria = new CDbCriteria();
            $criteria->addCondition(
                't.id_organization='.Yii::app()->user->model->getCurrentOrganization()->id.' or t.id_organization is null');
            $ngTable->mergeCriteriaWith($criteria);
        }
        $result = $ngTable->getData();

        echo json_encode($result);
    }

    public function actionGetMainAppliedTemplatesNgTable()
    {
        $requestParams = $_GET;
        $ngTable = new NgTableAdapter('PaymentScheme', $requestParams);

        $criteria =  new CDbCriteria();
        $criteria->condition = 't.id ='.PaymentScheme::DEFAULT_COURSE_SCHEME.' OR t.id ='.PaymentScheme::DEFAULT_MODULE_SCHEME;
        $ngTable->mergeCriteriaWith($criteria);

        $result = $ngTable->getData();

        echo json_encode($result);
    }

    public function actionGetServicesAppliedTemplatesNgTable()
    {
        $requestParams = $_GET;
        $ngTable = new NgTableAdapter('PaymentScheme', $requestParams);

        $criteria =  new CDbCriteria();
        $criteria->condition = '(t.serviceId IS NOT NULL or t.serviceType IS NOT NULL) and t.userId IS NULL';
        if($_GET['organization']){
            $criteria->addCondition('t.id_organization='.Yii::app()->user->model->getCurrentOrganization()->id);
        }
        $ngTable->mergeCriteriaWith($criteria);

        $result = $ngTable->getData();

        echo json_encode($result);
    }

    public function actionGetPromotionAppliedTemplatesNgTable()
    {
        $requestParams = $_GET;
        $ngTable = new NgTableAdapter('PromotionPaymentScheme', $requestParams);
        if($_GET['organization']){
            $criteria =  new CDbCriteria();
            $criteria->addCondition('t.id_organization='.Yii::app()->user->model->getCurrentOrganization()->id);
            $ngTable->mergeCriteriaWith($criteria);
        }
        $result = $ngTable->getData();

        echo json_encode($result);
    }
    
    public function actionGetUsersAppliedTemplatesNgTable()
    {
        $requestParams = $_GET;
        $ngTable = new NgTableAdapter('PaymentScheme', $requestParams);

        $criteria =  new CDbCriteria();
        $criteria->condition = 't.userId IS NOT NULL';
        if($_GET['organization']){
            $criteria->addCondition('t.id_organization='.Yii::app()->user->model->getCurrentOrganization()->id);
        }
        $ngTable->mergeCriteriaWith($criteria);

        $result = $ngTable->getData();

        echo json_encode($result);
    }

    public function actionGetSchemesRequestsNgTable()
    {
        $requestParams = $_GET;
        $criteria =  new CDbCriteria();
        $criteria->join = 'left join acc_service s on s.service_id=t.id_service';
        $criteria->join .= ' left join acc_module_service ms on ms.service_id=s.service_id';
        $criteria->join .= ' left join module m on m.module_ID=ms.module_id';
        $criteria->join .= ' left join acc_course_service cs on cs.service_id=s.service_id';
        $criteria->join .= ' left join course c on c.course_ID=cs.course_id';
        if(isset($requestParams['filter']['status']) && $requestParams['filter']['status']=='4'){
            $criteria->condition = 't.status='.MessagesServiceSchemesRequest::NEW_REQUEST.' or t.status='.MessagesServiceSchemesRequest::IN_PROCESS;
            unset($requestParams['filter']);
        }
        $criteria->addCondition('c.id_organization='.Yii::app()->user->model->getCurrentOrganization()->id.' 
        or m.id_organization='.Yii::app()->user->model->getCurrentOrganization()->id);
        $ngTable = new NgTableAdapter('MessagesServiceSchemesRequest', $requestParams);
        $ngTable->mergeCriteriaWith($criteria);
        $result = $ngTable->getData();
        echo json_encode($result);
    }

    public function actionGetSchemesTemplate()
    {
        $schemesTemplate=PaymentSchemeTemplate::model()->with(PaymentSchemeTemplate::model()->relations())->findByPk(Yii::app()->request->getParam('templateId'));
        $result=ActiveRecordToJSON::toAssocArray($schemesTemplate);
        foreach ($result['schemes'] as $key=>$scheme){
            $result['schemes'][$key]['name']=$schemesTemplate->schemes[$key]->schemeName->title_ua;
        }
        echo json_encode($result);
    }

    public function actionCancelPaymentScheme()
    {
        $id=Yii::app()->request->getParam('id');
        $paymentScheme=PaymentScheme::model()->findByPk($id);

        Yii::app()->user->model->hasAccessToOrganizationModel($paymentScheme);

        $params=array(
            'id_template'=>$paymentScheme->id_template,
            'userId'=>$paymentScheme->userId,
            'serviceId'=>$paymentScheme->serviceId,
            'serviceType'=>$paymentScheme->serviceId,
            'id_organization'=>$paymentScheme->id_organization
        );

        $transaction = Yii::app()->db->beginTransaction();
        try {
            if($paymentScheme->serviceId){
                if($paymentScheme->service->courseServices){
                    $educationForm=$paymentScheme->service->courseServices->education_form!=EducationForm::ONLINE?
                        EducationForm::ONLINE:EducationForm::OFFLINE;
                    $service = CourseService::model()->findByAttributes(array(
                        'course_id' => $paymentScheme->service->courseServices->course_id,
                        'education_form' => $educationForm
                    ));
                    if($service){
                        $params['serviceId']=$service->service_id;
                        $secondPaymentScheme=PaymentScheme::model()->findByAttributes($params);
                        if($secondPaymentScheme) $secondPaymentScheme->delete();
                    }
                }else if($paymentScheme->service->moduleServices){
                    $educationForm=$paymentScheme->service->moduleServices->education_form!=EducationForm::ONLINE?
                        EducationForm::ONLINE:EducationForm::OFFLINE;
                    $service = ModuleService::model()->findByAttributes(array(
                        'module_id' => $paymentScheme->service->moduleServices->module_id,
                        'education_form' => $educationForm
                    ));
                    if($service){
                        $params['serviceId']=$service->service_id;
                        $secondPaymentScheme=PaymentScheme::model()->findByAttributes($params);
                        if($secondPaymentScheme) $secondPaymentScheme->delete();
                    }
                }
            }

            $paymentScheme->delete();

            if($paymentScheme->userId){
                $this->cancelSchemaTemplateNotify($paymentScheme);
            }
            
            $transaction->commit();
            echo "Успішно видалено";
        } catch (Exception $e) {
            $transaction->rollback();
            throw new \application\components\Exceptions\IntItaException(500, "Видалити не вдалося");
        }
    }

    public function actionCancelPromotionPaymentScheme()
    {
        $id=Yii::app()->request->getParam('id');
        $promotionPaymentScheme=PromotionPaymentScheme::model()->findByPk($id);
        Yii::app()->user->model->hasAccessToOrganizationModel($promotionPaymentScheme);
        $promotionPaymentScheme->delete();
    }

    public function actionGetSchemesTemplatesList($organization=0)
    {
        $criteria = new CDbCriteria();
        if($organization){
            $criteria->addCondition('id_organization='.Yii::app()->user->model->getCurrentOrganization()->id.' or id_organization is NULL');
        }
        $schemesTemplates=PaymentSchemeTemplate::model()->findAll($criteria);
        $result=ActiveRecordToJSON::toAssocArray($schemesTemplates);

        echo json_encode($result);
    }

    public function actionRejectSchemaRequest()
    {
        $comment=$_POST['reject_comment']?$_POST['reject_comment']:null;
        $model=MessagesServiceSchemesRequest::model()->findByPk($_POST['id_message']);
        if($model->service->courseServices){
            $contentModel=$model->service->courseServices->courseModel;
        }else{
            $contentModel=$model->service->moduleServices->moduleModel;
        }
        Yii::app()->user->model->hasAccessToOrganizationModel($contentModel);
        $model->setCancelled($comment);
    }

    public function actionSetRequestStatus()
    {
        $idMessage=Yii::app()->request->getParam('idMessage');
        $status=Yii::app()->request->getParam('status');
        $model=MessagesServiceSchemesRequest::model()->findByPk($idMessage);
        if($model->service->courseServices){
            $contentModel=$model->service->courseServices->courseModel;
        }else{
            $contentModel=$model->service->moduleServices->moduleModel;
        }
        Yii::app()->user->model->hasAccessToOrganizationModel($contentModel);
        $model->setStatus($status);
    }
    
    public function actionSetRequestComment()
    {
        $model=MessagesServiceSchemesRequest::model()->findByPk($_POST['id_message']);
        if($model->service->courseServices){
            $contentModel=$model->service->courseServices->courseModel;
        }else{
            $contentModel=$model->service->moduleServices->moduleModel;
        }
        Yii::app()->user->model->hasAccessToOrganizationModel($contentModel);
        $model->setComment($_POST['comment']);
    }
    
    public function actionGetSchemesRequest()
    {
        $params = array_filter($_POST);
        echo CJSON::encode(MessagesServiceSchemesRequest::model()->findByPk($params['id_message']));
    }
    
    public function actionApplySchemesTemplate () {
        $result = ['message' => 'OK'];
        $statusCode = 201;
        try {
            $params = array_filter($_POST);
            $params['id_template'] =$params['template']['id'];
            $params['id_user_approved']=Yii::app()->user->getId();
            $params['id_organization']=Yii::app()->user->model->getCurrentOrganization()->id;
            unset($params['id']);

            $template=PaymentSchemeTemplate::model()->findByPk($params['id_template']);
            $template->id_organization===null || Yii::app()->user->model->hasAccessToOrganizationModel($template);

            $services = array();
            $educationForms = EducationForm::model()->findAllByPk(array(EducationForm::ONLINE,EducationForm::OFFLINE));

            $user = null;
            if (key_exists('courseId', $params)) {
                Yii::app()->user->model->hasAccessToOrganizationModel(Course::model()->findByPk($params['courseId']));

                foreach ($educationForms as $key=>$form){
                    array_push($services,CourseService::model()->getService($params['courseId'], $form));
                }
            } else if (key_exists('moduleId', $params)) {
                Yii::app()->user->model->hasAccessToOrganizationModel(Module::model()->findByPk($params['moduleId']));

                foreach ($educationForms as $form) {
                    array_push($services, ModuleService::model()->getService($params['moduleId'], $form));
                }
            }

            if (key_exists('userId', $params)) {
                $user = StudentReg::model()->findByPk($params['userId']);
            }

            $offer = null;
            if(empty($services)) $services=array(null);

            foreach ($services as $service) {
                $soFactory = new SpecialOfferFactory($user, $service);
                $offer = $soFactory->createSpecialOffer($params);
                if ($offer === null) {
                    $offer = new PaymentScheme();
                    $offer->setAttributes($params);
                    if($offer->checkDateConflict()){
                        $offer->save();
                    }else{
                        throw new Exception('Застосувати схему не вдалося, оскільки дата її дії 
                        пересікається з іншою схемою застосованою раніше за такими ж параметрами');
                    }

                    if (count($offer->getErrors())) {
                        throw new Exception(json_encode($offer->getErrors()));
                    }
                }
            }

            if(isset($params['request']) && $user){
                if(MessagesServiceSchemesRequest::model()->findByPk($params['request'])->approve()){
                    $this->approvedNotify($offer);
                };
            }else if($user){
                $this->approvedNotify($offer);
            }
        } catch (Exception $error) {
            $statusCode = 500;
            $result = ['message' => 'error', 'reason' => $error->getMessage()];
        }
        $this->renderPartial('//ajax/json', ['statusCode' => $statusCode, 'body' => json_encode($result)]);
    }

    public function actionApplyPromotionSchemesForService () {
        $result = ['message' => 'OK'];
        $statusCode = 201;
        try {
            $params = array_filter($_POST);
            $params['id_template'] = $params['template']['id'];
            $params['id_user_approved']=Yii::app()->user->getId();
            $params['id_organization']=Yii::app()->user->model->getCurrentOrganization()->id;
            unset($params['template']);

            $template=PaymentSchemeTemplate::model()->findByPk($params['id_template']);
            $template->id_organization===null || Yii::app()->user->model->hasAccessToOrganizationModel($template);

            if(isset($params['courseId']) && isset($params['moduleId']))
                unset($params['moduleId']);
            if((isset($params['courseId']) || isset($params['moduleId'])) && isset($params['serviceType']))
                unset($params['serviceType']);

            //check for access to organization services
            if(isset($params['courseId'])){
                Yii::app()->user->model->hasAccessToOrganizationModel(Course::model()->findByPk($params['courseId']));
            }
            if(isset($params['moduleId'])){
                Yii::app()->user->model->hasAccessToOrganizationModel(Module::model()->findByPk($params['moduleId']));
            }

            $promotion = new PromotionPaymentScheme();
            $promotion->setAttributes($params);
            $promotion->save();

            if (count($promotion->getErrors())) {
                throw new Exception(json_encode($promotion->getErrors()));
            }

        } catch (Exception $error) {
            $statusCode = 500;
            $result = ['message' => 'error', 'reason' => $error->getMessage()];
        }
        $this->renderPartial('//ajax/json', ['statusCode' => $statusCode, 'body' => json_encode($result)]);
    }

    public function actionUpdatePromotionSchemesForService () {
        function valueNull($value) {
            return !$value?null:$value;
        }

        $result = ['message' => 'OK'];
        $statusCode = 201;
        try {
            $params = array_map("valueNull", $_POST);
            $params['id_template'] = $params['template']['id'];
            unset($params['template']);

            $template=PromotionPaymentScheme::model()->findByPk($params['id']);
            Yii::app()->user->model->hasAccessToOrganizationModel($template);

            if(isset($params['courseId']) && isset($params['moduleId']))
                $params['moduleId']=null;
            if((isset($params['courseId']) || isset($params['moduleId'])) && isset($params['serviceType']))
                $params['serviceType']=null;

            //check for access to organization services
            if(isset($params['courseId'])){
                Yii::app()->user->model->hasAccessToOrganizationModel(Course::model()->findByPk($params['courseId']));
            }
            if(isset($params['moduleId'])){
                Yii::app()->user->model->hasAccessToOrganizationModel(Module::model()->findByPk($params['moduleId']));
            }

            $promotion = PromotionPaymentScheme::model()->findByPk($params['id']);
            $promotion->setAttributes($params);
            $promotion->save();

            if (count($promotion->getErrors())) {
                throw new Exception(json_encode($promotion->getErrors()));
            }

        } catch (Exception $error) {
            $statusCode = 500;
            $result = ['message' => 'error', 'reason' => $error->getMessage()];
        }
        $this->renderPartial('//ajax/json', ['statusCode' => $statusCode, 'body' => json_encode($result)]);
    }

//todo update for two forms services
//    public function actionUpdateAppliedTemplate () {
//        function valueNull($value) {
//            return !$value?null:$value;
//        }
//
//        $result = ['message' => 'OK'];
//        $statusCode = 201;
//        try {
//            $params = array_map("valueNull", $_POST);
//            $params['id_template'] =$params['template']['id'];
//            $params['id_user_approved']=Yii::app()->user->getId();
//
//            $paymentScheme=PaymentScheme::model()->findByPk($params['id']);
//            Yii::app()->user->model->hasAccessToOrganizationModel($paymentScheme);
//
//            $services = array();
//            $educationForms = EducationForm::model()->findAllByPk(array(EducationForm::ONLINE,EducationForm::OFFLINE));
//
//            $user = null;
//
//            if (key_exists('courseId', $params) && $params['courseId']) {
//                Yii::app()->user->model->hasAccessToOrganizationModel(Course::model()->findByPk($params['courseId']));
//
//                foreach ($educationForms as $key=>$form){
//                    array_push($services,CourseService::model()->getService($params['courseId'], $form));
//                }
//            } else if (key_exists('moduleId', $params) && $params['moduleId']) {
//                Yii::app()->user->model->hasAccessToOrganizationModel(Module::model()->findByPk($params['moduleId']));
//
//                foreach ($educationForms as $form) {
//                    array_push($services, ModuleService::model()->getService($params['moduleId'], $form));
//                }
//            }
//
//            if (key_exists('userId', $params)) {
//                $user = StudentReg::model()->findByPk($params['userId']);
//            }
////todo update for two forms services
//            foreach ($services as $service) {
//                $offer = PaymentScheme::model()->findByPk($params['id']);
//                $offer->setAttributes($params);
//
//                if($offer->checkDateConflict($offer)){
//                    $offer->save();
//                }else{
//                    throw new Exception('Оновити схему не вдалося, оскільки дата її дії
//                    пересікається з іншою схемою застосованою раніше за такими ж параметрами');
//                }
//
//                if (count($offer->getErrors())) {
//                    throw new Exception(json_encode($offer->getErrors()));
//                }
//            }
//
//            if(isset($params['request']) && $user){
//                if(MessagesServiceSchemesRequest::model()->findByPk($params['request'])->approve()){
//                    $this->approvedNotify($offer);
//                };
//            }else if($user){
//                $this->approvedNotify($offer);
//            }
//        } catch (Exception $error) {
//            $statusCode = 500;
//            $result = ['message' => 'error', 'reason' => $error->getMessage()];
//        }
//        $this->renderPartial('//ajax/json', ['statusCode' => $statusCode, 'body' => json_encode($result)]);
//    }

    public function actionGetPromotionSchemeData() {
        $id=Yii::app()->request->getParam('id');
        $model = PromotionPaymentScheme::model()->findByPk($id);
        echo CJSON::encode($model);
    }

    public function actionGetPaymentSchemeData() {
        $id=Yii::app()->request->getParam('id');
        $model = PaymentScheme::model()->findByPk($id);
        echo CJSON::encode($model);
    }

    public function actionGetServiceContent()
    {
        $data=array();
        $id=Yii::app()->request->getParam('serviceId');
        $service=Service::model()->findByPk($id);
        $data['courseId']=$service->courseServices?$service->courseServices->course_id:null;
        $data['moduleId']=$service->moduleServices?$service->moduleServices->module_id:null;
        echo json_encode($data);
    }

    public function actionGetActualSchemesRequestsCount()
    {
        $modulesRequestsCount=count(MessagesServiceSchemesRequest::model()->with('service.moduleServices.moduleModel')->findAll(
            'moduleModel.id_organization='.Yii::app()->user->model->getCurrentOrganization()->id.' 
            and t.status='.MessagesServiceSchemesRequest::NEW_REQUEST));
        $coursesRequestsCount=count(MessagesServiceSchemesRequest::model()->with('service.courseServices.courseModel')->findAll(
            'courseModel.id_organization='.Yii::app()->user->model->getCurrentOrganization()->id.' 
            and t.status='.MessagesServiceSchemesRequest::NEW_REQUEST));

         echo $modulesRequestsCount+$coursesRequestsCount;
    }

    public static function approvedNotify($offer)
    {
        $serviceType=null;
        $content=null;
        $user = RegisteredUser::userById($offer->userId);
        $service=Service::model()->findByPk($offer->serviceId);
        if($offer->serviceType){
            $serviceType=$offer->serviceType==Service::COURSE?'КУРСИ':'МОДУЛІ';
        }else if($service){
            if($service->courseServices)
                $content=$service->courseServices->courseModel->title_ua.' ('.$service->courseServices->courseModel->language.')';
            if($service->moduleServices)
                $content=$service->moduleServices->moduleModel->title_ua.' ('.$service->moduleServices->moduleModel->language.')';
        }
        $schemesTemplate=PaymentSchemeTemplate::model()->findByPk($offer->id_template);

        self::notify($user->registrationData, 'Призначено схему проплат',
            'accountant'. DIRECTORY_SEPARATOR . '_approveSchemesTemplateRequest',
            array($serviceType, $service, $content, $schemesTemplate, $offer->startDate, $offer->endDate));
        return "Операцію успішно виконано.";
    }

    public static function cancelSchemaTemplateNotify($paymentScheme)
    {
        $serviceType=null;
        $content=null;
        $user = RegisteredUser::userById($paymentScheme->userId);
        $service=Service::model()->findByPk($paymentScheme->serviceId);
        if($paymentScheme->serviceType){
            $serviceType=$paymentScheme->serviceType==Service::COURSE?'КУРСИ':'МОДУЛІ';
        }else if($service){
            if($service->courseServices)
                $content=$service->courseServices->courseModel->title_ua.' ('.$service->courseServices->courseModel->language.')';
            if($service->moduleServices)
                $content=$service->moduleServices->moduleModel->title_ua.' ('.$service->moduleServices->moduleModel->language.')';
        }
        $schemesTemplate=PaymentSchemeTemplate::model()->findByPk($paymentScheme->id_template);
        self::notify($user->registrationData, 'Скасовано схему проплат',
            'accountant'. DIRECTORY_SEPARATOR . '_cancelSchemesTemplate',
            array($serviceType, $service, $content, $schemesTemplate));
        return "Операцію успішно виконано.";
    }
    
    public function notify(StudentReg $user, $subject, $template, $params)
    {
        $connection = Yii::app()->db;
        $transaction = null;
        if ($connection->getCurrentTransaction() == null) {
            $transaction = $connection->beginTransaction();
        }

        try {
            $message = new MessagesNotifications();
            $sender = new MailTransport();
            $sender->renderBodyTemplate($template, $params);
            $message->build($subject, $sender->template(), array($user), StudentReg::model()->findByPk(Yii::app()->user->getId()));
            $message->create();

            $message->send($sender);
            if ($transaction != null) {
                $transaction->commit();
            }
        } catch (Exception $e) {
            if ($transaction != null) {
                $transaction->rollback();
            }
            throw new \application\components\Exceptions\IntItaException(500, "Повідомлення не вдалося надіслати.");
        }
    }
}