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
        $imapMessages = 0;
        if ($model->isTeacher())
        {
            $conn   = imap_open('{localhost:993/imap/ssl/novalidate-cert}INBOX', 'test@dev.intita.com', '1', OP_READONLY);
            $countMailBoxMessages = imap_search($conn, 'UNSEEN');
            if ($countMailBoxMessages){
                $imapMessages = count($countMailBoxMessages);
            }
            imap_close($conn);
        }
        $this->render('index', array(
            'model' => $model,
            'newMessages' => $newReceivedMessages,
            'countNewMessages' => $countNewMessages,
            'mailboxMessages' => $imapMessages,
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
        $imapMessages = 0;
        if ($model->isTeacher())
        {
            $conn   = imap_open('{localhost:993/imap/ssl/novalidate-cert}INBOX', 'test@dev.intita.com', '1', OP_READONLY);
            $countMailBoxMessages = imap_search($conn, 'UNSEEN');
            if ($countMailBoxMessages){
                $imapMessages = count($countMailBoxMessages);
            }
            imap_close($conn);
        }
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
                case 'supervisor':
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
    public function actionActiveUsersByQuery($query)
    {
        if ($query) {
            $users = StudentReg::usersByQuery($query);
            echo $users;
        } else {
            throw new \application\components\Exceptions\IntItaException('400');
        }
    }
    public function actionAuthorsByQuery($query)
    {
        if ($query) {
            $authors = UserAuthor::authorsList($query);
            echo $authors;
        } else {
            throw new \application\components\Exceptions\IntItaException('400');
        }
    }

    public function actionModulesByQuery($query)
    {
        if ($query) {
            $modules = Module::allModules($query);
            echo $modules;
        } else {
            throw new \application\components\Exceptions\IntItaException('400');
        }
    }

    public function actionStudentsByQuery($query)
    {
        if ($query) {
            $users = UserStudent::studentByQuery($query);
            echo $users;
        } else {
            throw new \application\components\Exceptions\IntItaException('400');
        }
    }

    public function actionCoursesByQuery($query)
    {
        echo Course::readyCoursesList($query);
    }
    
    public function actionModulesTitleById()
    {
        $id = Yii::app()->request->getPost('moduleId');

        $module = Module::model()->findByPk($id);
        $lang = (Yii::app()->session['lg']) ? Yii::app()->session['lg'] : 'ua';
        $titleParam = "title_" . $lang;
        $result["id"] = $id;
        $result["title"] = $module->$titleParam . " (" . $module->language . ")";
        echo json_encode($result);
    }

    public function actionTeacherConsultantsByQuery($query)
    {
        echo TeacherConsultant::teacherConsultantsByQuery($query);
    }

    public function actionConsultantsByQuery($query)
    {
        echo Consultant::consultantsByQuery($query);
    }

    public function actionTeachersByQuery($query)
    {
        echo Teacher::teachersByQuery($query);
    }
    
    public function actionUsersNotTeacherByQuery($query)
    {
        if ($query) {
            $users = StudentReg::usersNotTeacherByQuery($query);
            echo $users;
        } else {
            throw new \application\components\Exceptions\IntItaException('400');
        }
    }

    public function actionTrainers($query)
    {
        if ($query) {
            $users = Trainer::trainersByQuery($query);
            echo $users;
        } else {
            throw new \application\components\Exceptions\IntItaException('400');
        }
    }
    public function actionTeacherConsultantsByQueryAndModule($query,$module)
    {
        if ($query && $module) {
            $users = Teacher::teacherConsultantsByQueryAndModule($query,$module);
            echo $users;
        } else {
            throw new \application\components\Exceptions\IntItaException('400');
        }
    }
    
    public function actionChangeLang()
    {
        $new_lang = $_GET['lg'];
        if ($new_lang == "ua") {
            $new_lang = "uk";
            $_SESSION['current_language'] = null;
        } else {
            $_SESSION['current_language'] = $new_lang;
        }

        $id = null;

        foreach ($_SESSION as $key => $value) {
            if (strpos($key, '__id')) {
                $id = $value;
                break;
            }
        }

        if ($id) {
            $forumUser = ForumUser::model()->findByPk($id);

            if ($forumUser) {
                $forumUser->user_lang = $new_lang;
                $forumUser->save();
            } else
                throw new \application\components\Exceptions\ForumException('In forum user not change language');
        }

        $app = Yii::app();
        if (isset($_GET['lg'])) {
            $app->session['lg'] = $_GET['lg'];
        }
        echo $app->session['lg'];
    }

    public function actionModulesListByRole()
    {
        $id = Yii::app()->request->getPost('user', '0');
        $role = Yii::app()->request->getPost('role');
        if ($id == 0)
            throw new \application\components\Exceptions\IntItaException(400, "Неправильно вибраний користувач.");
        $user = RegisteredUser::userById($id);

        $modules = $user->getAttributesByRole(new UserRoles($role))[0];
        echo json_encode($modules);
    }

    public function actionGetModuleLink()
    {
        echo Yii::app()->createUrl('module/index', array('idModule' => Yii::app()->request->getPost('id')));
    }
    public function actionGetCourseLink()
    {
        echo Yii::app()->createUrl('course/index', array('id' => Yii::app()->request->getPost('id')));
    }

    public function actionMail(){
        $teacher = Teacher::model()->findByPk(Yii::app()->user->id);
        $params = array(
            'uid' => Yii::app()->user->id,
            'pass'=>rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256,Yii::app()->params['secretKey'], base64_decode(urldecode($teacher->mail_password)),MCRYPT_MODE_ECB)),
            'mail'=>$teacher->corporate_mail,
            'time'=>time()
        );

        $test = json_encode($params);
        $token = urlencode(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, Yii::app()->params['secretKey'], $test, MCRYPT_MODE_ECB)));
        $this->redirect(Config::getRoundcubeAddress().'/?intitaLogon='.$token);
    }
    
}