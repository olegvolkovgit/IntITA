<?php

class CabinetController extends TeacherCabinetController
{

    public function actionIndex($scenario = "dashboard", $receiver = 0)
    {
        $model = Yii::app()->user->model;

        if (!$model) {
            throw new \application\components\Exceptions\IntItaException(400, 'Користувача не знайдено.');
        }
        $newReceivedMessages = $model->newReceivedMessages();
        $authorRequests = $model->authorRequests();

        $this->render('index', array(
            'model' => $model,
            'newMessages' => $newReceivedMessages,
            'scenario' => $scenario,
            'receiver' => $receiver,
            'authorRequests' => $authorRequests
        ));
    }

    public function actionLoadPage($page)
    {
        $page = strtoupper($page);

        $model = Yii::app()->user->model;
        $role = new UserRoles($page);

        if ($role && $model)
            $this->rolesDashboard($model, array($role));
    }

    public function actionView($id)
    {
        $model = $this->loadModel($id);

        $this->render('view', array(
            'model' => $model,
        ));
    }

    public function actionLogin($id)
    {
        $email = StudentReg::model()->findByPk($id)->email;
        $model = array_shift(Teacher::model()->findAllByAttributes(array('email' => $email)));

        $this->render('cabinet', array(
            'model' => $model,
        ));
    }

    private function loadModel($id)
    {
        $model = Teacher::model()->findByPk($id);
        if (!$model)
            throw new \Psr\Log\InvalidArgumentException('Page not found');
        return $model;
    }

    public function actionModule($id)
    {
        $modules = Teacher::model()->findByPk($id)->modules;

        $this->render('moduleList', array(
            'modules' => $modules,
        ));
    }

    public function actionMyPlainTask($id)
    {

        $lectureArr = [];
        $modules = Teacher::model()->findByPk($id)->modules;
        foreach ($modules as $module) {
            $lect = $module->lectures;
            if ($lect) {
                array_push($lectureArr, $lect);
            }
        }
        $lectureElementsArr = [];

        foreach ($lectureArr as $lectures) {
            foreach ($lectures as $lecture) {
                $lecEl = $lecture->lectureEl;
                if ($lecEl) {
                    array_push($lectureElementsArr, $lecEl);

                }
            }
        }
        $plainTaskArr = [];

        foreach ($lectureElementsArr as $lectureElements) {
            foreach ($lectureElements as $lectureElement) {
                $plainTask = $lectureElement->plainTask;
                if ($plainTask) {
                    array_push($plainTaskArr, $plainTask);
                }
            }
        }
        $this->render('plainTaskList', array(
            'plainTasks' => $plainTaskArr,
        ));
    }

    public function actionShowPlainTask($id)
    {
        $plainTask = PlainTask::model()->findByPk($id);

        $this->render('../plainTask/show', array(
            'plainTask' => $plainTask,
        ));
    }

    public function actionLoadDashboard($user)
    {
        $model = RegisteredUser::userById($user);
        $this->rolesDashboard($model);
    }

    public function actionAccountantPage($user)
    {
        $this->redirect(Yii::app()->createUrl('/_teacher/accountant/index', array('user' => $user)));
    }

    public function actionAdminPage()
    {
        $this->redirect(Yii::app()->createUrl('/_teacher/admin/index'));

    }

    public function rolesDashboard(RegisteredUser $user, $inRole = null)
    {
        if ($inRole == null) {
            $roles = $user->getRoles();
        } else $roles = $inRole;

        foreach ($roles as $role) {
            switch ($role) {
                case "trainer":
                    $this->renderTrainerDashboard($user);
                    break;
                case "author":
                    $this->renderAuthorDashboard($user);
                    break;
                case 'consultant':
                    $this->renderConsultantDashboard($user);
                    break;
                case 'admin':
                    $this->renderAdminDashboard();
                    break;
                case 'accountant':
                    $this->renderAccountantDashboard();
                    break;
                case 'student':
                    $this->renderStudentDashboard($user);
                    break;
                default:
                    throw new CHttpException(400, 'Неправильно вибрана роль!');
                    break;
            }
        }
    }

    public function renderSidebarByRole(UserRoles $role)
    {
        $user = Yii::app()->user->model;
        switch ($role) {
            case 'author' :
                $this->renderPartial('/author/sidebar', array(
                    'user' => $user
                ));
                break;
            case 'trainer' :
                $this->renderPartial('/trainer/sidebar', array(
                    'user' => $user
                ));
                break;
            case 'consultant' :
                $this->renderPartial('/consultant/sidebar', array(
                    'user' => $user
                ));
                break;
        }
    }

    private function renderTrainerDashboard(RegisteredUser $user)
    {
        return $this->renderPartial('/trainer/_trainerDashboard', array(
            'teacher' => $user->getTeacher(),
            'user' => $user->registrationData
        ));
    }

    private function renderAuthorDashboard(RegisteredUser $user)
    {
        return $this->renderPartial('/author/_authorDashboard', array(
            'teacher' => $user->getTeacher(),
            'user' => $user->registrationData
        ));
    }

    private function renderStudentDashboard(RegisteredUser $user)
    {
        return $this->renderPartial('/student/_dashboard', array(
            'user' => $user->registrationData
        ));
    }


    private function renderConsultantDashboard(RegisteredUser $user)
    {
        return $this->renderPartial('/consultant/_consultantDashboard', array(
            'teacher' => $user->getTeacher(),
            'user' => $user->registrationData
        ));
    }

    private function renderLeaderDashboard(Teacher $teacher, RegisteredUser $user)
    {
        return $this->renderPartial('/leader/_leaderDashboard', array(
            'teacher' => $teacher,
            'user' => $user->registrationData
        ));
    }

    private function renderAdminDashboard()
    {
        return $this->renderPartial('/admin/index');
    }

    private function renderAccountantDashboard()
    {
        return $this->renderPartial('/accountant/index');
    }

    public function actionUsersByQuery($query)
    {
        if ($query) {
            $users = StudentReg::allUsers($query);
            echo $users;
        } else {
            throw new \application\components\Exceptions\IntItaException('400');
        }
    }

}