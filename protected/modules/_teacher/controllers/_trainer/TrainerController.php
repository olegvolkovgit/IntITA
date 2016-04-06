<?php

class TrainerController extends TeacherCabinetController
{
    public function actionStudents($id, $filter = "")
    {
        $trainer = RegisteredUser::userById($id);
        $students = $trainer->getAttributesByRole(UserRoles::TRAINER)[0];

        $this->renderPartial('/_trainer/_students', array(
            'attribute' => $students,
            'user' => $trainer
        ), false, true);
    }

    public function actionEditTeacherModule($id, $idModule)
    {
        $student = RegisteredUser::userById($id);
        $module = Module::model()->findByPk($idModule);
        if ($id && $idModule) {
            $role = new TeacherConsultant();
            $isTeacherDefined = !$role->checkStudent(Yii::app()->user->getId(), $idModule, $id);
            if($isTeacherDefined){
                $role = new Student();
                $teacher = $role->getTeacherForModuleDefined($id, $idModule);
            } else {
                $teacher = null;
            }

            $this->renderPartial('/_trainer/_editTeacherModule', array(
                'student' => $student->registrationData,
                'module' => $module,
                'isTeacherDefined' => $isTeacherDefined,
                'teacher' => $teacher
            ), false, true);
        } else {
            throw new \application\components\Exceptions\IntItaException(400);
        }
    }

    public function actionEditTeacherCourse($id, $idCourse)
    {
        $student = RegisteredUser::userById($id);
        $course = Course::model()->findByPk($idCourse);

        $this->renderPartial('/_trainer/_editTeacherCourse', array(
            'student' => $student->registrationData,
            'course' => $course,
        ), false, true);
    }

    public function actionAssignTeacherForStudent()
    {
        $teacher = Yii::app()->request->getPost('teacher', 0);
        $module = Yii::app()->request->getPost('module', 0);
        $student = Yii::app()->request->getPost('student', 0);

        $model = StudentReg::model()->findByPk($teacher);

        $role = new TeacherConsultant();
        if ($role->checkStudent($model->id, $module, $student)) {
            if ($role->setStudentAttribute($model, $student, $module)) {
                echo "Операцію успішно виконано.";
            } else {
                echo "Операцію не вдалося виконати.";
            }
        } else {
            echo "Даного викладача-консультанта вже призначено для цього студента.";
        }
    }

    public function actionCancelTeacherForStudent()
    {
        $teacher = Yii::app()->request->getPost('teacher', 0);
        $module = Yii::app()->request->getPost('module', 0);
        $student = Yii::app()->request->getPost('student', 0);

        $model = StudentReg::model()->findByPk($teacher);

        $role = new TeacherConsultant();
        if ($role->checkStudent($model->id, $module, $student)) {
            if ($role->cancelStudentAttribute($model, $student, $module)) {
                echo "Операцію успішно виконано.";
            } else {
                echo "Операцію не вдалося виконати.";
            }
        } else {
            echo "Даного викладача-консультанта вже призначено для цього студента.";
        }
    }

    public function actionViewStudent($id)
    {
        $student = RegisteredUser::userById($id);

        $this->renderPartial('/_trainer/_viewStudent', array(
            'student' => $student,
        ), false, true);
    }

    public function actionTeachersByQuery($query, $module)
    {
        echo Teacher::teachersByQueryAndModule($query, $module);
    }

    public function actionTeacherConsultantsByQuery($query, $module)
    {
        echo Teacher::teacherConsultantsByQueryAndModule($query, $module);
    }

    public function actionAddConsultantModule($idModule)
    {
        $module = Module::model()->findByPk($idModule);

        $this->renderPartial('/_trainer/_consultantModule', array(
            'module' => $module,
        ), false, true);
    }
}