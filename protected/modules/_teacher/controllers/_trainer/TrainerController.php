<?php

class TrainerController extends TeacherCabinetController
{

    public function hasRole()
    {
        return Yii::app()->user->model->isTrainer();
    }

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
            $isTeacherDefined = !$role->checkStudent($idModule, $id);
            if ($isTeacherDefined) {
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

        $user = RegisteredUser::userById($teacher);
        $model = $user->registrationData;

        $role = new TeacherConsultant();
        if (!$user->isTeacherConsultant()) {
            echo "Даному співробітнику не призначена роль викладача.";
        } else {
            if ($role->checkModule($teacher, $module)) {
                if ($role->checkStudent($module, $student)) {
                    if ($role->setStudentAttribute($model, $student, $module)) {
                        echo "Операцію успішно виконано.";
                    } else {
                        echo "Операцію не вдалося виконати.";
                    }
                } else {
                    echo "Даного викладача-консультанта вже призначено для цього студента.";
                }
            } else {
                echo "Даний викладач не має прав викладача для обраного модуля.";
            }
        }
    }

    public function actionCancelTeacherForStudent()
    {
        $teacher = Yii::app()->request->getPost('teacher', 0);
        $module = Yii::app()->request->getPost('module', 0);
        $student = Yii::app()->request->getPost('student', 0);

        $model = StudentReg::model()->findByPk($teacher);

        $role = new TeacherConsultant();
        if ($role->checkCancelStudent($model->id, $module, $student)) {
            if ($role->cancelStudentAttribute($model, $student, $module)) {
                echo "Операцію успішно виконано.";
            } else {
                echo "Операцію не вдалося виконати.";
            }
        } else {
            echo "Даному викладача-консультанту не було призначено цього студента.";
        }
    }

    public function actionViewStudent($id)
    {
        $student = RegisteredUser::userById($id);
        $role = new Student();
        $teachersByModule = $role->getTeachersForModules($student->registrationData);

        $this->renderPartial('/_trainer/_viewStudent', array(
            'student' => $student,
            'teachersByModule' => $teachersByModule
        ), false, true);
    }

    public function actionAllTeachersByQuery($query)
    {
        echo Teacher::teachersByQuery($query);
    }

    public function actionTeachersByQuery($query, $module)
    {
        echo Teacher::teachersByQueryAndModule($query, $module);
    }

    public function actionSendResponseConsultantModule($idModule)
    {
        $module = Module::model()->findByPk($idModule);
        if ($module) {
            $this->renderPartial('/_trainer/_sendResponseAssignConsultant', array(
                'module' => $module
            ));
        } else {
            throw new \application\components\Exceptions\IntItaException(400);
        }
    }

    public function actionSendRequest()
    {
        $teacher = Yii::app()->request->getPost('teacher', 0);
        $user = Yii::app()->request->getPost('user', 0);
        $module = Yii::app()->request->getPost('module', 0);

        $teacherModel = StudentReg::model()->findByPk($teacher);
        $moduleModel = Module::model()->findByPk($module);
        $userModel = StudentReg::model()->findByPk($user);

        if ($teacherModel && $moduleModel && $userModel) {
            $message = new MessagesTeacherConsultantRequest();
            if ($message->isRequestOpen(array($moduleModel->module_ID, $teacherModel->id))) {
                echo "Такий запит вже надіслано. Ви не можете надіслати запит на призначення викладача-консультанта для модуля двічі.";
            } else {
                $transaction = Yii::app()->db->beginTransaction();
                try {
                    $message->build($moduleModel, $userModel, $teacherModel);
                    $message->create();
                    $sender = new MailTransport();

                    $message->send($sender);
                    $transaction->commit();
                    echo "Запит на призначення викладача-консультанта модуля успішно відправлено. Зачекайте, поки адміністратор сайта підтвердить запит.";
                } catch (Exception $e) {
                    $transaction->rollback();
                    throw new \application\components\Exceptions\IntItaException(500, "Запит на редагування модуля не вдалося надіслати.");
                }
            }
        } else {
            throw new \application\components\Exceptions\IntItaException(400);
        }
    }
}