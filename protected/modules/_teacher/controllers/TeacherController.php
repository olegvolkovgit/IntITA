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
            'plainTasksAnswers' => $plainTaskAnswers
        ));
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
        if (isset($_POST['arr'])) {
            //$_POST['arr'] first hole this is id_plainTaskAnswer,second hole this is id_teacher
            $idPlainTaskAnswer = $_POST['arr'][0];
            $consult = $_POST['arr'][1];
            Letters::sendAssignedConsultantLetter($consult,$idPlainTaskAnswer);

            if (!PlainTaskAnswer::assignedConsult($idPlainTaskAnswer, $consult))
                throw new \application\components\Exceptions\IntItaException(400, 'Consult was not saved');

        }
    }
}