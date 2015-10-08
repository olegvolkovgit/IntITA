<?php
class CoursemanageController extends AdminController
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
//    public $layout='main';

//    public function init()
//    {
//        if (Config::getMaintenanceMode() == 1) {
//            $this->renderPartial('/default/notice');
//            Yii::app()->cache->flush();
//            die();
//        }
//    }
    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl',
            'postOnly + delete', // we only allow deletion via POST request
        );
    }
    public function accessRules()
    {
        return array(
            array('allow',
                'actions'=>array('delete', 'create', 'update', 'view', 'index', 'admin', 'addExistModule' ,
                    'addModuleToCourse', 'schema'),
                'expression'=>array($this, 'isAdministrator'),
            ),
            array('deny',
                'message'=>"У вас недостатньо прав для перегляду та редагування сторінки.
                Для отримання доступу увійдіть з логіном адміністратора сайту.",
                'actions'=>array('delete', 'create', 'update', 'view', 'index', 'admin',  'addExistModule' ,
                    'addModuleToCourse', 'schema'),
                'users'=>array('*'),
            ),
        );
    }
    function isAdministrator()
    {
        if(AccessHelper::isAdmin())
            return true;
        else
            return false;
    }


    public function actionView($id)
    {
        $this->render('view',array(
            'model'=>$this->loadModel($id),
        ));
    }

    public function actionCreate()
    {
        $model=new Course;
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        if(isset($_POST['Course']))
        {
            if (isset($_POST['Course']['course_number'])) {
                if (Course::model()->exists('course_number=:course_number', array(
                        ':course_number' => $_POST['Course']['course_number'])
                )
                ) {
                    throw new CHttpException(400, 'Номер курса повинен бути унікальним. Такий номер курса вже
                    існує.');
                }
            }

            if (isset($_POST['Course']['alias'])) {
                if (Module::model()->exists('alias=:alias', array(':alias' => $_POST['Course']['alias']))) {
                    throw new CHttpException(400, 'Alias курса повинен бути унікальним. Такий псевдонім курса вже
                    зайнятий.');
                }
            }

            $_POST['Course']['course_img']=$_FILES['Course']['name']['course_img'];
            $fileInfo=new SplFileInfo($_POST['Course']['course_img']);
            $model->attributes=$_POST['Course'];
            $model->logo=$_FILES['Course'];
            if($model->save())
                if (!empty($_POST['Course']['course_img'])) {
                    ImageHelper::uploadAndResizeImg(
                        Yii::getPathOfAlias('webroot') . "/images/course/" . $_FILES['Course']['name']['course_img'],
                        Yii::getPathOfAlias('webroot') . "/images/course/share/shareCourseImg_" . $model->course_ID . '.' . $fileInfo->getExtension(),
                        210
                    );
                }
            $this->redirect(array('view','id'=>$model->course_ID));
        }
        $this->render('create',array(
            'model'=>$model,
        ));
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
        // $this->performAjaxValidation($model);
        if(isset($_POST['Course']))
        {
            $model->oldLogo=$model->course_img;
            $_POST['Course']['course_img']=$_FILES['Course']['name']['course_img'];
            $fileInfo=new SplFileInfo($_POST['Course']['course_img']);
            $model->attributes=$_POST['Course'];
            $model->logo=$_FILES['Course'];
            if($model->save())
            if (!empty($_POST['Course']['course_img'])) {
                ImageHelper::uploadAndResizeImg(
                    Yii::getPathOfAlias('webroot') . "/images/course/" . $_FILES['Course']['name']['course_img'],
                    Yii::getPathOfAlias('webroot') . "/images/course/share/shareCourseImg_" . $id . '.' . $fileInfo->getExtension(),
                    210
                );
            }
            $this->redirect(array('view','id'=>$model->course_ID));
        }
        $this->render('update',array(
            'model'=>$model,
        ));
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
        $this->render('index',array(
            'dataProvider'=>$dataProvider,
        ));
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
        $this->render('admin',array(
            'model'=>$model,
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
        $this->render('addExistModule');
    }

    public function actionAddModuleToCourse(){

        CourseModules::addNewRecord($_POST['module'], $_POST['course']);

        $dataProvider=new CActiveDataProvider('Course');
        $this->render('index', array(
            'dataProvider' => $dataProvider
        ));
    }

    public function actionSchema($idCourse){

        $modules = CourseModules::getCourseModulesSchema($idCourse);
        $tableCells = CourseModules::getTableCells($modules, $idCourse);
        $courseDurationInMonths =  CourseModules::getCourseDuration($tableCells) + 5;

        $this->render('_schema', array(
            'modules' => $modules,
            'idCourse' => $idCourse,
            'tableCells' => $tableCells,
            'courseDuration' => $courseDurationInMonths,
        ));
    }
}