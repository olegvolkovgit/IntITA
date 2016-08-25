<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 21.09.2015
 * Time: 0:33
 */
class ModuleController extends AdminController
{

    public function filters()
    {
        return array(
            'accessControl',
            'postOnly + delete',
        );
    }

    public function actionIndex()
    {
        $model = new Module('search');
        $model->unsetAttributes();
        if (isset($_GET['Module']))
            $model->attributes = $_GET['Module'];

        $this->render('index', array(
            'model' => $model,
        ));
    }

    public function actionView($id)
    {
        $model = Module::model()->findByPk($id);

        $this->render('view', array(
            'model' => $model,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new Module;

        if (isset($_POST['Module'])) {
            $model->attributes = $_POST['Module'];
            if ($model->save())
                if ($model->module_img == Null) {
                    $thisModel = new Module;
                    $thisModel->updateByPk($model->module_ID, array('module_img' => 'courseimg1.png'));
                }
                $this->redirect(array('view', 'id' => $model->module_ID));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    public function actionUpdate($id)
    {
        $model = Module::model()->findByPk($id);
        if (isset($_POST['Module'])) {
            if (isset($_POST['Module']['module_number'])) {
                if ($existingModel = Module::model()->findByAttributes(array(
                        'module_number' => $_POST['Module']['module_number']))
                ) {
                   if (($existingModel->module_ID != $_POST['Module']['module_ID']) && ($_POST['Module']['module_number'] != 0))
                    throw new CHttpException(400, 'Номер модуля повинен бути унікальним. Такий номер модуля вже
                    існує.');
                }
            }

            if (isset($_POST['Module']['alias'])) {
                if ($existingModel = Module::model()->findByAttributes(
                        array('alias' => $_POST['Module']['alias']))
                    ) {
                    if($existingModel->module_ID != $_POST['Module']['module_ID'] && ($_POST['Module']['alias'] != "")) {
                        throw new CHttpException(400, 'Alias модуля повинен бути унікальним. Такий псевдонім модуля вже
                    зайнятий.');
                    }
                }
            }

            $model->oldLogo = $model->module_img;

            $model->attributes = $_POST['Module'];

            $imageName = array_shift($_FILES['Module']['name']);

            if(!empty($imageName)){

            $tmpName = array_shift($_FILES['Module']['tmp_name']);

            if (!empty($imageName)) {
                $model->logo = $_FILES['Module'];

                if ($model->validate()) {
                    $model->save();

                   if(Avatar::updateModuleAvatar($imageName, $tmpName, $id, $model->oldLogo))
                    $this->redirect(array('view', 'id' => $model->module_ID));

                    else throw new \application\components\Exceptions\IntItaException('Avatar not SAVE');
                }
            }
            }
            else{
                $model->save();
                if(Module::model()->updateByPk($id,array('module_img' => $model->oldLogo))) //Костиль
                $this->redirect(array('view', 'id' => $model->module_ID));
            }
        }
        $this->render('update', array(
            'model' => $model
        ));
    }

    public function actionDelete($id){

       Module::model()->updateByPk($id,array('cancelled' => 1));
    }

    public function actionRestore($id){
        $model = Module::model()->findByPk($id);
        $model->cancelled = 0;
        $this->saveModel($model);

    }

    public function actionMandatory($id){
        $this->render('mandatory', array(
            'id' => $id
        ),false,true);
    }

    public function actionAddMandatoryModule(){

        $idModule = Yii::app()->request->getPost('module', 0);
        $idCourse = Yii::app()->request->getPost('course', 0);
        $mandatory = Yii::app()->request->getPost('mandatory', 0);

        Yii::app()->db->createCommand('UPDATE course_modules SET mandatory_modules='.$mandatory.' WHERE id_module='.
            $idModule.' and id_course='.$idCourse)->query();
        $this->redirect(Yii::app()->request->urlReferrer);
    }

    public function actionGetModuleByCourse()
    {
        if(Yii::app()->request->isAjaxRequest)
        {
        if(empty($_POST['course']))
        {
            $modules = '';
        }
        else
        {
            $id =  (int)($_POST['course']);
            $modules = Course::model()->findByPk($id)->module;
        }
        return $this->renderPartial('_ajaxModule',array('modules' => $modules));
        }
    }

    public function actionUpStatus($id)
    {

        $model = Module::model()->findByPk($id);
        $model->status = 0;
        $this->saveModel($model);
    }
    public function actionDownStatus($id)
    {
        $model = Module::model()->findByPk($id);
        $model->status = 1;
        $this->saveModel($model);
    }

    private function saveModel($model)
    {
        if ($model->save())
        {
            $this->actionIndex();
        }
        else throw new \Stash\Exception\RuntimeException('Model not save!!!');

    }

    public function actionCourseModuleList()
    {
        $id = $_POST['id'];

        $courses = Module::model()->findByPk($id)->Course;

        $courseNumber = 'Ви щойно видалили модуль, який є в таких курсах ';

        foreach($courses as $course)
        {
            $courseNumber .= ' '.$course->title_ua;
        }

        echo $courseNumber;
    }

}