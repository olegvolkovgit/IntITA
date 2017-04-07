<?php

class TrainerController extends TeacherCabinetController
{

    public function hasRole()
    {
        return Yii::app()->user->model->isTrainer();
    }

    public function actionStudents()
    {
        $this->renderPartial('/_trainer/_students', array(), false, true);
    }

    public function actionEditTeacherModule($id, $idModule)
    {
        $student = RegisteredUser::userById($id);
        $module = Module::model()->findByPk($idModule);

        Yii::app()->user->model->hasAccessToOrganizationModel($module);
        Yii::app()->user->model->hasAccessToOrganizationModel(TrainerStudent::model()->findByAttributes(
            array(
                'student'=>$id,
                'trainer'=>Yii::app()->user->getId(),
                'id_organization'=>Yii::app()->user->model->getCurrentOrganization()->id,
                'end_time'=>null,
            )
        ));

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

        Yii::app()->user->model->hasAccessToOrganizationModel(TrainerStudent::model()->findByAttributes(
            array(
                'student'=>$id,
                'trainer'=>Yii::app()->user->getId(),
                'id_organization'=>Yii::app()->user->model->getCurrentOrganization()->id,
                'end_time'=>null,
            )
        ));

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

    public function actionGetTrainersStudentsList()
    {
        $requestParams = $_GET;
        $ngTable = new NgTableAdapter('TrainerStudent', $requestParams);
        $criteria =  new CDbCriteria();
        $criteria->condition = 't.trainer='.Yii::app()->user->getId().' and t.end_time is null 
        and id_organization='.Yii::app()->user->model->getCurrentOrganization()->id;
        $ngTable->mergeCriteriaWith($criteria);
        $result = $ngTable->getData();
        echo json_encode($result);
    }
    
    public function actionRenderTrainerUsersAgreements() {
        $this->renderPartial('/_trainer/trainerUsersAgreements');
    }

    public function actionGetTrainerUsersAgreementsList() {
        $requestParams = $_GET;
        $ngTable = new NgTableAdapter('UserAgreements', $requestParams);
        $criteria =  new CDbCriteria();
        $criteria->alias = 't';
        $criteria->join = 'left join acc_course_service cs on cs.service_id=t.service_id';
        $criteria->join .= ' left join course c on c.course_ID=cs.course_id';
        $criteria->join .= ' left join acc_module_service ms on ms.service_id=t.service_id';
        $criteria->join .= ' left join module m on m.module_ID=ms.module_id';
        $criteria->join .= ' left join trainer_student ts on ts.student=t.user_id';
        $criteria->addCondition('ts.trainer='.Yii::app()->user->getId().' and end_time is null 
        and (m.id_organization='.Yii::app()->user->model->getCurrentOrganization()->id.' 
        or c.id_organization='.Yii::app()->user->model->getCurrentOrganization()->id.')');
        $ngTable->mergeCriteriaWith($criteria);
        $result = $ngTable->getData();
        echo json_encode($result);
    }
}