<?php

class TrainerController extends AdminController{

//    public function actionIndex(){
//
//        $answers = PlainTaskAnswer::getAllPlainTaskAnswers();
//        $users = StudentReg::getStudentWithoutTrainer();
//
//        $this->render('index', array(
//            'answers' => $answers,
//            'users' => $users,
//        ));
//    }

    public function actionAddTrainer($id)
    {
        $user = StudentReg::model()->findByPk($id);
        if(!$user)
            throw new CHttpException(404,'Вказана сторінка не знайдена');

        $trainers = Teacher::getAllTrainers();

        $this->render('addTrainer',array(
            'user' => $user,
            'trainers' => $trainers
        ));
    }

    public function actionSetTrainer()
    {
        if(isset($_POST['userId']) && isset($_POST['trainerId']))
        {
            $userId = $_POST['userId'];
            $trainerId = $_POST['trainerId'];

            if(!TrainerStudent::addTrainer($userId,$trainerId))
                throw new \application\components\Exceptions\NotSaveException("Тренер не був збережений");
            $path = Yii::app()->createUrl('/_admin/trainer/index');
            $this->redirect($path);
        }
    }

//    public function actionUserWithTrainerList()
//    {
//        $users = StudentReg::getUserWithTrainer();
//
//        $this->render('userWithTrainer',array(
//            'users' => $users));
//
//    }

    public function actionChangeTrainer($id,$oldTrainerId)
    {
        $trainerStudent = TrainerStudent::model()->findByAttributes(array('student' => $id ,'trainer' =>$oldTrainerId));

        if(!$trainerStudent)
            throw new CHttpException(404,'Вказана сторінка не знайдена');

        $user = StudentReg::model()->findByPk($id);
        $oldTrainer = Teacher::model()->findByPk($oldTrainerId);
        $trainers = Teacher::getAllTrainers();
        $this->render('changeTrainer',array(
            'user' => $user,
            'trainers' => $trainers,
            'oldTrainer' => $oldTrainer
        ));
    }

    public function actionEditTrainer()
    {
        if(isset($_POST['userId']) && isset($_POST['trainerId']))
        {
            $userId = $_POST['userId'];
            $trainerId = $_POST['trainerId'];

            if(!TrainerStudent::editTrainer($userId,$trainerId))
                throw new \application\components\Exceptions\NotSaveException("Тренер не був збережений");
            $path = Yii::app()->createUrl('/_admin/trainer/userWithTrainerList');
            $this->redirect($path);
        }
    }

    public function actionRemoveUserTrainer($id)
    {
            if(!TrainerStudent::deleteUserTrainer($id))
                throw new \application\components\Exceptions\NotSaveException("Тренер не був видалений");

                $path = Yii::app()->createUrl('/_admin/trainer/userWithTrainerList');
                $this->redirect($path);
    }
}