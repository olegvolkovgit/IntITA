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
        $json = $this->buildLectureTreeJson($moduleRev, $relatedTree);

        echo $json;
    }
}