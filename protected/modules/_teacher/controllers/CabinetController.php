<?php

class CabinetController extends TeacherCabinetController
{
	public function actionIndex()
	{
        if(Yii::app()->user->isGuest){
            throw new CHttpException(403, 'У вас недостатньо прав для перегляду кабінету.
                Зайдіть з логіном викладача, адміністратора або бухгалтера.');
        }

        $model = StudentReg::model()->findByPk(Yii::app()->user->getId());

        switch($model->role){
            case '1':
                $teacher = $model->getTeacherModel();
                break;
            case '2':
                $teacher = null;
                break;
            case '3':
                $teacher = null;
                break;
            default:
                throw new CHttpException(403, 'У вас недостатньо прав для перегляду кабінету.
                Зайдіть з логіном викладача, адміністратора або бухгалтера.');
        }

		$this->render('index', array(
            'model' => $model,
            'teacher' => $teacher,
        ));
	}

    public function actionLoadPage($page, $teacher)
    {
        $page = strtolower($page);

        $role = Roles::model()->findByAttributes(array('title_en'=>$page));
        $teacherModel = Teacher::model()->findByPk($teacher);
        $userModel = $teacherModel->user;

        $this->rolesDashboard($teacherModel,$userModel,array($role));

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
        $model =  Teacher::model()->findByPk($id);
            if(!$model)
                throw new \Psr\Log\InvalidArgumentException('Page not found');
        return $model;
    }

    public function actionModule($id)
    {
        $modules = Teacher::model()->findByPk($id)->modules;

        $this->render('moduleList',array(
           'modules' => $modules,
        ));
    }

    public function actionMyPlainTask($id)
    {

        $lectureArr = [];
        $modules = Teacher::model()->findByPk($id)->modules;
        foreach($modules as $module)
        {
            $lect = $module->lectures;
            if($lect){
                array_push($lectureArr,$lect);
            }
        }
        $lectureElementsArr = [];

        foreach($lectureArr as $lectures)
        {
            foreach($lectures as $lecture)
            {
                $lecEl = $lecture->lectureEl;
                if($lecEl)
                {
                    array_push($lectureElementsArr,$lecEl);

                }
            }
        }
        $plainTaskArr = [];

        foreach($lectureElementsArr as $lectureElements)
        {
            foreach($lectureElements as $lectureElement)
            {
                $plainTask = $lectureElement->plainTask;
                if($plainTask)
                {
                    array_push($plainTaskArr,$plainTask);
                }
            }
        }
        $this->render('plainTaskList',array(
            'plainTasks' => $plainTaskArr,
        ));
    }

    public function actionShowPlainTask($id)
    {
        $plainTask = PlainTask::model()->findByPk($id);

        $this->render('../plainTask/show',array(
            'plainTask' => $plainTask,
        ));
    }

    public function actionGetUserInfo($user, $role){
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");

        $jsonObj = array(
            "name" => StudentReg::getUserName($user),
        );

        echo json_encode($jsonObj);
    }


    public function actionLoadDashboard($user){

        $model = StudentReg::model()->findByPk($user);

        $teacher = $model->teacher;

        $this->rolesDashboard($teacher,$model);

    }

    public function actionAccountantPage($user){
        $this->redirect(Yii::app()->createUrl('/_teacher/accountant/index', array('user' => $user)));
    }

    public function actionAdminPage(){
        $this->redirect(Yii::app()->createUrl('/_teacher/admin/index'));

    }

    public function rolesDashboard($teacher,$user,$inRole = null)
    {
        if($teacher != null){
        if($inRole == null)
        {
            $roles = $teacher->roles();
        }
        else $roles = $inRole;


        foreach($roles as $role)
        {
            switch($role->getRole())
            {
                case 'trainer':
                        $this->renderTrainerDashboard($teacher,$user,$role);
                    break;
                case 'author':
                        $this->renderAuthorDashboard($teacher,$user,$role);
                    break;
                case 'consultant':
                        $this->renderConsultantDashboard($teacher,$user,$role);
                    break;
                case 'leader':
                        $this->renderLeaderDashboard($teacher,$user,$role);
                    break;
                default:
                    throw new CHttpException(400, 'Неправильно вибрана роль!');
                    break;
            }
        }
        }
        else
        {
            switch($user->role)
            {
                case '2':

                    break;
                case '3':
                    $this->renderAdminDashboard();
                break;
            }
        }

    }

    public function renderSidebarByRole($role)
    {
        $teacher = Teacher::model()->findByAttributes(array('user_id' => Yii::app()->user->id));
        $user = StudentReg::model()->findByPk(Yii::app()->user->id);
        if($role)
        {
            switch(strtolower($role->title_en))
            {
                case 'trainer' :
                    $this->renderPartial('/trainer/sidebar',array(
                        'teacher' => $teacher,
                        'user' => $user,
                        'role' => $role
                    ));
                break;

            }
        }
    }

    private function renderTrainerDashboard(Teacher $teacher,StudentReg $user,$role)
    {
       return $this->renderPartial('/trainer/_trainerDashboard',array(
            'teacher' => $teacher,
            'user' => $user,
            'role' => $role,
        ));
    }

    private function renderAuthorDashboard(Teacher $teacher,StudentReg $user,$role)
    {
        return $this->renderPartial('/author/_authorDashboard',array(
            'teacher' => $teacher,
            'user' => $user,
            'role' => $role,
        ));
    }

    private function renderConsultantDashboard(Teacher $teacher,StudentReg $user,$role)
    {
        return $this->renderPartial('/consultant/_consultantDashboard',array(
            'teacher' => $teacher,
            'user' => $user,
            'role' => $role,
        ));
    }

    private function renderLeaderDashboard(Teacher $teacher,StudentReg $user,$role)
    {
        return $this->renderPartial('/leader/_leaderDashboard',array(
            'teacher' => $teacher,
            'user' => $user,
            'role' => $role,
        ));
    }

    private function renderAdminDashboard()
    {
        return $this->renderPartial('/admin/index');
    }


}