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

    public function actionView($id)
    {
        $this->renderPartial('view',array(
            'model'=>$this->loadModel($id),
        ),false,true);
    }

    public function actionCreate()
    {
        $model=new Course;
        // Uncomment the following line if AJAX validation is needed
//        $this->performAjaxValidation($model);
        if(isset($_POST['Course']))
        {
            if(!empty($_FILES)){
                $_POST['Course']['course_img'] = $_FILES['Course']['name']['course_img'];
                $model->logo = $_FILES['Course'];
                $fileInfo = new SplFileInfo($_POST['Course']['course_img']);
            }
            $model->attributes = $_POST['Course'];
            if($model->save()){
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
                $this->redirect(Yii::app()->createUrl('/_teacher/_admin/coursemanage/index'));
            }
        }
        $this->renderPartial('create',array(
            'model'=>$model,
        ),false,true);
    }
    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model=$this->loadModel($id);
        // Uncomment the following line if AJAX validation is needed
//         $this->performAjaxValidation($model);

        if(isset($_POST['Course']))
        {
            $model->oldLogo=$model->course_img;

            if(!empty($_FILES)){
                $_POST['Course']['course_img'] = $_FILES['Course']['name']['course_img'];
                $model->logo = $_FILES['Course'];
                $fileInfo = new SplFileInfo($_POST['Course']['course_img']);
            }
            $model->attributes=$_POST['Course'];
            if($model->save()){
                if (!empty($_POST['Course']['course_img'])) {
                    ImageHelper::uploadAndResizeImg(
                        Yii::getPathOfAlias('webroot') . "/images/course/" . $_FILES['Course']['name']['course_img'],
                        Yii::getPathOfAlias('webroot') . "/images/course/share/shareCourseImg_" . $id . '.' . $fileInfo->getExtension(),
                        210
                    );
                }
                $this->redirect(Yii::app()->createUrl('/_teacher/_admin/coursemanage/index'));
            }
        }
        $this->renderPartial('update',array(
            'model'=>$model,
        ),false,true);
    }
    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        Course::model()->updateByPk($id, array('cancelled' => 1));
        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if(!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }
    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $dataProvider=new CActiveDataProvider('Course');
        $this->renderPartial('index',array(
            'dataProvider'=>$dataProvider,
        ),false,true);
    }
    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model=new Course('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Course']))
            $model->attributes=$_GET['Course'];
        $this->renderPartial('admin',array(
            'model'=>$model,
        ),false,true);
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
        $model=Course::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }
    /**
     * Performs the AJAX validation.
     * @param Course $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='course-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionAddExistModule(){

        $courses = Course::generateCoursesList();
        $modules = Module::generateModulesList();

        $this->renderPartial('addExistModule',array(
            'courses' => $courses,
            'modules' => $modules
        ),false,true);
    }

    public function actionAddModuleToCourse(){

        $moduleId = Yii::app()->request->getPost('moduleId');
        $courseId = Yii::app()->request->getPost('courseId');

        CourseModules::addNewRecord($moduleId, $courseId);

        $this->redirect(Yii::app()->createUrl('/_teacher/_admin/coursemanage/index'));
    }

    public function actionSchema($idCourse){
        $modules = Course::getCourseModulesSchema($idCourse);
        if(count($modules) <= 0){
            $this->render('schemaError');
        }
        $tableCells = Course::getTableCells($modules, $idCourse);
        $courseDurationInMonths =  Course::getCourseDuration($tableCells) + 5;

        $this->renderPartial('_schema', array(
            'modules' => $modules,
            'idCourse' => $idCourse,
            'tableCells' => $tableCells,
            'courseDuration' => $courseDurationInMonths,
            'save' => false,
        ),false,true);
    }

    public function actionSaveSchema($idCourse){
        $modules = Course::getCourseModulesSchema($idCourse);
        $tableCells = Course::getTableCells($modules, $idCourse);
        $courseDurationInMonths =  Course::getCourseDuration($tableCells) + 5;
        $lang = $_SESSION['lg'];
        $lg = ['ua','ru','en'];
        for($i = 0;$i < 3;$i++)
        {
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
            $name = 'schema_course_'.$idCourse.'_'.$lg[$i].'.html';
            $file = StaticFilesHelper::pathToCourseSchema($name);
            file_put_contents($file, $schema);
        }
        Yii::app()->session['lg'] = $lang;
        $this->redirect(Yii::app()->createUrl('/_teacher/_admin/coursemanage/index'));
    }

    public function actionRestore($id){
        Course::model()->updateByPk($id, array('cancelled' => 0));
        $this->actionAdmin();
    }

    public function actionGenerateSchema($id){
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
        $this->redirect(Yii::app()->createUrl('course/schema', array('id' => $id)));
    }

}