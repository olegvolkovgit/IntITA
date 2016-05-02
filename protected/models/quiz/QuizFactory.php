<?php

class QuizFactory {

    public static function factory($arr)
    {
        switch($arr['type'])
        {
            case 'plain_task' :
                $id_block = LectureElement::addNewPlainTask($arr['lecture'], $arr['block_element']);
                if($id_block){
                    $arr['block'] = $id_block;
                    $taskObj = new PlainTask();
                    $taskObj->addTask($arr);
                    return true;
                }
                else return false;
            break;
            case 'tests' :
                if ($lectureElementId = LectureElement::addNewTestBlock($arr['lecture'], $arr['condition'])) {
                    $tests = new Tests();
                    $arr['lectureElementId'] = $lectureElementId;
                    if($tests->addTask($arr))
                    return true;
                    else return false;
                }
                break;
            case 'task' :
                if ($lectureElementId = LectureElement::addNewTaskBlock($arr['lecture'] , $arr['condition'])) {
                    $arr['lectureElementId'] = $lectureElementId;
                    $task = new Task();
                    if ($task->addTask($arr))
                        return true;
                    else return false;

                }
            break;
            case 'skip_task':
                $lecture = LecturePage::model()->findByPk($arr['pageId'])->id_lecture;
                $conditionId = LectureElement::addNewSkipTaskBlock($lecture , $arr['condition']);
                $questionId = LectureElement::addNewSkipTaskBlock($lecture , $arr['text']);


                if ($questionId && $conditionId) {
                    $arr['condition'] = $conditionId;
                    $arr['questionId'] = $questionId;

                    $task = new SkipTask();
                    if ($task->addTask($arr))
                        return true;
                    else return false;
                }
            break;
            default:
                break;
        }

        return null;
    }
}