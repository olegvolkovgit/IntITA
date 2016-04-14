<?php

class RevisionQuizFactory
{
    public static function createQuiz($arr)
    {
        switch($arr['type'])
        {
            case 'plain_task' :
                break;
            case LectureElement::TEST :
                $newLectureElement = new RevisionLectureElement();
                $newLectureElement->id_type = $arr['type'];
                $newLectureElement->id_page = $arr['pageId'];
                $newLectureElement->block_order = 0;
                $newLectureElement->html_block = $arr['condition'];
                $newLectureElement->saveCheck();

                $test = RevisionTests::createTest($newLectureElement->id, $arr['testTitle'], $arr['answers']);
                break;
            case 'task' :
                break;
            case 'skip_task':
                break;
            default:
                break;
        }

        return null;
    }
}