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
        $model = new Permissions('search');
        if(isset($_GET['Permissions']))
            $model->attributes=$_GET['Permissions'];

		$dataProvider = new CActiveDataProvider('Permissions');

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
        $record = Permissions::model()->findByAttributes(array('id_user' => $idUser,
            'id_resource' => $idResource));
        if (is_null($record)) {
            return false;
        } else {
            $mask = Permissions::model()->setFlags($rights);
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

        if(isset($_POST['lecture'])) {
            if (Permissions::model()->exists('id_user=:user and id_resource=:resource', array(':user' => $_POST['user'], ':resource' => $_POST['lecture']))) {
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
                Permissions::model()->updateByPk(array('id_user' => $_POST['user'], 'id_resource' => $_POST['lecture']), array('rights' => Permissions::setFlags($rights)));
            } else {
                $user = Yii::app()->db->createCommand()->insert('permissions', array(
                    'id_user' => $_POST['user'],
                    'id_resource' => $_POST['lecture'],
                    'rights' => Permissions::setFlags($rights),
                ));
            }
        }
        $this->redirect(Yii::app()->request->urlReferrer);
        //$this->actionIndex();
    }

    public function actionDelete($id, $resource){
        $result = Yii::app()->db->createCommand()->delete('permissions', 'id_user=:id_user AND id_resource=:id_resource', array(':id_user'=>$id, ':id_resource'=>$resource));

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

    public function actionShowModules(){
        $first = '<select name="module" onchange="javascript:selectLecture();">';
        $criteria = new CDbCriteria();
        $criteria->select = 'module_ID, module_name';
        $criteria->order = '`order` ASC';
        $criteria->addCondition('course='.$_POST['course']);
        $rows = Module::model()->findAll($criteria);
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
        $module = Yii::app()->request->getPost('module');
        TeacherModule::addTeacherAccess($teacher, $module);
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
}