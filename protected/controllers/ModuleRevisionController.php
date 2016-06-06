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
}