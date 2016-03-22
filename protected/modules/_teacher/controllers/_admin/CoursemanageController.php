<?php

class CoursemanageController extends TeacherCabinetController
{
    /**
     * @return array action filters
     */
    public function init()
    {
        parent::init();
    }

    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'course-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionView($id)
    {
        $modules = CourseModules::model()->with('moduleInCourse')->findAllByAttributes(array('id_course' => $id));
        $model = $this->loadModel($id);

        $this->renderPartial('view', array(
            'model' => $model,
            'modules' => $modules
        ), false, true);
    }

    public function actionCreate()
    {
        $model = new Course;

        $this->performAjaxValidation($model);

        if (isset($_POST['Course'])) {

            if (!empty($_FILES)) {
                $_POST['Course']['course_img'] = $_FILES['Course']['name']['course_img'];
                $model->logo = $_FILES['Course'];
                $fileInfo = new SplFileInfo($_POST['Course']['course_img']);
            }
            $model->attributes = $_POST['Course'];
            if ($model->alias) $model->alias = str_replace(" ", "_", $model->alias);
            if ($model->save()) {
                if ($model->course_img == Null) {
                    $thisModel = new Course;
                    $thisModel->updateByPk($model->course_ID, array('course_img' => 'courseImage.png'));
                }
                if (!empty($_POST['Course']['course_img'])) {
                    ImageHelper::uploadAndResizeImg(
                        Yii::getPathOfAlias('webroot') . "/images/course/" . $_FILES['Course']['name']['course_img'],
                        Yii::getPathOfAlias('webroot') . "/images/course/share/shareCourseImg_" . $model->course_ID . '.' . $fileInfo->getExtension(),
                        210
                    );
                }
                echo 'Курс успішно створено!';
                Yii::app()->end();
            } else {
                echo 'Курс не вдалося створити. Перевірте вхідні дані або зверніться до адміністратора.';
                Yii::app()->end();
            }
        }

        $this->renderPartial('create', array(
            'model' => $model,
        ), false, true);
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $modules = CourseModules::model()->with('moduleInCourse')->findAllByAttributes(array('id_course' => $id));

        $model = $this->loadModel($id);

        $this->performAjaxValidation($model);

        if (isset($_POST['Course'])) {
            $model->oldLogo = $model->course_img;
            if (!empty($_FILES)) {
                $_POST['Course']['course_img'] = $_FILES['Course']['name']['course_img'];
                $model->logo = $_FILES['Course'];
                $fileInfo = new SplFileInfo($_POST['Course']['course_img']);
            }
            $model->attributes = $_POST['Course'];
            if ($model->alias) $model->alias = str_replace(" ", "_", $model->alias);
            if (!$model->validate()) {
                Yii::app()->end();
            }
            if ($model->save()) {
                if (!empty($_POST['Course']['course_img'])) {
                    ImageHelper::uploadAndResizeImg(
                        Yii::getPathOfAlias('webroot') . "/images/course/" . $_FILES['Course']['name']['course_img'],
                        Yii::getPathOfAlias('webroot') . "/images/course/share/shareCourseImg_" . $id . '.' . $fileInfo->getExtension(),
                        210
                    );
                }
                echo 'Курс успішно оновлено!';
                Yii::app()->end();
            } else {
                echo 'Інформацію про курс не вдалося оновити. Перевірте вхідні дані або зверніться до адміністратора.';
                Yii::app()->end();
            }

        }

        $this->renderPartial('update', array(
            'model' => $model,
            'modules' => $modules
        ), false, true);
    }


    /**
     * Delete/restore a particular model.
     * If updating is successful, the server send message "success".
     * @param integer $id the ID of the model to be deleted
     */
    public function actionChangeStatus($id)
    {
        $model = Course::model()->findByPk($id);
        if ($model->changeStatus())
            return "success";
        else {
            return "error";
        }
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $this->renderPartial('admin', array(), false, true);
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

    public function actionAddExistModule($id)
    {

        $course = Course::model()->findByPk($id);

        $this->renderPartial('addExistModule', array(
            'course' => $course,
        ), false, true);
    }

    public function actionAddModuleToCourse()
    {

        $moduleId = Yii::app()->request->getPost('moduleId');
        $courseId = Yii::app()->request->getPost('courseId');

        if (CourseModules::addNewRecord($moduleId, $courseId)) {
            echo "success";
        } else {
            echo "error";
        }
    }

    public function actionSchema($idCourse)
    {
        $modules = Course::getCourseModulesSchema($idCourse);
        if (count($modules) <= 0) {
            $this->render('schemaError');
        }
        $tableCells = Course::getTableCells($modules, $idCourse);
        $courseDurationInMonths = Course::getCourseDuration($tableCells) + 5;

        $this->renderPartial('_schema', array(
            'modules' => $modules,
            'idCourse' => $idCourse,
            'tableCells' => $tableCells,
            'courseDuration' => $courseDurationInMonths,
            'save' => false,
        ), false, true);
    }

    public function actionSaveSchema($idCourse)
    {
        $modules = Course::getCourseModulesSchema($idCourse);
        $tableCells = Course::getTableCells($modules, $idCourse);
        $courseDurationInMonths = Course::getCourseDuration($tableCells) + 5;
        $lang = $_SESSION['lg'];
        $lg = ['ua', 'ru', 'en'];
        for ($i = 0; $i < 3; $i++) {
            Yii::app()->session['lg'] = $lg[$i];
            $messages = Translate::model()->getMessagesForSchemabyLang($lg[$i]);

            $schema = $this->renderPartial('_schema', array(
                'modules' => $modules,
                'idCourse' => $idCourse,
                'tableCells' => $tableCells,
                'courseDuration' => $courseDurationInMonths,
                'messages' => $messages,
                'save' => true
            ), true);
            $name = 'schema_course_' . $idCourse . '_' . $lg[$i] . '.html';
            $file = StaticFilesHelper::pathToCourseSchema($name);
            file_put_contents($file, $schema);
        }
        Yii::app()->session['lg'] = $lang;

        echo "success";
    }

    public function actionGenerateSchema($id)
    {
        $modules = Course::getCourseModulesSchema($id);
        $tableCells = Course::getTableCells($modules, $id);
        $courseDurationInMonths = Course::getCourseDuration($tableCells) + 5;
        $lang = $_SESSION['lg'];
        $lg = ['ua', 'ru', 'en'];
        for ($i = 0; $i < 3; $i++) {
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
            $name = 'schema_course_' . $id . '_' . $lg[$i] . '.html';
            $file = StaticFilesHelper::pathToCourseSchema($name);
            file_put_contents($file, $schema);
        }
        Yii::app()->session['lg'] = $lang;
        $this->redirect(Yii::app()->createUrl('course/schema', array('id' => $id)));
    }

    public function actionGenerationAvailableModule()
    {

        if (isset($_POST['course']))
            $course = $_POST['course'];

        $result = Module::showAvailableModule($course);

        echo $result;
    }

    public function actionGetCoursesList()
    {
        echo Course::coursesList();
    }

    public function actionModulesByQuery($query, $course)
    {
        if ($query) {
            $modules = Module::modulesNotInDefinedCourse($query, $course);
            echo $modules;
        } else {
            throw new \application\components\Exceptions\IntItaException('400');
        }
    }
}