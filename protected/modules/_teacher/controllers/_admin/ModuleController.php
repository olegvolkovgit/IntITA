<?php
/**
 * Created by PhpStorm.
 * User: Quicks
 * Date: 28.12.2015
 * Time: 15:11
 */

class ModuleController extends TeacherCabinetController {

    public function actionIndex()
    {
        $model = new Module('search');
        $model->unsetAttributes();
        if (isset($_GET['Module']))
            $model->attributes = $_GET['Module'];

        $this->renderPartial('index', array(
            'model' => $model,
        ),false,true);
    }

    public function actionCreate()
    {
        $model = new Module;
        $this->performAjaxValidation($model);

        if (isset($_POST['Module'])) {
            $model->attributes = $_POST['Module'];
            if ($model->save())
                if ($model->module_img == Null) {
                    $thisModel = new Module;
                    $thisModel->updateByPk($model->module_ID, array('module_img' => 'courseimg1.png'));
                }
            $this->redirect($this->pathToCabinet());
        }

        $this->renderPartial('create', array(
            'model' => $model,
        ),false,true);
    }

    public function actionDelete($id){
        Module::model()->updateByPk($id,array('cancelled' => 1));
    }

    public function actionRestore($id){
        $model = Module::model()->findByPk($id);
        $model->cancelled = 0;
        $this->saveModel($model);

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

    public function actionView($id)
    {
        $model = Module::model()->findByPk($id);

        $this->renderPartial('view', array(
            'model' => $model,
        ),false,true);
    }

    public function actionUpdate($id)
    {
        $model = Module::model()->findByPk($id);
        $this->performAjaxValidation($model);

        if (isset($_POST['Module'])) {

            $model->oldLogo = $model->module_img;

            $model->attributes = $_POST['Module'];

            if(!empty($_FILES)){
            $imageName = array_shift($_FILES['Module']['name']);

            if(!empty($imageName)){

                $tmpName = array_shift($_FILES['Module']['tmp_name']);

                if (!empty($imageName)) {
                    $model->logo = $_FILES['Module'];

                    if ($model->validate()) {
                        $model->save();

                        if(!Avatar::updateModuleAvatar($imageName, $tmpName, $id, $model->oldLogo))
                             throw new CDbException(400,'Avatar not SAVE');
                    }
                }
            }
            }
            else{
                $model->save();
                if(!Module::model()->updateByPk($id,array('module_img' => $model->oldLogo))) //Костиль
                    throw new CDbException(400,'Avatar not SAVE');
            }
            $this->redirect($this->pathToCabinet());

        }
        $this->renderPartial('update', array(
            'model' => $model
        ),false,true);
    }

    public function actionMandatory($id){

        $courses = Course::generateModuleCoursesList($id);

        $this->renderPartial('mandatory', array(
            'id' => $id,
            'courses' => $courses
        ),false,true);
    }

    public function actionAddMandatoryModule(){
        $idModule = Yii::app()->request->getPost('module', 0);
        $idCourse = Yii::app()->request->getPost('course', 0);
        $mandatory = Yii::app()->request->getPost('mandatory', 0);

        Yii::app()->db->createCommand('UPDATE course_modules SET mandatory_modules='.$mandatory.' WHERE id_module='.
            $idModule.' and id_course='.$idCourse)->query();

        $this->redirectToIndex(__CLASS__);
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
            return $this->renderPartial('_ajaxModule',array('modules' => $modules),false,true);
        }
    }

    public function actionCoursePrice($id){
        $courses = Course::generateModuleCoursesList($id);
        $this->renderPartial('coursePrice', array(
            'id' => $id,
            'courses' => $courses
        ),false,true);
    }

    public function actionAddCoursePrice(){
        $idModule = Yii::app()->request->getPost('module', 0);
        $idCourse = Yii::app()->request->getPost('course', 0);
        $price = Yii::app()->request->getPost('price', 0);

        Yii::app()->db->createCommand('UPDATE course_modules SET price_in_course='.$price.' WHERE id_module='.
            $idModule.' and id_course='.$idCourse)->query();

        $this->redirectToIndex(__CLASS__);
    }

    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'module-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    private function saveModel($model)
    {
        if ($model->save())
        {
            $this->actionIndex();
        }
        else throw new \Stash\Exception\RuntimeException('Model not save!!!');

    }
}