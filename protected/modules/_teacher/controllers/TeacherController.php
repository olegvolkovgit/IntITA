<?php
/**
 * Created by PhpStorm.
 * User: Quicks
 * Date: 11.12.2015
 * Time: 15:36
 */

class TeacherController extends TeacherCabinetController {

    public function actionShowPlainTaskList()
    {
        $plainTaskAnswers = PlainTask::getPlainTaskAnswersWithoutTrainer();

        $this->renderPartial('/trainer/_newPlainTask',array(
            'plainTasksAnswers' => $plainTaskAnswers,
        ), false, true);
    }

    public function actionAddConsultant($id)
    {
        $plainTaskAnswer = PlainTaskAnswer::model()->findByPk($id);

        if(!$plainTaskAnswer)
            throw new CHttpException(404,'Page not found');

        return $this->renderPartial('/trainer/_addConsult',
            array(
                'plainTaskAnswer' => $plainTaskAnswer));
    }

    public function actionAssignedConsultant()
    {
            $idPlainTaskAnswer = Yii::app()->request->getPost('idPlainTask');
            $consult = Yii::app()->request->getPost('consult');

            Letters::sendAssignedConsultantLetter($consult,$idPlainTaskAnswer);

            if (!PlainTaskAnswer::assignedConsult($idPlainTaskAnswer, $consult))
                throw new \application\components\Exceptions\IntItaException(400, 'Consult was not saved');
    }

    public function actionShowTeacherPlainTaskList()
    {
        $idTeacher = Yii::app()->request->getPost('idTeacher');

        $tasksList = PlainTaskAnswer::plainTaskListByTeacher($idTeacher);

        return $this->renderPartial('/trainer/teacherPlainTaskList',array(
            'teacherPlainTasks' => $tasksList,
        ));
    }

    public function actionShowPlainTask()
    {
        $idPlainTask = Yii::app()->request->getPost('idPlainTask');

        $plainTask = PlainTaskAnswer::model()->findByPk($idPlainTask);

        return $this->renderPartial('/trainer/showPlainTask',array(
           'plainTask' => $plainTask
        ), false, true);
    }

    public function actionMarkPlainTask()
    {
        $plainTaskId = Yii::app()->request->getPost('idPlainTask');
        $mark = Yii::app()->request->getPost('mark');
        $comment = Yii::app()->request->getPost('comment');
        $userId = Yii::app()->request->getPost('userId');

        if(!PlainTaskMarks::saveMark($plainTaskId,$mark,$comment,$userId))
            throw new IntItaExeption(503);
    }

    public function actionManageConsult()
    {
        $this->actionShowPlainTaskList();
        $this->actionPlainTaskWithTrainers();
    }

    public function actionPlainTaskWithTrainers()
    {
       $tasks = PlainTaskAnswer::getTaskWithTrainer();

       $this->renderPartial('/trainer/_plainWithTrainer',array(
            'tasks' => $tasks,
             ));
    }

    public function actionChangeConsultant()
    {
        $id = Yii::app()->request->getPost('id');

        $plainTask = PlainTaskAnswer::model()->findByPk($id);

        $this->renderPartial('/trainer/editConsult',array(
           'task' => $plainTask
        ));
    }

    public function actionEditConsultant()
    {
        $id = Yii::app()->request->getPost('id');
        $teacherId = Yii::app()->request->getPost('consult');
        PlainTaskAnswer::editConsult($id,$teacherId);
    }

    public function actionDeleteConsultant()
    {
        $id = Yii::app()->request->getPost('id');
        PlainTaskAnswer::removeConsult($id);
    }
}