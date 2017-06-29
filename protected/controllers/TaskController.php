<?php

class TaskController extends Controller
{
    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl',
            'postOnly + addTask, setMark',
        );
    }

    public function actionAddTask()
    {
        $arr['condition'] = Yii::app()->request->getPost('condition', '');
        $arr['lecture'] = Yii::app()->request->getPost('lectureId', 0);
        $arr['author'] = Yii::app()->request->getPost('author', null);
        $arr['language'] = Yii::app()->request->getPost('lang', 'c++');
        $arr['assignment'] = Yii::app()->request->getPost('assignment', 0);
        $arr['table'] = Yii::app()->request->getPost('table', '');
        $arr['taskType'] = Yii::app()->request->getPost('taskType', 'plain');
        $arr['pageId'] = Yii::app()->request->getPost('pageId', 1);
        $arr['type'] = 'task';

        if ($arr['condition']) {
            if (QuizFactory::factory($arr))
                $this->redirect(Yii::app()->request->urlReferrer);
            else echo 'Task was not saved';
        }
    }

    public function actionSetMark()
    {
        $status = Yii::app()->request->getPost('status', '');
        $result = Yii::app()->request->getPost('result', '');
        $task = Yii::app()->request->getPost('task', 0);
        $date = Yii::app()->request->getPost('date', 0);
        $warning = Yii::app()->request->getPost('warning', '');

        $lastPage = Task::checkLastQuiz($task);
        $addedMark=TaskMarks::addMark($task, $status, $result, $date, $warning);

        if($addedMark && $lastPage){
            if ($status == 'true'){
                $lecture=TaskMarks::model()->find('quiz_uid=:quiz',[':quiz'=>$task])->lecture;
                $rating = RatingUserModule::model()->find('id_module=:idModule AND module_done=0 AND id_user=:idUser',
                    [':idModule'=>$lecture->idModule, ':idUser'=>(int)Yii::app()->user->id]);
                if ($rating){
                    $rating->rateUser((int)Yii::app()->user->id);
                }
            }
        };
        if($addedMark){
            return true;
        };
        $this->redirect(Yii::app()->request->urlReferrer);
    }

    public function actionEditTask()
    {
        $idBlock = Yii::app()->request->getPost('idTaskBlock', 0);
        $condition = Yii::app()->request->getPost('condition', '');
        $lecture = Yii::app()->request->getPost('lecture', 0);
        $author = Yii::app()->request->getPost('author', null);
        $language = Yii::app()->request->getPost('language', 'C++');
        $assignment = Yii::app()->request->getPost('assignment', 0);
        $table = Yii::app()->request->getPost('table', '');
        $taskType = Yii::app()->request->getPost('taskType', 'plain');

        if ($condition) {
            if ($lectureElementId = LectureElement::editTaskBlock($idBlock, $condition)) {
//                Task::addNewTask($lectureElementId, $language, $author, $assignment, $table);
            }
        }
        $this->redirect(Yii::app()->request->urlReferrer);
    }
    public function actionEditTaskCKE()
    {
        $idBlock = Yii::app()->request->getPost('idTaskBlock', 0);
        $condition = Yii::app()->request->getPost('condition', '');
        $lang = Yii::app()->request->getPost('lang', 'c++');

        if(LectureElement::editTaskBlock($idBlock,$condition) && Task::editTaskLang($idBlock,$lang))
            $this->redirect(Yii::app()->request->urlReferrer);
    }

    public function actionUnableTask()
    {
        $pageId = Yii::app()->request->getPost('pageId', 0);

        if ($pageId != 0) {
            LecturePage::unableQuiz($pageId);
        }
    }
    public function actionDataTask()
    {
        $idBlock = Yii::app()->request->getPost('idBlock');
        $data = [];
        $data["condition"] =  Task::getTaskCondition($idBlock);

        echo CJSON::encode($data);
    }
}