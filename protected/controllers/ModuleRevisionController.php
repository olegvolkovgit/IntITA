<?php

class ModuleRevisionController extends Controller {
    public $layout = 'revisionlayout';

    public function init()
    {
        parent::init();
        $app = Yii::app();
        if (isset($app->session['lg'])) {
            $app->language = $app->session['lg'];
        }
        if (Yii::app()->user->isGuest) {
            $this->render('/site/authorize');
            die();
        } else return true;
    }

    public function actionCourseModulesRevisions($idCourse) {
        if (!Yii::app()->user->model->isAdmin()) {
            throw new RevisionControllerException(403, Yii::t('revision', '0829'));
        }

        $this->render('courseModulesRevisions', array(
            'idCourse' => $idCourse,
            'isApprover' => Yii::app()->user->model->isAdmin(),
            'userId' => Yii::app()->user->getId(),
        ));
    }

    public function actionEditModule() {

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
            $moduleRev = RevisionModule::getParentRevisionForModule($module->module_ID);
            $data[$key]['releasedFromRevision'] = ($moduleRev)?$moduleRev->id_module_revision:null;
        }
        echo CJSON::encode($data);
    }

    public function actionBuildRevisionsInCourse() {
        $idCourse = Yii::app()->request->getPost('idCourse');
        $moduleRev = RevisionModule::model()->findAll();
        $relatedTree = RevisionModule::getModulesTree($idCourse);
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

    public function actionCreateNewModuleRevision() {
        $titleUa = trim(Yii::app()->request->getPost("revTitleUa"));
        $titleEn = trim(Yii::app()->request->getPost("revTitleEn"));
        $titleRu = trim(Yii::app()->request->getPost("revTitleRu"));

        if (!RegisteredUser::userById(Yii::app()->user->getId())->canApprove()) {
            throw new RevisionControllerException(403, Yii::t('error', '0590'));
        }

        $revModule = RevisionModule::createNewModule($titleUa, $titleEn, $titleRu, Yii::app()->user);
        $this->redirect(array('moduleRevision/editModuleRevision', 'idRevision' => $revModule->id_module_revision));
    }

    public function actionEditModuleRevision($idRevision) {

        $moduleRevision = RevisionModule::model()->findByPk($idRevision);

        if(!$moduleRevision)
            throw new RevisionControllerException(404);
        if (!RegisteredUser::userById(Yii::app()->user->getId())->canApprove()) {
            throw new RevisionControllerException(403, Yii::t('revision', '0825'));
        }

//        if (!$lectureRevision->isEditable()) {
//            throw new RevisionControllerException(400, Yii::t('revision', '0826'));
//        }

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
        foreach ($moduleRevision->moduleLectures as $key=>$lecture) {
            $lectures[$key]["id"] = $lecture->id_lecture_revision;
            $lectures[$key]["lecture_order"] = $lecture->lecture_order;
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
//        $module['link']=
//            $lecture['canCancelReadyRevision']?
//                Yii::app()->createUrl("lesson/index", array("id" => $moduleRevision->id_lecture, "idCourse" => 0)):null;
        
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

        if (!RegisteredUser::userById(Yii::app()->user->getId())->canApprove()) {
            throw new RevisionControllerException(403, Yii::t('error', '0590'));
        }

        $params[$attr] = $input;
        $moduleRevision->editProperties($params, Yii::app()->user);
    }

    public function actionGetReleasedLecture() {
        $sql = "SELECT DISTINCT vcl.id_revision, vcp.title_ua FROM vc_lecture vcl LEFT JOIN vc_lecture_properties vcp ON vcp.id=vcl.id_properties
            WHERE vcp.id_user_released IS NOT NULL and vcp.id_user_cancelled IS NULL";

        $list = Yii::app()->db->createCommand($sql)->queryAll();
        $readyLectureList = array();
        foreach ($list as $key=>$item) {
            $readyLectureList[$key]['id_revision']=$item['id_revision'];
            $readyLectureList[$key]['title']=$item['title_ua'];
        }

        echo CJSON::encode($readyLectureList);
    }

}