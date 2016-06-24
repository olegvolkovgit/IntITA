<?php

class ModuleRevisionController extends Controller {
    public $layout = 'revisionlayout';

    public function init()
    {
        parent::init();
        $app = Yii::app();
        $app->language = isset($app->session['lg'])?$app->session['lg']:'ua';

        if (Yii::app()->user->isGuest) {
            $this->render('/site/authorize');
            die();
        } else return true;
    }

    public function actionIndex() {
        if (!Yii::app()->user->model->canApprove()) {
            throw new RevisionControllerException(403, 'Доступ заборонено. У тебе недостатньо прав для перегляду ревізій модулів');
        }

        $this->render('index',array(
            'isApprover' => true,
            'userId' => Yii::app()->user->getId(),
        ));
    }

    public function actionCourseModulesRevisions($idCourse) {
        if (!Yii::app()->user->model->canApprove()) {
            throw new RevisionControllerException(403, 'Доступ заборонено. У тебе недостатньо прав для перегляду ревізій модулів курса');
        }

        $this->render('courseModulesRevisions', array(
            'idCourse' => $idCourse,
            'isApprover' => Yii::app()->user->model->canApprove(),
            'userId' => Yii::app()->user->getId(),
        ));
    }
    
    // page of module revisions tree 
    public function actionModuleRevisions($idModule, $idCourse=0) {
        $module= Module::model()->findByPk($idModule);
        if (!RevisionModule::canCreateModuleRevisions($idModule)) {
            throw new RevisionControllerException(403, 'Доступ заборонено. У тебе недостатньо прав для перегляду ревізій модулів');
        }

        $this->render('moduleRevisions', array(
            'idCourse' => $idCourse,
            'module' => $module,
            'isApprover' => Yii::app()->user->model->canApprove(),
            'userId' => Yii::app()->user->getId(),
        ));
    }

    public function actionEditModuleRevision() {
        $moduleLectures = json_decode(Yii::app()->request->getPost('moduleLectures'),true);
        $idModule = Yii::app()->request->getPost('id_module_revision');
        $moduleRevision = RevisionModule::model()->findByAttributes(['id_module_revision' => $idModule]);
        if ($moduleRevision->properties->id_user_created!=Yii::app()->user->getId()) {
            throw new RevisionControllerException(403, 'Доступ заборонено. У тебе недостатньо прав для редагування ревізії модуля');
        }
        $moduleRevision->editLecturesList($moduleLectures, Yii::app()->user);
    }

    /**
     * @param $idModule
     * @throws Exception
     * @throws RevisionControllerException
     */

    public function actionEditModule($idModule) {
        $moduleRevisions = RevisionModule::model()->findAllByAttributes(array("id_module" => $idModule));
        $module = Module::model()->findByPk($idModule);
        if (!$module) {
            throw new RevisionControllerException(404, Yii::t('breadcrumbs', '0782'));
        }

        if (!RevisionModule::canCreateModuleRevisions($idModule)) {
            throw new RevisionControllerException(403, 'Доступ заборонено. У тебе недостатньо прав для створення або перегляду ревізій модуля');
        }
        $moduleRev = null;
        /*if there is no revisions we create new revision from module in DB, else we should find */
        if (empty($moduleRevisions)) {
            $moduleRev = RevisionModule::createNewRevisionFromModule($module, Yii::app()->user)->cloneModule(Yii::app()->user);
        } else {
            /*find all editable revisions */
            $editableRevisions = [];
            $lastApproved = null;
            foreach ($moduleRevisions as $moduleRevision) {
                if ($moduleRevision->isEditable()) {
                    array_push($editableRevisions, $moduleRevision);
                }
                if ($moduleRevision->isApproved()) {
                    $lastApproved = $moduleRevision;
                }
            }
            /*
             * If we haven't found any editable revision or found one revision other user we should create new revision from last approved
             * If we have found only one revision of this user just show it
             * If we have found several editable revisions show revisions tree;
             */
            if (count($editableRevisions) == 0 || (count($editableRevisions) == 1 && !$editableRevisions[0]->canEdit())) {
                $moduleRev = $lastApproved->cloneModule(Yii::app()->user);
            } else if(count($editableRevisions) == 1 && $editableRevisions[0]->canEdit()) {
                $moduleRev = $editableRevisions[0];
            } else {
                $this->render('moduleRevisions', array(
                    'module' => $module,
                    'isApprover' => Yii::app()->user->model->canApprove(),
                    'userId' => Yii::app()->user->getId(),
                ));
                return;
            }
        }

        $this->render("moduleView", array(
            "moduleRevision" => $moduleRev,
        ));

    }

    public function actionBuildCurrentModuleJson() {
        $idCourse = Yii::app()->request->getPost('idCourse');
        Course::model()->findAllByPk($idCourse);
        $currentIdModules=Course::model()->modulesInCourse($idCourse);
        $data = [];
        foreach ($currentIdModules as $key=>$moduleId) {
            $module=Module::model()->findByPk($moduleId['id_module']);
            $data[$key]['title'] = $module->title_ua;
            $data[$key]['id'] = $module->module_ID;
            $data[$key]['revisionsLink'] = Yii::app()->createUrl('/moduleRevision/editModule',array('idModule'=>$module->module_ID));
            $data[$key]['modulePreviewLink'] = Yii::app()->createUrl("module/index", array("idModule" => $module->module_ID, "idCourse" => $idCourse));
//            $moduleRev = RevisionModule::getParentRevisionForModule($module->module_ID);
            $data[$key]['releasedFromRevision'] = $module->id_module_revision;
        }
        echo CJSON::encode($data);
    }

    public function actionBuildRevisionsInCourse() {
        $idCourse = Yii::app()->request->getPost('idCourse');
        $list=Course::model()->modulesIdInCourse($idCourse);
        $moduleRev  = RevisionModule::modelsByList($list);
        $relatedTree = RevisionModule::getModulesTree();
        $json = $this->buildModuleTreeJson($moduleRev, $relatedTree);

        echo $json;
    }

    public function actionBuildAllModulesRevisions() {
        $moduleRev = RevisionModule::model()->findAll();
        $relatedTree = RevisionModule::getModulesTree();
        $json = $this->buildModuleTreeJson($moduleRev, $relatedTree);

        echo $json;
    }

    public function actionBuildModuleRevisions() {
        $idModule = Yii::app()->request->getPost('idModule');
        $moduleRev = RevisionModule::model()->findAllByAttributes(array("id_module" => $idModule));
        $relatedTree = RevisionModule::getModulesTree($idModule);
        $json = $this->buildModuleTreeJson($moduleRev, $relatedTree);

        echo $json;
    }

    private function buildModuleTreeJson($modules, $moduleTree) {
        $jsonArray = [];
        foreach ($modules as $module) {
            $node = array();
            $node['text'] = "Ревізія №" . $module->id_module_revision . " " .
                $module->properties->title_ua . ". Статус: <strong>" . $module->getStatus().'</strong>'.
                ' Створена: '.$module->properties->start_date.' Модифікована: '.$module->properties->update_date;
            $node['selectable'] = false;
            $node['id'] = $module->id_module_revision;
            $node['creatorId'] = $module->properties->id_user_created;
            $node['isSendable'] = $module->isSendable();
            $node['isApprovable'] = $module->isApprovable();
            $node['isCancellable'] = $module->isCancellable();
            $node['isEditable'] = $module->isEditable();
            $node['isRejectable'] = $module->isRejectable();
            $node['isSendedCancellable'] = $module->isRevokeable();
            $node['isReadable'] = $module->isReleaseable();
            $node['isEditCancellable'] = $module->isEditable();
            $node['canRestoreEdit'] = $module->isCancelledEditor();

            $this->appendNode($jsonArray, $node, $moduleTree);
        }
        return json_encode(array_values($jsonArray));
    }

    public function buildModuleTreeJsonMultiselect($modules, $moduleTree, $actualIdList) {
        $jsonArray = [];
        foreach ($modules as $module) {
            $node = array();
            $node['text'] = "Ревізія №" . $module->id_module_revision . " " .
                $module->properties->title_ua . ". Статус: <strong>" . $module->getStatus().'</strong>'.
                ' Створена: '.$module->properties->start_date.' Модифікована: '.$module->properties->update_date;
            $node['selectable'] = false;
            $node['id'] = $module->id_module_revision;
            $node['creatorId'] = $module->properties->id_user_created;
            $node['isSendable'] = $module->isSendable();
            $node['isApprovable'] = $module->isApprovable();
            $node['isCancellable'] = $module->isCancellable();
            $node['isEditable'] = $module->isEditable();
            $node['isRejectable'] = $module->isRejectable();
            $node['isSendedCancellable'] = $module->isRevokeable();
            $node['isReadable'] = $module->isReleaseable();
            $node['isEditCancellable'] = $module->isEditable();
            $node['canRestoreEdit'] = $module->isCancelledEditor();

            $this->appendNodeMultiselect($jsonArray, $node, $moduleTree, $actualIdList);
        }
        return json_encode(array_values($jsonArray));
    }

    private function appendNodeMultiselect(&$tree, $node, $parents, $actualRevisionsList) {
//       do if node is in array list
        if (in_array($node['id'], $actualRevisionsList)) {
//       change parent node if current parent node absent in array list
            if(!in_array($parents[$node['id']], $actualRevisionsList)){
                $tempParent=$parents[$node['id']];
                while (!in_array($tempParent, $actualRevisionsList)) {
                    $oldParent=$tempParent;
                    $tempParent=$parents[$tempParent];
                    if($oldParent==$tempParent){
                        $tempParent=$node['id'];
                        break;
                    }
                }
                $parents[$node['id']]=$tempParent;
            }
            if ($parents[$node['id']] == $node['id']) {
                //if root node
                $tree[$node['id']] = $node;
            } else{
                $path = [];

                if (in_array($parents[$node['id']], $actualRevisionsList)) {
                    $parentId = $parents[$node['id']];
                } else {
                    $parentId = $node['id'];
                }
                //building path from root to target node
                array_push($path, $parentId);
                $i=0;

                while ($parents[$parentId] != $parentId) {
                    $i=$i+1;

                    if (!in_array($parents[$parentId], $actualRevisionsList)) {
                        // find parent
                        $tempParent=$parents[$parentId];
                        $end=false;

                        while (!in_array($tempParent, $actualRevisionsList)) {
                            $oldParent=$tempParent;
                            $tempParent=$parents[$tempParent];
                            if($oldParent==$tempParent){
                                if(!in_array($tempParent, $actualRevisionsList)){
                                    $end=true;
                                    break;
                                }else{
                                    $parentId=$tempParent;
                                    break;
                                }
                            }
                        }
                        if($end) break;

                        array_push($path, $tempParent);
                        $parentId=$tempParent;
                    }
                    if($parents[$parentId] != $parentId){
                        array_push($path, $parents[$parentId]);
                        $parentId = $parents[$parentId];
                    }
                }

                //finding reference to target node
                $targetNode = &$tree;
                while (count($path) != 0) {
                    if (!array_key_exists('nodes', $targetNode)) {
                        $targetNode =& $targetNode[array_pop($path)];
                    } else {
                        $targetNode =& $targetNode['nodes'][array_pop($path)];
                    }
                }
                //adding node to 'nodes' array in target node

                if (!array_key_exists('nodes', $targetNode)) {
                    $targetNode['nodes'] = array();
                }
                $targetNode['nodes'][$node['id']] = $node;
            }
        }
    }

    /**
     * Function to build tree of lectures based on quickUnion data structure
     * @param $tree - tree to build, passed by reference
     * @param $node - node to add
     * @param $parents - quik union structre
     */
    private function appendNode(&$tree, $node, $parents) {
        if ($parents[$node['id']] == $node['id']) {
            //if root node
            $tree[$node['id']] = $node;
        } else {
            $path = [];
            $parentId = $parents[$node['id']];

            //building path from root to target node
            array_push($path, $parentId);
            while ($parents[$parentId] != $parentId) {
                array_push($path, $parents[$parentId]);
                $parentId = $parents[$parentId];
            }

            //finding reference to target node
            $targetNode = &$tree;
            while (count($path) != 0) {
                if (!array_key_exists('nodes', $targetNode)) {
                    $targetNode =& $targetNode[array_pop($path)];
                } else {
                    $targetNode =& $targetNode['nodes'][array_pop($path)];
                }
            }

            //adding node to 'nodes' array in target node
            if (!array_key_exists('nodes', $targetNode)) {
                $targetNode['nodes'] = array();
            }
            $targetNode['nodes'][$node['id']] = $node;
        }
    }

    public function actionCreateRevisionFromModule() {
        $idModule = trim(Yii::app()->request->getPost("idModule"));
        $module=Module::model()->findByPk($idModule);

        if(RevisionModule::model()->find('id_module=:id', array(':id'=>$idModule))){
            echo false;
            return;
        }

        if (!RevisionModule::canCreateModuleRevisions($idModule)) {
            throw new RevisionControllerException(403, Yii::t('error', '0590'));
        }

        $revModule =  RevisionModule::createNewRevisionFromModule($module, Yii::app()->user)->cloneModule(Yii::app()->user);
        
        echo $revModule->id_module_revision;
    }

    public function actionCreateModuleRevision($idRevision) {
        $moduleRevision = RevisionModule::model()->findByPk($idRevision);
        if (!RevisionModule::canCreateModuleRevisions($moduleRevision->id_module)) {
            throw new RevisionControllerException(403, Yii::t('revision', '0825'));
        }
        $moduleRevision = $moduleRevision->cloneModule(Yii::app()->user);
        if($moduleRevision){
            $this->redirect(Yii::app()->createUrl('/moduleRevision/editModuleRevisionPage',array('idRevision'=>$moduleRevision->id_module_revision)));
        }else{
            throw new RevisionControllerException(500, 'CreateModuleRevision error');
        }
    }

    public function actionCancelEditModuleRevisionByEditor () {
        $idRevision = Yii::app()->request->getPost('idRevision');
        $moduleRev = RevisionModule::model()->findByPk($idRevision);
        if (!$moduleRev->canCancelEdit()) {
            throw new RevisionControllerException(403, Yii::t('revision', '0590'));
        }
        $moduleRev->cancelEditRevisionByEditor(Yii::app()->user);
    }

    public function actionRestoreEditModuleRevisionByEditor () {
        $idRevision = Yii::app()->request->getPost('idRevision');
        $moduleRev = RevisionModule::model()->findByPk($idRevision);
        if (!$moduleRev->canRestoreEdit()) {
            throw new RevisionControllerException(403, Yii::t('revision', '0590'));
        }
        $moduleRev->restoreEditRevisionByEditor();
    }

    public function actionSendForApproveModule() {
        $idRevision = Yii::app()->request->getPost('idRevision');
        $moduleRev = RevisionModule::model()->findByPk($idRevision);
        if (!$moduleRev->canSendForApproval()) {
            throw new RevisionControllerException(403, Yii::t('error', '0590'));
        }
        $result = $moduleRev->checkConflicts();

        if (empty($result)) {
            $moduleRev->sendForApproval(Yii::app()->user);
        } else {
            echo $result;
        }
    }

    public function actionCancelSendForApproveModule() {
        $idRevision = Yii::app()->request->getPost('idRevision');
        $moduleRev = RevisionModule::model()->findByPk($idRevision);
        if (!$moduleRev->canCancelSendForApproval()) {
            throw new RevisionControllerException(403, Yii::t('revision', '0590'));
        }
        $moduleRev->revoke();
    }

    public function actionRejectModuleRevision() {
        $idRevision = Yii::app()->request->getPost('idRevision');
        $moduleRev = RevisionModule::model()->findByPk($idRevision);
        if (!$moduleRev->canRejectRevision()) {
            throw new RevisionControllerException(403, Yii::t('revision', '0827'));
        }
        $moduleRev->reject(Yii::app()->user);

    }

    public function actionApproveModuleRevision() {
        $idRevision = Yii::app()->request->getPost('idRevision');
        $moduleRev = RevisionModule::model()->findByPk($idRevision);
        if (!$moduleRev->canApprove()) {
            throw new RevisionControllerException(403, Yii::t('revision', '0828'));
        }
        $moduleRev->approve(Yii::app()->user);
    }

    public function actionCancelModuleRevision () {
        $idRevision = Yii::app()->request->getPost('idRevision');
        $moduleRev = RevisionModule::model()->findByPk($idRevision);
        if (!$moduleRev->canCancel()) {
            throw new RevisionControllerException(403, Yii::t('revision', '0590'));
        }
        if($moduleRev->deleteModuleLecturesFromRegularDB()){
            $moduleRev->cancel(Yii::app()->user);
        }
    }

    public function actionReadyModuleRevision() {
        $idRevision = Yii::app()->request->getPost('idRevision');
        $moduleRev = RevisionModule::model()->findByPk($idRevision);
        if (!$moduleRev->canReleaseRevision()) {
            throw new RevisionControllerException(403, Yii::t('revision', '0828'));
        }
        $moduleRev->release(Yii::app()->user);
    }

    public function actionPreviewModuleRevision($idRevision) {

        $moduleRevision = RevisionModule::model()->findByPk($idRevision);
        if(!$moduleRevision)
            throw new RevisionControllerException(404);
        if (!RevisionModule::canCreateModuleRevisions($moduleRevision->id_module)) {
            throw new RevisionControllerException(403, Yii::t('revision', '0825'));
        }

        $this->render("modulePreview", array(
            "moduleRevision" => $moduleRevision,
        ));
    }

    public function actionEditModuleRevisionPage($idRevision) {
        $moduleRevision = RevisionModule::model()->findByPk($idRevision);
        if(!$moduleRevision)
            throw new RevisionControllerException(404);
        if (!$moduleRevision->isEditable()) {
            throw new RevisionControllerException(400, Yii::t('revision', '0826'));
        }
        if (!$moduleRevision->canEdit()) {
            throw new RevisionControllerException(403, Yii::t('revision', '0825'));
        }

        $this->render("moduleView", array(
            "moduleRevision" => $moduleRevision,
        ));
    }

    public function actionGetModuleRevisionPreviewData()
    {
        $idRevision = Yii::app()->request->getPost('idRevision');

        $moduleRevision = RevisionModule::model()->findByPk($idRevision);

        $lectures = [];
        $module = [];
        $data = array('module' => array(),'lectures' => array());
        foreach ($moduleRevision->moduleLecturesModels as $key=>$lecturesModel) {
            $lecture = $lecturesModel->lecture;
            $lectures[$key]["id_lecture_revision"] = $lecture->id_revision;
            $lectures[$key]["lecture_order"] = $lecturesModel->lecture_order;
            $lectures[$key]["title"] = $lecture->properties->title_ua;
        }

        $module['status']=$moduleRevision->getStatus();
        $module['canEdit']=$moduleRevision->canEdit();
        $module['canSendForApproval']=$moduleRevision->canSendForApproval();
        $module['canCancelSendForApproval']=$moduleRevision->canCancelSendForApproval();
        $module['canApprove']=$moduleRevision->canApprove();
        $module['canCancelReadyRevision']=$moduleRevision->canCancelReadyRevision();
        $module['canRejectRevision']=$moduleRevision->canRejectRevision();
        $module['canReleaseRevision']=$moduleRevision->canReleaseRevision();
        $module['canCancelEdit']=$moduleRevision->canCancelEdit();
        $module['canRestoreEdit']=$moduleRevision->canRestoreEdit();
        $module['link']=
            $module['canCancelReadyRevision']?
                Yii::app()->createUrl("module/index", array("idModule" => $moduleRevision->id_module)):null;
        $data['module']=$module;
        $data['lectures']=$lectures;
        echo CJSON::encode($data);
    }

    // action editProperties for editable.EditableField widget
    public function actionXEditableEditProperties() {
        $idRevision = Yii::app()->request->getPost('pk');
        $attr = Yii::app()->request->getPost('name');
        $input = Yii::app()->request->getPost('value');

        $moduleRevision = RevisionModule::model()->findByPk($idRevision);

        if (!$moduleRevision->canEdit()) {
            throw new RevisionControllerException(403, Yii::t('error', '0590'));
        }

        $params[$attr] = $input;
        $moduleRevision->editProperties($params, Yii::app()->user);
    }

    public function actionGetApprovedLecture() {
        $idModule = Yii::app()->request->getPost('idModule');

        // select only released lecture revision
        $lecturesInCurrentModule = "SELECT DISTINCT vcl.id_revision, vcp.title_ua FROM vc_lecture vcl LEFT JOIN vc_lecture_properties vcp ON vcp.id=vcl.id_properties
            WHERE vcp.id_user_released IS NOT NULL and vcp.id_user_cancelled IS NULL and vcl.id_module=".$idModule;

        $listFromCurrentModule = Yii::app()->db->createCommand($lecturesInCurrentModule)->queryAll();
        $approvedLectureList = array();
        foreach ($listFromCurrentModule as $key=>$item) {
            $approvedLectureList['current'][$key]['id_lecture_revision']=$item['id_revision'];
            $approvedLectureList['current'][$key]['title']=$item['title_ua'];
            $approvedLectureList['current'][$key]['link']=Yii::app()->createUrl('/revision/previewLectureRevision',array('idRevision'=>$item['id_revision']));;
        }

        // select only released lecture revision
        $lecturesInOtherModules = "SELECT DISTINCT vcl.id_revision, vcp.title_ua FROM vc_lecture vcl LEFT JOIN vc_lecture_properties vcp ON vcp.id=vcl.id_properties
            WHERE (vcp.id_user_released IS NOT NULL) and vcp.id_user_cancelled IS NULL and vcl.id_module!=".$idModule;

        $listFromOtherModules= Yii::app()->db->createCommand($lecturesInOtherModules)->queryAll();
        foreach ($listFromOtherModules as $key=>$item) {
            $approvedLectureList['foreign'][$key]['id_lecture_revision']=$item['id_revision'];
            $approvedLectureList['foreign'][$key]['title']=$item['title_ua'];
            $approvedLectureList['foreign'][$key]['link']=Yii::app()->createUrl('/revision/previewLectureRevision',array('idRevision'=>$item['id_revision']));;
        }

        echo CJSON::encode($approvedLectureList);
    }

    public function actionGetModuleData() {
        $idModule = trim(Yii::app()->request->getPost("idModule"));
        $exists = RevisionModule::model()->exists('id_module='.$idModule);
        $data['revision']=$exists;
        
        echo CJSON::encode($data);
    }

    public function actionBuildTreeInModule() {
        $idModule = Yii::app()->request->getPost('idModule');
        $status = Yii::app()->request->getPost('status');
        $moduleRev = RevisionModule::model()->findByAttributes(array("id_module" => $idModule));

        $actualIdList=RevisionModule::getFilteredIdRevisions($status,$idModule);

        $relatedRev = $moduleRev->getRelatedModules();
        $relatedTree = RevisionModule::getModulesTree($idModule);
        $json = $this->buildModuleTreeJsonMultiselect($relatedRev, $relatedTree, $actualIdList);

        echo $json;
    }

    public function actionBuildTreeInCourse() {
        $idCourse = Yii::app()->request->getPost('idCourse');
        $status = Yii::app()->request->getPost('status');

        $actualIdList=RevisionModule::getFilteredIdRevisions($status);

        $list=Course::model()->modulesIdInCourse($idCourse);
        $relatedRev  = RevisionModule::modelsByList($list);
        $relatedTree = RevisionModule::getModulesTree(null,$list);
        $json = $this->buildModuleTreeJsonMultiselect($relatedRev, $relatedTree, $actualIdList);

        echo $json;
    }

    public function actionBuildAllModulesTree() {
        $status = Yii::app()->request->getPost('status');

        $actualIdList=RevisionModule::getFilteredIdRevisions($status);

        $relatedRev  = RevisionModule::model()->findAll();
        $relatedTree = RevisionModule::getModulesTree();
        $json = $this->buildModuleTreeJsonMultiselect($relatedRev, $relatedTree, $actualIdList);

        echo $json;
    }

    public function actionCheckModuleRevision() {
        $idRevision = Yii::app()->request->getPost('idRevision');
        $revisionModule=RevisionModule::model()->findByPk($idRevision);
        $result = $revisionModule->checkConflicts();
       
        if (empty($result)) {
            echo "Конфліктів не виявлено!";
            return;
        } else {
            echo $result;
            return;
        }
    }

    public function actionUpdateModuleRevisionImage($id)
    {
        $revisionProperties = RevisionModuleProperties::model()->findByPk($id);
        if (isset($_POST['RevisionModuleProperties'])) {
            $imageName = $_FILES['RevisionModuleProperties']['name']['module_img'];
            $tmpName = $_FILES['RevisionModuleProperties']['tmp_name']['module_img'];
            if (!empty($imageName)) {
                if ($revisionProperties->validate()) {
                    $revisionProperties->updateRevisionModuleLogo($imageName,$tmpName,$id);
                    $this->redirect(Yii::app()->request->urlReferrer);
                }else {
                    $this->redirect(Yii::app()->request->urlReferrer);
                }
            } else {
                $this->redirect(Yii::app()->request->urlReferrer);
            }
        }

    }

    // get module by revision
    public function actionGetModuleByRevision() {
        $idRevision = Yii::app()->request->getPost('idRevision');
        $moduleRev= RevisionModule::model()->findByPk($idRevision);
        echo $moduleRev->id_module;
    }

    //get data for send letter to author of module revision
    public function actionGetDataForModuleRevisionMail()
    {
        $idRevision = Yii::app()->request->getPost('idRevision');
        $moduleRevision = RevisionModule::model()->findByPk($idRevision);

        if (!RevisionModule::canCreateModuleRevisions($moduleRevision->id_module)) {
            throw new RevisionControllerException(403, Yii::t('error', '0590'));
        }

        $data = [];
        $data['authorName'] =StudentReg::getUserNamePayment($moduleRevision->properties->id_user_created);
        $data['authorId'] =$moduleRevision->properties->id_user_created;
        $data['theme'] = "Ревізія №" . $moduleRevision->id_module_revision . " " . $moduleRevision->properties->title_ua;
        $data["link"]=Yii::app()->createUrl('/moduleRevision/previewModuleRevision',array('idRevision'=>$moduleRevision->id_module_revision));

        echo CJSON::encode($data);
    }
}