<?php

class PlainTaskController extends Controller
{
    public function actionIndex()
    {
        $this->render('index');
    }


    public function actionAddTask()
    {
        $arr = self::fillArr();

        if (QuizFactory::factory($arr))
            $this->redirect(Yii::app()->request->urlReferrer);
        else echo 'Task was not saved';

    }

    public function actionEditTask()
    {
        $arr = self::fillArr();

        if (LectureElement::editPlainTask($arr['id_block'], $arr['block_element']))
            $this->redirect(Yii::app()->request->urlReferrer);

        else echo 'Task was not saved';
    }

    private static function fillArr()
    {
        $arr['pageId'] = Yii::app()->request->getPost('pageId');
        $arr['lecture'] = Yii::app()->request->getPost('lectureId');
        $arr['block_element'] = Yii::app()->request->getPost('block_element');
        $arr['author'] = Yii::app()->request->getPost('author');
        $arr['type'] = 'plain_task';

        if (isset($_POST['id_block']))
            $arr['id_block'] = Yii::app()->request->getPost('id_block');


        return $arr;
    }

    public function actionUnablePlainTask()
    {
        $lecture = Yii::app()->request->getPost('pageId', 0);

        if ($lecture != 0) {
            LecturePage::unableQuiz($lecture);
        }
        $this->redirect(Yii::app()->request->urlReferrer);

    }

    public function actionSaveAnswer()
    {
        $answer = htmlentities(Yii::app()->request->getPost('answer'));
        $lectureElementId = Yii::app()->request->getPost('idLecture');

        $plainTask = LectureElement::getPlainTaskByLectureId($lectureElementId);
        $user = Yii::app()->user->id;

        $plainTaskAnswer = PlainTaskAnswer::fillHole($answer, $user, $plainTask->id);

        if (!$plainTaskAnswer->save()){
            echo 'not save';
        } else {
            if(LecturePage::checkLastQuiz($plainTask->block_element)){
                $rating = RatingUserModule::model()->find('id_module=:idModule AND module_done=0 AND id_user=:idUser',[':idModule'=>Lecture::model()->find('id=:id',[':id'=>$lectureElementId])->idModule, ':idUser'=>$user]);
                if ($rating){
                    $rating->rateUser($user);
                }
                echo 'lastPage';
            }
            else echo 'done';
        }
    }
    public function actionDataPlainTask()
    {
        $idBlock = Yii::app()->request->getPost('idBlock');
        $data = [];
        $plainTask=LectureElement::model()->findByPk($idBlock);
        $data["condition"]=$plainTask->html_block;

        echo CJSON::encode($data);
    }

}