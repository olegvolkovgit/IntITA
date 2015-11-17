<?php

class PermissionsController extends AdminController
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

//    public function accessRules()
//    {
//        return array(
//            array('allow',
//                'actions' => array('delete', 'create', 'edit', 'newPermission', 'index', 'admin', 'showLectures',
//                    'newTeacherPermission', 'addTeacher', 'SetPaidLessons', 'SetFreeLessons', 'freeLessons',
//                    'userStatus', 'cancelTeacherRole','showAttributes','showAttributeInput','showModules'),
//                'expression' => array($this, 'isAdministrator'),
//            ),
//            array('deny',
//                'message' => "У вас недостатньо прав для перегляду та редагування сторінки.
//                Для отримання доступу увійдіть з логіном адміністратора сайту.",
//                'actions' => array('delete', 'create', 'edit', 'newPermission', 'index', 'admin', 'showLectures',
//                    'newTeacherPermission', 'addTeacher', 'SetPaidLessons', 'SetFreeLessons', 'freeLessons',
//                    'userStatus', 'cancelTeacherRole'),
//                'users' => array('*'),
//            ),
//        );
//    }

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
        ));
    }

    public function actionFreeLessons()
    {
        $model = new Lecture('search');
        $model->unsetAttributes();  // clear any default values

        if (isset($_GET['Lecture']))
            $model->attributes = $_GET['Lecture'];

        $this->render('_freeLectures', array(
            'model' => $model,
        ));
    }

    public function actionUserStatus()
    {
        $model = new StudentReg('search');
        $model->unsetAttributes();  // clear any default values

        if (isset($_GET['StudentReg']))
            $model->attributes = $_GET['StudentReg'];

        $this->render('userStatus', array(
            'model' => $model,
        ));
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
        $this->render('edit');
    }

    public function actionNewPermission()
    {
        $rights = [];
        if (isset($_POST['read'])) {
            array_push($rights, 'read');
        }
        if (isset($_POST['edit'])) {
            array_push($rights, 'edit');
        }
        if (isset($_POST['create'])) {
            array_push($rights, 'create');
        }
        if (isset($_POST['delete'])) {
            array_push($rights, 'delete');
        }

        if (!empty($_POST['module'])) {
            if (PayModules::model()->exists('id_user=:user and id_module=:resource', array(':user' => $_POST['user'], ':resource' => $_POST['module']))) {
                PayModules::model()->updateByPk(array('id_user' => $_POST['user'], 'id_module' => $_POST['module']), array('rights' => PayModules::setFlags($rights)));
            } else {
                $user = Yii::app()->db->createCommand()->insert('pay_modules', array(
                    'id_user' => $_POST['user'],
                    'id_module' => $_POST['module'],
                    'rights' => PayModules::setFlags($rights),
                ));
            }
        }
        $this->redirect(Yii::app()->request->urlReferrer);
    }

    public function actionDelete($id, $resource)
    {
        $result = Yii::app()->db->createCommand()->delete('pay_modules', 'id_user=:id_user AND id_module=:id_resource', array(':id_user' => $id, ':id_resource' => $resource));
        $this->actionIndex();
    }

    public function actionShowLectures()
    {
        $first = '<select size="1" name="lecture">';
        $titleParam = LectureHelper::getTypeTitleParam();
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
        $teacher = Yii::app()->request->getPost('user');
        $userId = Teacher::model()->findByAttributes(array('teacher_id' => $teacher))->user_id;
        $module = Yii::app()->request->getPost('module');
        TeacherModule::addTeacherAccess($teacher, $module);
        $permission = new PayModules();
        $permission->setModulePermission(
            $userId,
            $module,
            array('read', 'edit'));
        $this->redirect(Yii::app()->request->urlReferrer);
    }

    public function actionAddTeacher()
    {
        $user = Yii::app()->request->getPost('user');
        $role = StudentReg::model()->findByPk($user)->role;
        switch ($role) {
            case '0':
                StudentReg::model()->updateByPk($user, array('role' => 1));
                break;
            case '1':
                Yii::app()->user->setFlash('warning', "Користувач з таким email вже є викладачем.");
                break;
            case '2':
                Yii::app()->user->setFlash('warning', "Користувач з таким email вже є модератором.");
                break;
            case '3':
                Yii::app()->user->setFlash('warning', "Користувач з таким email вже є адміністратором.");
                break;
            default:
                StudentReg::model()->updateByPk($user, array('role' => 1));
                break;
        }
        $this->redirect(Yii::app()->request->urlReferrer);
    }

    public function actionSetTeacherRole()
    {

        $request = Yii::app()->request;
        $teacherId = $request->getPost('teacher', 0);
        $roleId = $request->getPost('role', 0);

        if ($teacherId && $roleId) {
            if (TeacherRoles::setTeacherRole($teacherId, $roleId)) {

                $this->redirect(Yii::app()->createUrl('/_admin/tmanage/index'));
            }
        }
        $this->redirect(Yii::app()->request->urlReferrer);
    }

    public function actionSetTeacherRoleAttribute()
    {

        $request = Yii::app()->request;
        $teacherId = $request->getPost('teacher', 0);
        $roleId = $request->getPost('role', 0);
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
                $this->redirect(Yii::app()->createUrl('/_admin/tmanage/index'));
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
        if (isset($_POST['teacher']))
            $idTeacher = $_POST['teacher'];

        $result = TeacherModule::showTeacherModule($idTeacher);

        echo $result;
    }


    public function actionCancelTeacherPermission()
    {
        $teacher = Yii::app()->request->getPost('teacher');
        $userId = Teacher::model()->findByAttributes(array('teacher_id' => $teacher))->user_id;

        $module = Yii::app()->request->getPost('module1');
        TeacherModule::cancelTeacherAccess($teacher, $module);

        $permission = new PayModules();
        $permission->unsetModulePermission(
            $userId,
            $module,
            array('read', 'edit'));

        $this->redirect(Yii::app()->request->urlReferrer);
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

               if(!empty ($result))
               echo $result->id;

                else return false;
            }
        }
    }
}