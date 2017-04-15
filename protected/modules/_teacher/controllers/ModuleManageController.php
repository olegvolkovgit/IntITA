<?php

class ModuleManageController extends TeacherCabinetController
{
    public function hasRole(){
        $allowedViewActions=['modulesList', 'view', 'getModulesList','getModuleAuthorsList','getModuleTeachersConsultantList'];
        return Yii::app()->user->model->isContentManager() ||
            Yii::app()->user->model->isAdmin() && !in_array(Yii::app()->controller->action->id,['modulesList', 'getModulesList']) ||
            (Yii::app()->user->model->isDirector() || Yii::app()->user->model->isSuperAdmin() && in_array(Yii::app()->controller->action->id,$allowedViewActions));
    }

    public function actionIndex($id=0)
    {
        $this->renderPartial('index', array(), false, true);
    }

    public function actionModulesList()
    {
        $this->renderPartial('index', array('organization'=>false), false, true);
    }

    public function actionOrganizationModulesList()
    {
        $this->renderPartial('index', array('organization'=>true), false, true);
    }

    public function actionCreate()
    {
        $model = new Module;
        $this->performAjaxValidation($model);

        if (isset($_POST['Module'])) {
            if (isset($_POST['moduleTags'])) {
                $moduleTags = $this->stdToArray(json_decode($_POST['moduleTags']));
            }else $moduleTags=null;

            $model->attributes = $_POST['Module'];
            if ($model->alias) $model->alias = str_replace(" ", "_", $model->alias);
            if ($model->save()) {
                if(!file_exists(Yii::app()->basePath . "/../content/module_".$model->module_ID)){
                    mkdir(Yii::app()->basePath . "/../content/module_".$model->module_ID);
                }
                if (!empty($_FILES['Module']['name']['module_img'])) {
                    $imageName = array_shift($_FILES['Module']['name']);
                    $tmpName = array_shift($_FILES['Module']['tmp_name']);
                    if ($imageName && $tmpName) {
                        if (!Avatar::updateModuleAvatar($imageName, $tmpName, $model->module_ID))
                            throw new \application\components\Exceptions\IntItaException(400, 'Avatar not save');
                    }
                } else {
                    Module::model()->updateByPk($model->module_ID, array('module_img' => 'module.png'));
                }
                ModuleTags::model()->editModuleTags($moduleTags,$model->module_ID);
                Yii::app()->end();
            } else {
                throw new \application\components\Exceptions\IntItaException(400, 'Модуль не вдалося створити. Перевірте вхідні дані або зверніться до адміністратора.');
            }
        }

        $this->renderPartial('create', array(
            'model' => $model
        ), false, true);
    }

    private function stdToArray($obj){
        $rc = (array)$obj;
        foreach($rc as $key => &$field){
            if(is_object($field))$field = $this->stdToArray($field);
        }
        return $rc;
    }

    public function actionDelete($id)
    {
        if (CourseModules::getCoursesListName($id) == false) {
            $module = Module::model()->findByPk($id);
            Yii::app()->user->model->hasAccessToOrganizationModel($module);
            $module->cancelled=Module::DELETED;
            $module->save();
            echo "Модуль успішно видалено.";
        } else {
            echo "Модуль не можна видалити, він входить до складу таких курсів: ".
                implode(", ", CourseModules::getCoursesListName($id)).".";
        }
    }

    public function actionRestore($id)
    {
        $module = Module::model()->findByPk($id);
        Yii::app()->user->model->hasAccessToOrganizationModel($module);
        $module->cancelled=Module::ACTIVE;
        if($module->save())
            echo "Модуль успішно відновлено.";
        else echo "Модуль не вдалося відновити.";
    }

    public function actionView($id)
    {
        $model = Module::model()->with('lectures', 'inCourses')->findByPk($id);
        $courses = CourseModules::model()->with('course')->findAllByAttributes(array('id_module' => $id));
        $authors = TeacherModule::listByModule($model->module_ID);
        $teacherConsultants = $model->teacherConsultants();

        $this->renderPartial('view', array(
            'model' => $model,
            'authors' => $authors,
            'courses' => $courses,
            'teacherConsultants' => $teacherConsultants
        ), false, true);
    }

    public function actionUpdate($id)
    {
        $model = Module::model()->findByPk($id);
        Yii::app()->user->model->hasAccessToOrganizationModel($model);
        $courses = CourseModules::model()->with('course')->findAllByAttributes(array('id_module' => $id));

        $this->performAjaxValidation($model);

        if (isset($_POST['Module'])) {
            if($model->id_organization!=Yii::app()->user->model->getCurrentOrganization()->id)
                throw new \application\components\Exceptions\IntItaException(403, 'У тебе немає доступу редагувати модуль в межах цієї організації');

            if (isset($_POST['moduleTags'])) {
                $moduleTags = $this->stdToArray(json_decode($_POST['moduleTags']));
            }else $moduleTags=null;

            $model->oldLogo = $model->module_img;
            $model->attributes = $_POST['Module'];
            if ($model->alias) $model->alias = str_replace(" ", "_", $model->alias);
            if (!empty($_FILES['Module']['name']['module_img'])) {
                $imageName = array_shift($_FILES['Module']['name']);
                $tmpName = array_shift($_FILES['Module']['tmp_name']);
                if (!empty($imageName)) {
                    if (!empty($imageName)) {
                        $model->logo = $_FILES['Module'];
                        if ($model->save()) {
                            if ($imageName && $tmpName) {
                                if (!Avatar::updateModuleAvatar($imageName, $tmpName, $id, $model->oldLogo))
                                    throw new \application\components\Exceptions\IntItaException(500, 'Аватар не був збережений.');
                            }
                        } else {
                            throw new \application\components\Exceptions\IntItaException(400, 'Модуль не вдалося відредагувати. Перевірте вхідні дані або зверніться до адміністратора.');
                        }
                    }
                }
            } else {
                if ($model->save()) {
                    if (!Module::model()->updateByPk($id, array('module_img' => $model->oldLogo))) {
                        Module::model()->updateByPk($id, array('module_img' => 'module.png'));
                    }
                }
            }
            ModuleTags::model()->editModuleTags($moduleTags,$model->module_ID);
            Yii::app()->end();
        }
        $authors = TeacherModule::listByModule($model->module_ID);
        $teacherConsultants = $model->teacherConsultants();

        $this->renderPartial('update', array(
            'model' => $model,
            'authors' => $authors,
            'courses' => $courses,
            'teacherConsultants' => $teacherConsultants
        ), false, true);
    }

    public function actionMandatory($id, $course)
    {
        $courseModel = Course::model()->findByPk($course);
        $module = Module::model()->findByPk($id);
        Yii::app()->user->model->hasAccessToOrganizationModel($courseModel);
        Yii::app()->user->model->hasAccessToOrganizationModel($module);
        $this->renderPartial('mandatory', array(
            'module' => $module,
            'course' => $courseModel
        ), false, true);
    }

    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'module-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionAddMandatoryModule()
    {
        $idModule = Yii::app()->request->getPost('module', 0);
        $idCourse = Yii::app()->request->getPost('course', 0);
        $mandatory = Yii::app()->request->getPost('mandatory', -1);
        $courseModel = Course::model()->findByPk($idCourse);
        $module = Module::model()->findByPk($idModule);
        Yii::app()->user->model->hasAccessToOrganizationModel($courseModel);
        Yii::app()->user->model->hasAccessToOrganizationModel($module);

        if($mandatory == 0) $mandatory = "NULL";
        if ($idModule && $idCourse && $mandatory != -1) {
            if(!Module::checkMandatoryModule($idCourse,$idModule,$mandatory)){
                echo "Задати модуль не вдалося, оскільки виникає конфлікт послідовностей. Перевірте послідовності і спробуйте ще раз."; return;
            }
            if (Yii::app()->db->createCommand('UPDATE course_modules SET mandatory_modules=' . $mandatory . ' WHERE id_module=' .
                $idModule . ' and id_course=' . $idCourse)->query()
            ) {
                echo "Операцію успішно виконано.";
            } else {
                echo "Операцію не вдалося виконати.";
            }
        } else {
            echo "Неправильний запит.";
        }
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

    public function actionGetModulesList()
    {
        $adapter = new NgTableAdapter('Module',$_GET);
        echo json_encode($adapter->getData());
    }

    public function actionGetOrganizationModulesList()
    {
        $adapter = new NgTableAdapter('Module',$_GET);
        $criteria =  new CDbCriteria();
        $criteria->condition = 'id_organization='.Yii::app()->user->model->getCurrentOrganization()->id;
        $adapter->mergeCriteriaWith($criteria);
        echo json_encode($adapter->getData());
    }

    public function actionGetModuleAuthorsList()
    {
        $requestParams = $_GET;
        $ngTable = new NgTableAdapter('TeacherModule', $requestParams);
        $criteria =  new CDbCriteria();
        $criteria->condition = 'idModule='.$requestParams['idModule'];
        $ngTable->mergeCriteriaWith($criteria);

        $result = $ngTable->getData();
        echo json_encode($result);
    }

    public function actionGetModuleTeachersConsultantList()
    {
        $requestParams = $_GET;
        $ngTable = new NgTableAdapter('TeacherConsultantModule', $requestParams);
        $criteria =  new CDbCriteria();
        $criteria->condition = 'id_module='.$requestParams['idModule'];
        $ngTable->mergeCriteriaWith($criteria);
        $result = $ngTable->getData();
        echo json_encode($result);
    }

    public function actionTeachersByQuery($query)
    {
        echo Teacher::teachersByQuery($query);
    }

    public function actionAddAuthor()
    {
        $this->renderPartial('_addAuthor', array());
    }

    public function actionAddTeacherConsultant()
    {
        $this->renderPartial('_addTeacherConsultant', array());
    }

    public function actionCheckAlias()
    {
        $alias = Yii::app()->request->getPost('alias', '');
        if (Module::isAliasUnique($alias)) {
            echo "true";
        } else {
            echo "false";
        }
    }
}