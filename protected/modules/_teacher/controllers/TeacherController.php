<?php

/**
 * Created by PhpStorm.
 * User: Quicks
 * Date: 11.12.2015
 * Time: 15:36
 */
class TeacherController extends TeacherCabinetController
{

    public function actionShowPlainTaskList()
    {
        $plainTaskAnswers = PlainTask::getPlainTaskAnswersWithoutTrainer();

        $this->renderPartial('/trainer/_newPlainTask', array(
            'plainTasksAnswers' => $plainTaskAnswers,
        ), false, true);
    }

    public function actionAddConsultant($id)
    {
        $plainTaskAnswer = PlainTaskAnswer::model()->findByPk($id);

        if (!$plainTaskAnswer)
            throw new CHttpException(404, 'Page not found');

        return $this->renderPartial('/trainer/_addConsult',
            array('plainTaskAnswer' => $plainTaskAnswer));
    }

    public function actionAssignedConsultant()
    {
        $idPlainTaskAnswer = Yii::app()->request->getPost('idPlainTask');
        $consult = Yii::app()->request->getPost('consult');
        $model = StudentReg::model()->findByPk($consult);

        $plainTaskAnswer = PlainTaskAnswer::model()->findByPk($idPlainTaskAnswer);

        $sender = new MailTransport();
        $sender->renderBodyTemplate('_assignedConsultantLetter', array($plainTaskAnswer));
        if ($sender->send($model->email, "", 'Нова задача', "")) {
            $model->save();
        }

        if (!PlainTaskAnswer::assignedConsult($idPlainTaskAnswer, $consult->teacher->teacher_id))
            throw new \application\components\Exceptions\IntItaException(400, 'Consult was not saved');
    }

    public function actionShowTeacherPlainTaskList()
    {
        $idTeacher = Yii::app()->request->getPost('idTeacher', 0);
        if ($idTeacher == 0) {
            throw new \application\components\Exceptions\IntItaException(400, 'Неправильний запит.');
        }

        $tasksList = PlainTaskAnswer::plainTaskListByTeacher($idTeacher);

        return $this->renderPartial('/trainer/teacherPlainTaskList', array(
            'teacherPlainTasks' => $tasksList,
        ));
    }

    public function actionShowPlainTask()
    {
        $idPlainTask = Yii::app()->request->getPost('idPlainTask', '0');
        if ($idPlainTask == 0) {
            throw new \application\components\Exceptions\IntItaException(400, 'Такої задачі не знайдено.');
        }

        $plainTask = PlainTaskAnswer::model()->findByPk($idPlainTask);
        if (!$plainTask) {
            throw new \application\components\Exceptions\IntItaException(400, 'Такої задачі не знайдено.');
        }

        return $this->renderPartial('/trainer/showPlainTask', array(
            'plainTask' => $plainTask
        ), false, true);
    }

    public function actionMarkPlainTask()
    {
        $plainTaskId = Yii::app()->request->getPost('idPlainTask');
        $mark = Yii::app()->request->getPost('mark');
        $comment = Yii::app()->request->getPost('comment');
        $userId = Yii::app()->request->getPost('userId');

        if (!PlainTaskMarks::saveMark($plainTaskId, $mark, $comment, $userId))
            throw new \application\components\Exceptions\IntItaException(503, 'Ваша оцінка не записана в базу даних.
            Спробуйте пізніше або повідомте адміністратора.');
    }

    public function actionManageConsult()
    {
        $tasks = PlainTaskAnswer::getTaskWithTrainer();
        $plainTaskAnswers = PlainTask::getPlainTaskAnswersWithoutTrainer();

        $this->renderPartial('/trainer/_manageConsult', array(
            'plainTaskAnswers' => $plainTaskAnswers,
            'tasks' => $tasks
        ), false, true);
    }

    public function actionPlainTaskWithTrainers()
    {
        $tasks = PlainTaskAnswer::getTaskWithTrainer();

        $this->renderPartial('/trainer/_plainWithTrainer', array(
            'tasks' => $tasks));
    }

    public function actionChangeConsultant()
    {
        $id = Yii::app()->request->getPost('id');

        $plainTask = PlainTaskAnswer::model()->findByPk($id);

        $this->renderPartial('/trainer/editConsult', array(
            'task' => $plainTask
        ));
    }

    public function actionEditConsultant()
    {
        $id = Yii::app()->request->getPost('id');
        $teacherId = Yii::app()->request->getPost('consult');
        PlainTaskAnswer::editConsult($id, $teacherId);
    }

    public function actionDeleteConsultant()
    {
        $id = Yii::app()->request->getPost('id');
        PlainTaskAnswer::removeConsult($id);
    }
}