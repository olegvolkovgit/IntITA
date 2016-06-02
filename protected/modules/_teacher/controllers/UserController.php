<?php

class UserController extends TeacherCabinetController {

    public function hasRole(){
        return Yii::app()->user->model->isAdmin() || Yii::app()->user->model->isTrainer();
    }

    public function actionIndex($id)
    {
        $model = RegisteredUser::userById($id);
        $trainer = TrainerStudent::getTrainerByStudent($id);

        $this->renderPartial('index', array(
            'model' => $model,
            'trainer' => $trainer
        ), false, true);
    }

    public function actionAddRole($id){
        $model = RegisteredUser::userById($id);
        $roles = array_diff(AllRolesDataSource::roles(), $model->getRoles());

        $this->renderPartial('addUserRole', array(
            'model' => $model,
            'roles' => $roles
        ), false, true);
    }

    public function actionChangeAccountStatus(){
        $user = Yii::app()->request->getPost('user', '0');
        $model = StudentReg::model()->findByPk($user);
        if($model){
            if($model->changeAccountStatus()){
                echo "Операцію успішно виконано.";
            } else {
                echo "Операцію не вдалося виконати. Зверніться до адміністратора ".Config::getAdminEmail();
            }
        } else {
            echo "Неправильний запит. Такого користувача не існує.";
        }
    }

    public function actionChangeUserStatus(){
        $user = Yii::app()->request->getPost('user', '0');
        $model = StudentReg::model()->findByPk($user);
        if($model){
            if($model->changeUserStatus()){
                echo "Операцію успішно виконано.";
            } else {
                echo "Операцію не вдалося виконати. Зверніться до адміністратора ".Config::getAdminEmail();
            }
        } else {
            echo "Неправильний запит. Такого користувача не існує.";
        }
    }

    public function actionUnsetUserRole(){
        $user = Yii::app()->request->getPost('user', '0');
        $role = Yii::app()->request->getPost('role', '');
        if($user && $role){
            $model = RegisteredUser::userById($user);
            $roleModel = Role::getInstance($role);
            if(!$roleModel->checkBeforeDeleteRole($model->registrationData)){
                echo $roleModel->getErrorMessage();
            } else {
                if ($model->cancelRole(new UserRoles($role))) {
                    echo "Обрану роль успішно скасовано.";
                } else {
                    echo "Роль не вдалося скасувати.";
                }
            }
        } else {
            echo "Неправильний запит. Зверніться до адміністратора ".Config::getAdminEmail();
        }
    }

    public function actionAgreement($user, $param, $type){
        switch($type){
            case "module":
                $model = UserAgreements::moduleAgreement($user, $param, 1, EducationForm::ONLINE);
                break;
            case "course":
                $model = UserAgreements::courseAgreement($user, $param, 1, EducationForm::ONLINE);
                break;
            default:
                throw new \application\components\Exceptions\IntItaException(400);
        }
        if($model){
            $this->renderPartial('/_student/_agreement', array(
                'agreement' => $model,
            ));
        } else {
            throw new \application\components\Exceptions\IntItaException(400);
        }
    }

    public function actionSetUserRole()
    {
        $id = Yii::app()->request->getPost('user', 0);
        $role = Yii::app()->request->getPost('role', '');

        $user = RegisteredUser::userById($id);

        if(!$user->registrationData->isActive()){
            echo "Акаунт користувача заблокований. Заблокованому користувачу не можна призначити роль.";
            die;
        }
        if ($id && $role) {
            if($role != UserRoles::STUDENT){
                if(!$user->isTeacher()){
                    echo "Користувач не є співробітником, призначити йому вибрану роль неможливо.";
                    die;
                }
            }
            if ($user->setRole(new UserRoles($role))) {
                echo "Операцію успішно виконано.";
            } else {
                echo "Операцію не вдалося виконати.";
            }
        } else {
            throw new \application\components\Exceptions\IntItaException(400, "Неправильний запит.");
        }
    }
}