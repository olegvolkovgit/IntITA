<?php

class CabinetController extends TeacherCabinetController
{
	public function actionIndex($id)
	{
        if(!$this->isYourCabinet($id))
        {
            throw new CHttpException(403, 'Ви не можете переглядати чужий профіль.');
        }

        $model = Teacher::model()->findByPk($id);
		$this->render('index', array(
            'model' => $model,
        ));
	}

    public function actionLoadPage($page, $teacher)
    {
        $page = strtolower($page);
        $params = [];

        switch($page){
            case 'trainer' :
                $plainTasksAnswers = TrainerStudent::getStudentWithoutTrainer($teacher);
                return $this->renderPartial('_newPlainTask',array('plainTasksAnswers' => $plainTasksAnswers));
//                $params = TrainerStudent::getStudentsByTrainer($teacher);
                break;
            case 'consultant':
                break;
            case 'author':
                break;
            case 'leader':
                break;
            case 'dashboard':
                break;
            default:
                throw new CHttpException(400, 'Неправильно вибрана роль!');
                break;
        }

        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");

        $json = array(
            "title" => $page,
            "teacher" => $teacher,
            "params" => $params,
        );

        echo json_encode($json);
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

    public function actionAddConsultant($id)
    {

        $plainTaskAnswer = PlainTaskAnswer::model()->findByPk($id);

        if(!$plainTaskAnswer)
            throw new CHttpException(404,'Page not found');

        return $this->renderPartial('/cabinet/_addConsult',
            array(
            'plainTaskAnswer' => $plainTaskAnswer));
    }

    public function actionAssignedConsultant()
    {
        if(isset($_POST['arr']))
        {
            //$_POST['arr'] first hole this is id_plainTaskAnswer,second hole this is id_teacher
            $idPlainTaskAnswer = $_POST['arr'][0];
            $consult = $_POST['arr'][1];

            if(!PlainTaskAnswer::assignedConsult($idPlainTaskAnswer,$consult))
                throw new \application\components\Exceptions\IntItaException(400,'Consult was not saved');

        }
    }
}