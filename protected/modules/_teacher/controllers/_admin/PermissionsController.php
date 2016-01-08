<?php

class PermissionsController extends TeacherCabinetController
{
    public $menu = array();

    public function init()
    {
        parent::init();
        if (Config::getMaintenanceMode() == 1) {
            $this->renderPartial('/default/notice');
            Yii::app()->cache->flush();
            die();
        }
    }

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

    public function actionIndex()
    {
        $model = new PayModules('search');
        if (isset($_GET['Permissions']))
            $model->attributes = $_GET['Permissions'];

        $dataProvider = new CActiveDataProvider('PayModules');

        $dataProvider->setPagination(array(
                'pageSize' => '50',
            )
        );

        if (!isset($_GET['ajax'])) $this->render('index', array(
            'dataProvider' => $dataProvider,
            'model' => $model,
        ), false, true);
        else  $this->renderPartial('index', array(
            'dataProvider' => $dataProvider,
            'model' => $model,
        ),false,true);
    }

    public function actionUserStatus()
    {
        $model = new StudentReg('search');
        $model->unsetAttributes();  // clear any default values

        if (isset($_GET['StudentReg']))
            $model->attributes = $_GET['StudentReg'];

        $this->renderPartial('userStatus', array(
            'model' => $model,
        ),false,true);
    }

    public static function checkPermission($idUser, $idResource, $rights)
    {
        $record = PayModules::model()->findByAttributes(array('id_user' => $idUser,
            'id_module' => $idResource));
        if (is_null($record)) {
            return false;
        } else {
            $mask = PayModules::model()->setFlags($rights);
            if ($record->rights & $mask) {
                return true;
            } else {
                return false;
            }

        }
    }

    public function actionEdit()
    {
        $this->renderPartial('edit');
    }

    public function actionNewPermission()
    {

        $rights = Yii::app()->request->getPost('rights');
        $module = Yii::app()->request->getPost('module');
        $user = Yii::app()->request->getPost('user');

        if (!empty($module)) {
            if (PayModules::model()->exists('id_user=:user and id_module=:resource',
                        array(':user' => $user, ':resource' => $module))) {
                PayModules::model()->updateByPk(array('id_user' => $user,
                    'id_module' => $module), array('rights' => PayModules::setFlags($rights)));
            }
            else {
                Yii::app()->db->createCommand()->insert('pay_modules', array(
                    'id_user' => $user,
                    'id_module' => $module,
                    'rights' => PayModules::setFlags($rights),
                ));
            }
        }
        $this->redirectToIndex(__CLASS__);
    }

    public function actionDelete($id, $resource)
    {
        Yii::app()->db->createCommand()->delete('pay_modules', 'id_user=:id_user AND id_module=:id_resource', array(':id_user' => $id, ':id_resource' => $resource));
        $this->redirectToIndex(__CLASS__);
    }

    public function actionShowLectures()
    {
        $first = '<select size="1" name="lecture">';
        $titleParam = Lecture::getTypeTitleParam();
        $criteria = new CDbCriteria();
        $criteria->select = 'id, ' . $titleParam;
        $criteria->order = 'id ASC';
        $criteria->addCondition('idModule=' . $_POST['module']);
        $rows = Lecture::model()->findAll($criteria);
        $result = $first . '<option value="">Всі лекції</option>
                   <optgroup label="Виберіть лекцію">';
        if (!empty($rows)) {
            foreach ($rows as $numRow => $row) {
                $result = $result . '<option value="' . $row['id'] . '">' . $row['title'] . '</option>';
            };
        }
        $last = '</select>';
        echo $result . $last;
    }

    public function actionShowAttributes()
    {
        $first = '<select size="1" name="attribute">';
        $criteria = new CDbCriteria();
        $criteria->select = 'id, name_ua';
        $criteria->order = 'id ASC';
        $criteria->addCondition('role=' . $_POST['role']);
        $rows = RoleAttribute::model()->findAll($criteria);
        $result = $first . '<option value="">Всі атрибути ролі</option>
                   <optgroup label="Виберіть атрибут">';

        if (!empty($rows)) {
            foreach ($rows as $numRow => $row) {
                $result = $result . '<option value="' . $row['id'] . '">' . $row['name_ua'] . '</option>';
            };
        }
        $last = '</select>';
        $result .= $last;
        echo $result;
    }

    public function actionShowAttributeInput()
    {
        $result = '';
        switch ($_POST['attribute']) {
            case '3':
            case '6':
            case '7':
                $first = '<select name="attributeValue">';
                $result = $first . '<option value="">' . Yii::t('payments', '0606') . '</option>
                <optgroup label="' . Yii::t('payments', '0607') . '">';
                $temp = Module::model()->findAll();
                for ($i = 0; $i < count($temp); $i++) {
                    $result = $result . '<option value="' . $temp[$i]->module_ID . '">' . $temp[$i]->module_number ."  ".
                        $temp[$i]->title_ua ."(".$temp[$i]->language.")". '</option>';
                }
                $last = '</select>';
                $result = $result.$last;
                break;
            case 'user_list':
                break;
            default:
                $result .= "<br><br>Значення атрибута:  <input type='text' value='' name='attributeValue' id='inputValue'>";
                break;
        }
        echo $result;
    }

    public function actionShowModules()
    {
        if(isset($_POST['course']))
            $course = $_POST['course'];

        $result = Module::showModule($course);

        echo $result;
    }

    public function actionNewTeacherPermission()
    {
        $teacherId = Yii::app()->request->getPost('user');
        $teacher = Teacher::model()->findByAttributes(array('teacher_id' => $teacherId));
        $module = Yii::app()->request->getPost('module');

        if($module){
            Teacher::addTeacherAccess($teacher->teacher_id, $module);

            $permission = new PayModules();
            $permission->setModulePermission(
                $teacher->user_id,
                $module,
                array('read', 'edit'));
        }
        $this->redirectToIndex(__CLASS__);
    }

    public function actionAddTeacher()
    {
        $user = Yii::app()->request->getPost('user');
        $user = StudentReg::model()->findByPk($user);
        if ($user->isTeacher()){
            Yii::app()->user->setFlash('warning', "Користувач з таким email вже є викладачем.");
        }
        $user->save();

        $this->redirectToIndex(__CLASS__);
    }

    public function actionSetTeacherRole()
    {
        $request = Yii::app()->request;
        $teacherId = $request->getPost('teacher', 0);
        $roleId = $request->getPost('role', 0);

        $teacher = Teacher::model()->findByPk($teacherId);
        if ($teacherId && $roleId) {
            if ($teacher->setTeacherRole($roleId)) {
                $this->redirect(Yii::app()->createUrl('/_admin/tmanage/index'));
            }
        }
        $this->redirectToIndex(__CLASS__);
    }

    public function actionSetTeacherRoleAttribute()
    {
        $request = Yii::app()->request;
        $teacherId = $request->getPost('teacher', 0);
        $attributeId = $request->getPost('attribute', 0);
        $value = $request->getPost('attributeValue', 0);

        if ($teacherId && $attributeId && $value) {
            $result = false;
            switch ($attributeId) {
                case '2':
                    $result = TrainerStudent::setRoleAttribute($teacherId, $attributeId, $value);
                    break;
                case '3':
                    $result = ConsultantModules::setRoleAttribute($teacherId, $attributeId, $value);
                    break;
                case '4':// leader's projects
                    $result = true;//ConsultantModules::setRoleAttribute($teacherId, $attributeId, $value);
                    break;
                case '6':
                    $result = LeaderModules::setRoleAttribute($teacherId, $attributeId, $value);
                    break;
                case '7':
                    break;
                default:
                    $result = AttributeValue::setRoleAttribute($teacherId, $attributeId, $value);

            }
            if ($result) {
                $this->redirectToIndex(__CLASS__);
            }

        }
        $this->redirect(Yii::app()->request->urlReferrer);
    }

    public function actionSetFreeLessons($id)
    {
        Lecture::model()->updateByPk($id, array('isFree' => 1));

        // if AJAX request, we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(Yii::app()->request->urlReferrer);
    }

    public function actionSetPaidLessons($id)
    {
        Lecture::model()->updateByPk($id, array('isFree' => 0));

        // if AJAX request, we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(Yii::app()->request->urlReferrer);
    }

    public function actionSetUserVerification($id)
    {
        StudentReg::model()->updateByPk($id, array('status' => 1));

        // if AJAX request, we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(Yii::app()->request->urlReferrer);
    }

    public function actionUnsetUserVerification($id)
    {
        StudentReg::model()->updateByPk($id, array('status' => 0));

        // if AJAX request, we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(Yii::app()->request->urlReferrer);
    }

    public function actionShowTeacherModules()
    {
        if (isset($_POST['teacher'])){
            $idTeacher = $_POST['teacher'];


        $result = TeacherModule::showTeacherModule($idTeacher);
        }
        else $result = '';
        echo $result;
    }


    public function actionCancelTeacherPermission()
    {
        $teacher = Yii::app()->request->getPost('teacher');
        $module = Yii::app()->request->getPost('module');

        $userId = Teacher::model()->findByAttributes(array('teacher_id' => $teacher))->user_id;

        TeacherModule::cancelTeacherAccess($teacher, $module);

        $permission = new PayModules();
        $permission->unsetModulePermission(
            $userId,
            $module,
            array('read', 'edit'));

        $this->redirectToIndex(__CLASS__);
    }

    public function actionCancelTeacherRole()
    {
        $teacher = Yii::app()->request->getPost('teacher');
        $role = Yii::app()->request->getPost('role');

        TeacherRoles::model()->deleteAllByAttributes(array('teacher' => $teacher, 'role' => $role));
        $this->redirect('/_admin/tmanage/showRoles?id='.$teacher);
    }

    public function actionShowUsers()
    {
        if(Yii::app()->request->isAjaxRequest)
        {
            if(isset($_POST['email']))
            {
                $email = $_POST['email'];

                $result = StudentReg::model()->findByAttributes(array('email'=>$email));

               if(!empty ($result)){
                   echo $result->id;
               }

                else echo 'not found';
            }
        }
    }

    public function actionShowAddAccessForm()
    {
        $users = StudentReg::generateUsersList();
        $courses = Course::generateCoursesList();

        $this->renderPartial('_add',array(
            'users' => $users,
            'courses' => $courses
        ),false,true);
    }

    public function actionShowAddTeacherAccess()
    {
        $users = Teacher::generateTeachersList();
        $courses = Course::generateCoursesList();

        $this->renderPartial('_addTeacherAccess',array(
            'users' => $users,
            'courses' => $courses
        ),false,true);
    }

    public function actionShowCancelTeacherAccess()
    {
        $users = Teacher::generateTeachersList();

        $this->renderPartial('_cancelTeacherAccess',array(
            'users' => $users
        ),false,true);
    }

}