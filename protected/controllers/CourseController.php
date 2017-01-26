<?php

class CourseController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * Lists all models.
     */
    public function actionIndex($id)
    {
        if(Yii::app()->user->isGuest) {
            $isEditor = false;
        } else {
            $isEditor = Yii::app()->user->model->isContentManager();
        }

        $model = Course::model()->findByPk($id);

//        var_dump($model->checkPaidAccess(Yii::app()->user->getId()));

        if ($model->cancelled == Course::DELETED) {
            throw new \application\components\Exceptions\IntItaException('410', Yii::t('error', '0786'));
        }

        $this->render('index', array(
            'model' => $model,
            'isEditor' => $isEditor,
        ));

    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Course the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = Course::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Course $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'course-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
    
    public function actionCourseUpdate()
    {
        if (Yii::app()->request->isPostRequest) {
            $model = new Course;
            $model->attributes = $_POST;
            if ($model->save()) {
                echo CJSON::encode(array('id' => $model->primaryKey));
            } else {
                $errors = array_map(function ($v) {
                    return join(', ', $v);
                }, $model->getErrors());
                echo CJSON::encode(array('errors' => $errors));
            }
        } else {
            throw new CHttpException(400, 'Invalid request');
        }
    }

    public function actionSchema($id)
    {
        $lg = Yii::app()->session['lg'];
        $filename = StaticFilesHelper::pathToCourseSchema('schema_course_' . $id . '_' . $lg . '.html');

        if (!file_exists($filename)) {
            $modules = Course::getCourseModulesSchema($id);
            $tableCells = Course::getTableCells($modules, $id);
            $courseDurationInMonths =  Course::getCourseDuration($tableCells) + 5;
            $lang = $_SESSION['lg'];
            $lg = ['ua','ru','en'];
            for($i = 0;$i < 3;$i++)
            {
                Yii::app()->session['lg'] = $lg[$i];
                $messages = Translate::model()->getMessagesForSchemabyLang($lg[$i]);

                $schema = $this->renderPartial('_schema', array(
                    'modules' => $modules,
                    'idCourse' => $id,
                    'tableCells' => $tableCells,
                    'courseDuration' => $courseDurationInMonths,
                    'messages' => $messages,
                    'save' => true
                ), true);
                $name = 'schema_course_'.$id.'_'.$lg[$i].'.html';
                $file = StaticFilesHelper::pathToCourseSchema($name);
                file_put_contents($file, $schema);
            }
            Yii::app()->session['lg'] = $lang;
        }

        try {
            $path = Config::getBaseUrl() . '/' . $filename;
            $this->redirect($path);
        } catch (Exception $e) {
            throw new \application\components\Exceptions\IntItaException(404, Yii::t('course_schema', '0780'));
        }
    }

    public function checkInstance($model) {
        if ($model === null)
            throw new \application\components\Exceptions\CourseNotFoundException();
    }

    public function actionModulesData()
    {
        //init data json
        $data = [];
        $data["courseId"] = Yii::app()->request->getPost('id');
        $course=Course::model()->findByPk($data["courseId"]);

        if(Yii::app()->user->getId())
        $data["userId"] = Yii::app()->user->getId();
        else $data["userId"]=false;
        $data["isAdmin"] = (Yii::app()->user->isGuest)?false:(Yii::app()->user->model->isAdmin() || Yii::app()->user->model->isContentManager());
        $data["termination"][0] = Yii::t('module', '0653');
        $data["termination"][1] = Yii::t('module', '0654');
        $data["termination"][2] = Yii::t('module', '0655');
        $data["modules"]=[];
        if($course->status=='1')
            $data["courseStatus"]=true;
        else $data["courseStatus"]=false;

        //if guest or admin return json
        if(!$data["userId"] || $data["isAdmin"]){
            $modules=Course::model()->modulesInCourse($data["courseId"]);
            if($data["isAdmin"])
                $data["isPaidCourse"]=$course->checkPaidAccess(Yii::app()->user->getId());
            for($i = 0;$i < count($modules);$i++){
                if(!$data["userId"])
                    $data["modules"][$i]['access']=false;
                else $data["modules"][$i]['access']=true;
                $module=Module::model()->findByPk($modules[$i]['id_module']);
                $data["modules"][$i]['id']= $modules[$i]['id_module'];
                $data["modules"][$i]['time']= $module->monthsCount();
                $data["modules"][$i]['title']=CHtml::decode($module->getTitle());
                $data["modules"][$i]['link']=Yii::app()->createUrl("module/index", array("idModule" => $modules[$i]['id_module'], "idCourse" => $data["courseId"]));
            }
            echo CJSON::encode($data);
            return;
        }

        if(Yii::app()->user->model->isTeacher()){
            $data["teacherId"] = Yii::app()->user->getId();
            $data["isPaidCourse"]=$course->checkPaidAccess(Yii::app()->user->getId());
        }else{
            $data["teacherId"] = false;
            $data["isPaidCourse"]=$course->checkPaidAccess(Yii::app()->user->getId());
        }

        $modules=Course::model()->modulesInCourse($data["courseId"]);

        for($i = 0;$i < count($modules);$i++){
            $module=Module::model()->findByPk($modules[$i]['id_module']);
            $data["modules"][$i]['id']= $modules[$i]['id_module'];
            $data["modules"][$i]['time']= $module->monthsCount();
            $data["modules"][$i]['title']=CHtml::decode($module->getTitle());
            $data["modules"][$i]['link']=Yii::app()->createUrl("module/index", array("idModule" => $modules[$i]['id_module'], "idCourse" => $data["courseId"]));

            if( $data["teacherId"]){
                $data["modules"][$i]['isAuthor']=Yii::app()->user->model->isAuthorModule($modules[$i]['id_module']);
            }else{
                $data["modules"][$i]['isAuthor']=false;
            }
            if($data["isPaidCourse"]){
                $data["modules"][$i]['access']=true;
                $firstQuiz = $module->getFirstQuizId();
                if($module->getLastAccessLectureOrder()<$module->getLecturesCount())
                    $lastQuiz = false;
                else $lastQuiz = $module->getLastQuizId();
                if ($firstQuiz)
                    $data["modules"][$i]['startTime'] = (Module::getTimeAnsweredQuiz($firstQuiz, $data["userId"]))?(strtotime(Module::getTimeAnsweredQuiz($firstQuiz, $data["userId"]))): (false);
                else $data["modules"][$i]['startTime'] = false;
                if ($lastQuiz)
                    $data["modules"][$i]['finishTime'] = (Module::getTimeAnsweredQuiz($lastQuiz, $data["userId"]))?(strtotime(Module::getTimeAnsweredQuiz($lastQuiz, $data["userId"]))): (false);
                else $data["modules"][$i]['finishTime'] = false;
            }else{
                if($module->checkPaidAccess(Yii::app()->user->getId())) {
                    $data["modules"][$i]['access']=true;
                    $firstQuiz = $module->getFirstQuizId();
                    if($module->getLastAccessLectureOrder()<$module->getLecturesCount())
                        $lastQuiz = false;
                    else $lastQuiz = $module->getLastQuizId();
                    if ($firstQuiz)
                        $data["modules"][$i]['startTime'] = (Module::getTimeAnsweredQuiz($firstQuiz, $data["userId"]))?(strtotime(Module::getTimeAnsweredQuiz($firstQuiz, $data["userId"]))): (false);
                    else $data["modules"][$i]['startTime'] = false;
                    if ($lastQuiz)
                        $data["modules"][$i]['finishTime'] = (Module::getTimeAnsweredQuiz($lastQuiz, $data["userId"]))?(strtotime(Module::getTimeAnsweredQuiz($lastQuiz, $data["userId"]))): (false);
                    else $data["modules"][$i]['finishTime'] = false;
                }else{$data["modules"][$i]['access']=false;}
            }

        }
        echo CJSON::encode($data);
    }

    public function actionGetPaymentSchemas($service, $contentId, $educationFormId=EducationForm::ONLINE) {
        $educationForm = EducationForm::model()->findByPk($educationFormId);
        switch ($service){
            case 'module':
                $service = ModuleService::model()->getService($contentId, $educationForm);
                break;
            case 'course':
                $service = CourseService::model()->getService($contentId, $educationForm);
                break;
            default :
                $service = null;
                break;
        }
  
        $result=[];
        $result['schemes']=$service->getPaymentSchemas($educationForm);
        $result['icons']['discountIco']=StaticFilesHelper::createPath('image', 'course', 'pig.png');
        $result['translates']['price']=Yii::t('courses', '0147');
        $result['translates']['free']=Yii::t('module', '0421');
        $result['translates']['inCourse']=Yii::t('module', '0223');

        $this->renderPartial('//ajax/json', ['statusCode' => 200, 'body' => json_encode($result)]);
    }

    public function actionGetTypeahead($query) {
        $models = TypeAheadHelper::getTypeahead($query, 'Course', ['title_ua', 'title_ru', 'title_en']);
        $array = ActiveRecordToJSON::toAssocArray($models);
        $this->renderPartial('//ajax/json', ['body' => json_encode($array)]);
    }

}
