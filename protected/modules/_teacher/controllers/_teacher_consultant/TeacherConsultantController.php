<?php

class TeacherConsultantController extends TeacherCabinetController
{
    public function actionAssignModule(){
        $userId = Yii::app()->request->getPost('userId', 0);
        $module = Yii::app()->request->getPost('module', 0);

        if($userId && $module){
            $user = RegisteredUser::userById($userId);
            $role = Role::getInstance(UserRoles::TEACHER_CONSULTANT);
            if($role->checkModule($userId, $module)){
                if($user->setRoleAttribute(UserRoles::TEACHER_CONSULTANT, 'module', $module)){
                    echo "Викладача для модуля успішно призначено.";
                    Yii::app()->end();
                } else {
                    echo "Операцію не вдалося виконати.";
                    Yii::app()->end();
                }
            } else {
                echo "Даний викладач вже має права консультанта для обраного модуля.";
                Yii::app()->end();
            }
        }
    }

    public function actionShowTeacherPlainTaskList()
    {
        $idTeacher = Yii::app()->request->getPost('idTeacher', 0);
        if ($idTeacher == 0) {
            throw new \application\components\Exceptions\IntItaException(400, 'Неправильний запит.');
        }

        $tasksList = PlainTaskAnswer::plainTaskListByTeacher($idTeacher);

        return $this->renderPartial('/_teacher_consultant/teacherPlainTaskList', array(
            'teacherPlainTasks' => $tasksList,
        ));
    }

    public function actionModules($id){
        $user = RegisteredUser::userById($id);
        $modules = $user->getAttributesByRole(UserRoles::TEACHER_CONSULTANT)[0];

        return $this->renderPartial('/_teacher_consultant/_modules', array(
            'modules' => $modules,
        ));
    }

    public function actionStudents($id){
        $user = RegisteredUser::userById($id);
        $students = $user->getAttributesByRole(UserRoles::TEACHER_CONSULTANT)[1];

        return $this->renderPartial('/_teacher_consultant/_students', array(
            'students' => $students,
        ));
    }
}