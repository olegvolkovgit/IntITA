<?php

class TeacherConsultantController extends TeacherCabinetController
{
    public function hasRole(){
        return Yii::app()->user->model->isTeacherConsultant();
    }

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

    public function actionShowTeacherPlainTaskList($idTeacher)
    {
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
        $role = new TeacherConsultant();
        $modules = $role->activeModules($user->registrationData);

        return $this->renderPartial('/_teacher_consultant/_modules', array(
            'modules' => $modules,
        ));
    }

    public function actionStudents($id){
        $user = StudentReg::model()->findByPk($id);
        if(!$user){
            throw new \application\components\Exceptions\IntItaException(400);
        }
        $role = new TeacherConsultant();
        $students = $role->activeStudents($user);

        return $this->renderPartial('/_teacher_consultant/_students', array(
            'students' => $students,
        ));
    }

    public function actionShowPlainTask($idPlainTask)
    {
        if ($idPlainTask == 0) {
            throw new \application\components\Exceptions\IntItaException(400, 'Такої задачі не знайдено.');
        }

        $plainTask = PlainTaskAnswer::model()->findByPk($idPlainTask);
        if (!$plainTask) {
            throw new \application\components\Exceptions\IntItaException(400, 'Такої задачі не знайдено.');
        }

        $idModule=$plainTask->plainTask->lectureElement->lecture->idModule;
        $idStudent=$plainTask->id_student;
        $sqlModule="SELECT COUNT(*) FROM `teacher_consultant_module` where id_teacher=".Yii::app()->user->getId()." 
        and id_module=".$idModule." and end_date IS NULL";
        $sqlStudent="SELECT COUNT(*) FROM `teacher_consultant_student` where id_teacher=".Yii::app()->user->getId()." 
        and id_student=".$idStudent." and id_module=".$idModule." and end_date IS NULL";
        $module = Yii::app()->db->createCommand($sqlModule)->queryScalar();
        $student = Yii::app()->db->createCommand($sqlStudent)->queryScalar();

        if ($module==0 || $student==0) {
            throw new \application\components\Exceptions\IntItaException(403, 'Переглядати задачу заборонено');
        }

        return $this->renderPartial('/_teacher_consultant/showPlainTask', array(
            'plainTask' => $plainTask
        ), false, true);
    }

    public function actionMarkPlainTask()
    {
        $plainTaskId = Yii::app()->request->getPost('idPlainTask');
        $mark = Yii::app()->request->getPost('mark');
        $comment = Yii::app()->request->getPost('comment');
        $userId = Yii::app()->request->getPost('userId');

        if (!PlainTaskMarks::saveMark($plainTaskId, $mark, $comment, $userId))
            throw new \application\components\Exceptions\IntItaException(503, 'Ваша оцінка не записана в базу даних.
            Спробуйте пізніше або повідомте адміністратора.');
    }
}