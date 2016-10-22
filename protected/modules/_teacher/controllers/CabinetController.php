<?php

class CabinetController extends TeacherCabinetController
{

    public function hasRole(){
        return !Yii::app()->user->isGuest;
    }

    public function actionIndex($scenario = "dashboard", $receiver = 0, $course = 0, $module = 0)
    {
        $model = Yii::app()->user->model;
        if ($course != 0 || $module != 0) {
            if (!$model->isStudent()) {
                UserStudent::addStudent($model->registrationData);
            }
        }

        if (!$model) {
            throw new \application\components\Exceptions\IntItaException(400, 'Користувача не знайдено.');
        }
        $newReceivedMessages = $model->newReceivedMessages();
        $countNewMessages = count($newReceivedMessages);
        $newReceivedMessages = $model->newMessages($newReceivedMessages);
        $requests = $model->requests();

        $this->render('index', array(
            'model' => $model,
            'newMessages' => $newReceivedMessages,
            'countNewMessages' => $countNewMessages,
            'scenario' => $scenario,
            'receiver' => $receiver,
            'course' => $course,
            'module' => $module,
            'requests' => $requests
        ));
    }

    public function actionGetNewMessages(){
        $model = Yii::app()->user->model;
        $newReceivedMessages = $model->newReceivedMessages();
        $newReceivedMessages = $model->newMessages($newReceivedMessages);
        $requests = $model->requests();
        $newRequests = [];
        $newMessages =[];
        foreach ($requests as $key=>$request){
            $req['id'] = $request->getMessageId();
            $req['sender'] = $request->sender()->userName()==""?$request->sender()->email:$request->sender()->userName();
            $req['title']=$request->title();
            if ($request->module()){
                $req['module'] ='Модуль: '. $request->module()->getTitle();
            }
            array_push($newRequests,$req);
        }
        foreach ($newReceivedMessages as $key=>$record) {
            $message = $record->message();
            $mes['senderId'] = $message->sender0->id;
            $mes['userId'] = $model->id;
            ($message->sender0->userName() == "")?$mes['user'] = $message->sender0->email:$mes['user'] = $message->sender0->userName();
            $mes['date'] = date("h:m, d F", strtotime($message->create_date));
            $mes['subject'] = $record->subject();
            array_push($newMessages,$mes);
        }

            echo json_encode(['requests'=> ['countOfRequests'=>count($newRequests),'newRequests'=>$newRequests],'messages'=>['countOfNewMessages'=>count($newMessages),'newMessages'=>$newMessages ]]);

    }

    public function actionLoadPage($page)
    {
        $page = strtoupper($page);

        $model = Yii::app()->user->model;
        $role = new UserRoles($page);

        if(!$model->hasRole($role)){
            throw new \application\components\Exceptions\IntItaException(403, 'Сторінка недоступна');
        }

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
                case "author":
                case 'consultant':
                case 'student':
                case 'tenant':
                case 'content_manager':
                case 'teacher_consultant':
                case 'admin':
                case 'accountant':
                case 'super_visor':
                    $this->renderDashboard($role, $user);
                    break;
                default:
                    throw new CHttpException(400, 'Неправильно вибрана роль!');
                    break;
            }
        }
    }

    private function renderDashboard(UserRoles $role, RegisteredUser $user){
        $view = '/_'.$role.'/_dashboard';
        return $this->renderPartial($view, array(
            'teacher' => $user->getTeacher(),
            'user' => $user->registrationData
        ));
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