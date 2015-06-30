<?php

class PermissionsController extends Controller
{
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
                'actions'=>array('delete', 'create', 'edit', 'newPermission', 'index', 'admin', 'showLectures',
                    'newTeacherPermission', 'addTeacher'),
                'expression'=>array($this, 'isAdministrator'),
            ),
            array('deny',
                'message'=>"У вас недостатньо прав для перегляду та редагування сторінки.
                Для отримання доступу увійдіть з логіном адміністратора сайту.",
                'actions'=>array('delete', 'create', 'edit', 'newPermission', 'index', 'admin', 'showLectures',
                    'newTeacherPermission', 'addTeacher'),
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

    public function actionIndex()
	{
        $model = new PayModules('search');
        if(isset($_GET['Permissions']))
            $model->attributes=$_GET['Permissions'];

		$dataProvider = new CActiveDataProvider('PayModules');

        $dataProvider->setPagination(array(
                'pageSize' => '50',
            )
        );

        if(!isset($_GET['ajax'])) $this->render('index', array(
            'dataProvider' => $dataProvider,
            'model' => $model,
        ));
        else  $this->renderPartial('index', array(
            'dataProvider' => $dataProvider,
            'model' => $model,
        ));
	}

    public static function checkPermission($idUser, $idResource, $rights){
        $record = PayModules::model()->findByAttributes(array('id_user' => $idUser,
            'id_module' => $idResource));
        if (is_null($record)) {
            return false;
        } else {
            $mask = PayModules::model()->setFlags($rights);
            if ($record->rights & $mask){
                return true;
            }else {
                return false;
            }

        }
    }

    public function actionEdit(){
        $this->render('edit');
    }

    public function actionNewPermission(){
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

        if(!empty($_POST['module'])) {
            if (PayModules::model()->exists('id_user=:user and id_module=:resource', array(':user' => $_POST['user'], ':resource' => $_POST['module']))) {
//                $permissionToBeChanged = Permissions::model()->findByPk(array('id_user'=>$_POST['user'],
//                                                                            'id_resource'=>$_POST['lecture']));
//                $permissionToBeChanged->rights = Permissions::setFlags($rights);
//                var_dump($permissionToBeChanged);
//                if($permissionToBeChanged->save(false))
//                {
//                    var_dump("True");
//                }
//                else
//                {
//                    var_dump($permissionToBeChanged->getErrors());
//                }
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
        //$this->actionIndex();
    }

    public function actionDelete($id, $resource){
        $result = Yii::app()->db->createCommand()->delete('pay_modules', 'id_user=:id_user AND id_module=:id_resource', array(':id_user'=>$id, ':id_resource'=>$resource));

        $this->actionIndex();
    }

    public function actionShowLectures(){
        $first = '<select size="1" name="lecture">';
        $criteria = new CDbCriteria();
        $criteria->select = 'id, title';
        $criteria->order = 'id ASC';
        $criteria->addCondition('idModule='.$_POST['module']);
        $rows = Lecture::model()->findAll($criteria);
        $result = $first.'<option value="">Всі лекції</option>
                   <optgroup label="Виберіть лекцію">';
        if(!empty($rows)) {
            foreach ($rows as $numRow => $row) {
                $result = $result . '<option value="' . $row['id'] . '">' . $row['title'] . '</option>';
            };
        }
        $last = '</select>';
        echo $result.$last;
    }

    public function actionShowAttributes(){
        $first = '<select size="1" name="attribute">';
        $criteria = new CDbCriteria();
        $criteria->select = 'id, name_ua';
        $criteria->order = 'id ASC';
        $criteria->addCondition('role='.$_POST['role']);
        $rows = RoleAttribute::model()->findAll($criteria);
        $result = $first.'<option value="">Всі атрибути ролі</option>
                   <optgroup label="Виберіть атрибут">';
        if(!empty($rows)) {
            foreach ($rows as $numRow => $row) {
                $result = $result . '<option value="' . $row['id'] . '">' . $row['name_ua'] . '</option>';
            };
        }
        $last = '</select>';
        $result .= $last;
        $result .= "<br><br>Значення атрибута:  <input type='text' value='' name='attributeValue' id='inputValue'>";
        echo $result;
    }

    public function actionShowModules(){
        $first = '<select name="module">';

        $modulelist = [];

        $criteria= new CDbCriteria;
        $criteria->alias = 'course_modules';
        $criteria->select = 'id_module';
        $criteria->order = '`order` ASC';
        $criteria->addCondition('id_course='.$_POST['course']);
        $temp = CourseModules::model()->findAll($criteria);
        for($i = 0; $i < count($temp);$i++){
            array_push($modulelist, $temp[$i]->id_module);
        }

        $criteriaData= new CDbCriteria;
        $criteriaData->alias = 'module';
        $criteriaData->addInCondition('module_ID', $modulelist, 'OR');

        $rows = Module::model()->findAll($criteriaData);
        $result = $first.'<option value="">Всі модулі</option>
                   <optgroup label="Виберіть модуль">';
        foreach ($rows as $numRow => $row) {
            $result = $result.'<option value="'.$row['module_ID'].'">'.$row['module_name'].'</option>';
        };
        $last = '</select>';
        echo $result.$last;
    }

    public function actionNewTeacherPermission(){
        $teacher = Yii::app()->request->getPost('user');
        $userId = Teacher::model()->findByAttributes(array('teacher_id' => $teacher))->user_id;
        $module = Yii::app()->request->getPost('module');
        TeacherModule::addTeacherAccess($teacher, $module);
        $permission = new PayModules();
        $permission->setModulePermission(
            $userId,
            $module,
            array('read', 'edit'));
        //$this->actionIndex();
        $this->redirect(Yii::app()->request->urlReferrer);
    }

    public function actionAddTeacher(){
        $user = Yii::app()->request->getPost('user');
        $role = StudentReg::model()->findByPk($user)->role;
        switch($role){
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

    public function actionSetTeacherRole(){

        $request = Yii::app()->request;
        $teacherId = $request->getPost('teacher', 0);
        $roleId = $request->getPost('role', 0);
        if ($teacherId && $roleId){
            if (TeacherRoles::setTeacherRole($teacherId, $roleId)){
                $this->redirect(Yii::app()->createUrl('tmanage/index'));
            }
        }
        $this->redirect(Yii::app()->request->urlReferrer);
    }

    public function actionSetTeacherRoleAttribute(){

        $request = Yii::app()->request;
        $teacherId = $request->getPost('teacher', 0);
        $roleId = $request->getPost('role', 0);
        $attributeId = $request->getPost('attribute', 0);
        $value = $request->getPost('attributeValue', 0);

        if ($teacherId && $attributeId && $value){
            $result = false;
            switch($attributeId){
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
            if ($result){
                $this->redirect(Yii::app()->createUrl('tmanage/index'));
            }

        }
        $this->redirect(Yii::app()->request->urlReferrer);
    }
}