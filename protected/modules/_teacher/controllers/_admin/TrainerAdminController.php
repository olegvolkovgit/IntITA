<?php
/**
 * Created by PhpStorm.
 * User: Quicks
 * Date: 24.12.2015
 * Time: 17:38
 */

class TrainerAdminController extends TeacherCabinetController {

    public function actionIndex(){

        $answers = PlainTaskAnswer::getAllPlainTaskAnswers();
        $users = StudentReg::getStudentWithoutTrainer();

        $this->renderPartial('index', array(
            'answers' => $answers,
            'users' => $users,
        ),false,true);
    }

    public function actionAddTrainer($id)
    {
        $user = StudentReg::model()->findByPk($id);
        if(!$user)
            throw new CHttpException(404,'Вказана сторінка не знайдена');

        $trainers = Teacher::getAllTrainers();

        $this->renderPartial('addTrainer',array(
            'user' => $user,
            'trainers' => $trainers
        ),false,true);
    }

    public function actionSetTrainer()
    {
        if(isset($_POST['userId']) && isset($_POST['trainerId']))
        {
            $userId = Yii::app()->request->getPost('userId');
            $trainerId = Yii::app()->request->getPost('trainerId');

            if(!TrainerStudent::addTrainer($userId,$trainerId))
                throw new \application\components\Exceptions\NotSaveException("Тренер не був збережений");
            $this->redirect(Yii::app()->createUrl('/_teacher/_admin/trainerAdmin/index'));
        }
    }

    public function actionUserWithTrainerList()
    {
        $users = StudentReg::getUserWithTrainer();

        $this->renderPartial('userWithTrainer',array(
            'users' => $users
        ),false,true);

    }

    public function actionChangeTrainer($id,$oldTrainerId)
    {
        $trainerStudent = TrainerStudent::model()->findByAttributes(array('student' => $id ,'trainer' =>$oldTrainerId));

        if(!$trainerStudent)
            throw new CHttpException(404,'Вказана сторінка не знайдена');

        $user = StudentReg::model()->findByPk($id);
        $oldTrainer = Teacher::model()->findByPk($oldTrainerId);
        $trainers = Teacher::getAllTrainers();
        $this->renderPartial('changeTrainer',array(
            'user' => $user,
            'trainers' => $trainers,
            'oldTrainer' => $oldTrainer
        ),false,true);
    }

    public function actionEditTrainer()
    {
        if(isset($_POST['userId']) && isset($_POST['trainerId']))
        {
            $userId = $_POST['userId'];
            $trainerId = $_POST['trainerId'];

            if(!TrainerStudent::editTrainer($userId,$trainerId))
                throw new \application\components\Exceptions\NotSaveException("Тренер не був збережений");

            $this->redirect(Yii::app()->createUrl('/_teacher/_admin/trainerAdmin/index'));
        }
    }

    public function actionRemoveUserTrainer($id)
    {
        if(!TrainerStudent::deleteUserTrainer($id))
            throw new \application\components\Exceptions\NotSaveException("Тренер не був видалений");

        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
    }


}