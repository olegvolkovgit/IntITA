<?php

/**
 * Created by PhpStorm.
 * User: Quicks
 * Date: 28.12.2015
 * Time: 15:11
 */
class ModuleController extends TeacherCabinetController
{
    public function actionIndex()
    {
        $this->renderPartial('index', array(), false, true);
    }

    public function actionCreate()
    {
        $model = new Module;
        $this->performAjaxValidation($model);

        if (isset($_POST['Module'])) {
            $model->attributes = $_POST['Module'];
            if($model->alias) $model->alias=str_replace(" ","_",$model->alias);
            if ($model->save())
            {
                if(!empty($_FILES['Module']['name']['module_img']))
                {
                    $imageName = array_shift($_FILES['Module']['name']);
                    $tmpName = array_shift($_FILES['Module']['tmp_name']);
                    if($imageName&& $tmpName){
                    if(!Avatar::updateModuleAvatar($imageName,$tmpName,$model->module_ID,$model->module_img))
                        throw new \application\components\Exceptions\IntItaException(400,'Avatar not save');
                    }
                }else{
                    Module::model()->updateByPk($model->module_ID, array('module_img' => 'module.png'));
                }
                $this->redirect($this->pathToCabinet());
            }

            $this->redirect($this->pathToCabinet());
        }
        $levels = Level::model()->findAll();

        $this->renderPartial('create', array(
            'model' => $model,
            'levels' => $levels
        ), false, true);
    }

    public function actionDelete($id)
    {
        if(CourseModules::getCoursesListName($id)==false){
            Module::model()->updateByPk($id, array('cancelled' => 1));
            echo false;
        }else{
            echo implode(", ", CourseModules::getCoursesListName($id));
        }
    }

    public function actionRestore($id)
    {
        Module::model()->updateByPk($id, array('cancelled' => 0));
    }

    public function actionUpStatus($id)
    {
        Module::model()->updateByPk($id, array('status' => 0));
    }

    public function actionDownStatus($id)
    {
        Module::model()->updateByPk($id, array('status' => 1));
    }

    public function actionView($id)
    {
        $model = Module::model()->with('lectures', 'teacher', 'inCourses')->findByPk($id);
        $courses = CourseModules::model()->with('course')->findAllByAttributes(array('id_module' => $id));

        $this->renderPartial('view', array(
            'model' => $model,
            'courses' => $courses,
        ), false, true);
    }

    public function actionUpdate($id)
    {
        $model = Module::model()->with('lectures', 'teacher')->findByPk($id);
        $courses = CourseModules::model()->with('course')->findAllByAttributes(array('id_module' => $id));

       // $this->performAjaxValidation($model);

        if (isset($_POST['Module'])) {
            $model->oldLogo = $model->module_img;
            $model->attributes = $_POST['Module'];
            if($model->alias) $model->alias=str_replace(" ","_",$model->alias);
            if (!empty($_FILES['Module']['name']['module_img'])) {
                $imageName = array_shift($_FILES['Module']['name']);
                $tmpName = array_shift($_FILES['Module']['tmp_name']);
                if (!empty($imageName)) {
                    if (!empty($imageName)) {
                        $model->logo = $_FILES['Module'];
                        if ($model->validate()) {
                            $model->save();
                            if($imageName && $tmpName) {
                                if (!Avatar::updateModuleAvatar($imageName, $tmpName, $id, $model->oldLogo))
                                    throw new \application\components\Exceptions\IntItaException(500, 'Аватар не був збережений.');
                            }
                        }
                    }
                }
            } else {
                $model->save();
                if (!Module::model()->updateByPk($id, array('module_img' => $model->oldLogo))){
                    Module::model()->updateByPk($id, array('module_img' => 'module.png'));
                }
            }
            $this->redirect($this->pathToCabinet());
        }
        $levels = Level::model()->findAll();

        $this->renderPartial('update', array(
            'model' => $model,
            'courses' => $courses,
            'levels' => $levels
        ), false, true);
    }

    public function actionMandatory($id)
    {
        $courses = Course::generateModuleCoursesList($id);

        $this->renderPartial('mandatory', array(
            'id' => $id,
            'courses' => $courses
        ), false, true);
    }

    public function actionAddMandatoryModule()
    {
        $idModule = Yii::app()->request->getPost('module', 0);
        $idCourse = Yii::app()->request->getPost('course', 0);
        $mandatory = Yii::app()->request->getPost('mandatory', 0);

        Yii::app()->db->createCommand('UPDATE course_modules SET mandatory_modules=' . $mandatory . ' WHERE id_module=' .
            $idModule . ' and id_course=' . $idCourse)->query();

        $this->actionIndex();
    }

    public function actionGetModuleByCourse()
    {
        if (Yii::app()->request->isAjaxRequest) {
            if (empty($_POST['course'])) {
                $modules = '';
            } else {
                $id = (int)($_POST['course']);
                $modules = Course::model()->findByPk($id)->module;
            }
            return $this->renderPartial('_ajaxModule', array('modules' => $modules), false, true);
        }
    }

    //todo refactor
    public function actionCoursePrice($id)
    {
        $courses = Course::generateModuleCoursesList($id);

        $this->renderPartial('coursePrice', array(
            'id' => $id,
            'courses' => $courses
        ), false, true);
    }

    public function actionAddCoursePrice()
    {
        $idModule = Yii::app()->request->getPost('module', 0);
        $idCourse = Yii::app()->request->getPost('course', 0);
        $price = Yii::app()->request->getPost('price', 0);

        Yii::app()->db->createCommand('UPDATE course_modules SET price_in_course=' . $price . ' WHERE id_module=' .
            $idModule . ' and id_course=' . $idCourse)->query();

        $this->redirect(Yii::app()->createUrl('/_teacher/_admin/module/index'));
    }

    public function actionNewModule(){
        var_dump($_POST);die;

    }

    public function actionGetModulesList(){
        echo Module::modulesList();
    }

    public function actionTeachersByQuery($query){
        if ($query) {
            $teachers = Teacher::teachersWithoutAuthorsModule($query);
            echo $teachers;
        } else {
            throw new \application\components\Exceptions\IntItaException('400');
        }    }

    public function actionAddTeacher($id){
        $module = Module::model()->findByPk($id);

        $this->renderPartial('_addTeacher', array(
            'module' =>$module
        ));
    }

    public function actionCheckAlias(){
        $alias = Yii::app()->request->getPost('alias', '');
        if(Module::isAliasUnique($alias)){
           echo "true";
        } else {
            echo "false";
        }
    }
}