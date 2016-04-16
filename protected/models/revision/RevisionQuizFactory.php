<?php

class RevisionQuizFactory
{
    public static function createQuiz($arr)
    {
        //todo refactor creating lecture element
        $newLectureElement = new RevisionLectureElement();
        $newLectureElement->id_type = $arr['type'];
        $newLectureElement->id_page = $arr['pageId'];
        $newLectureElement->block_order = 0;
        $newLectureElement->html_block = $arr['condition'];
        $newLectureElement->saveCheck();

        $page = RevisionLecturePage::model()->findByPk($newLectureElement->id_page);
        if ($page != null) {
            $page->quiz = $newLectureElement->id;
            $page->update(array('quiz'));
        }

        switch($arr['type'])
        {
            case 'plain_task' :
                break;
            case LectureElement::TEST :
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

    public static function editQuiz($arr) {

        //todo refactor modify lecture element
        $lectureElementRevision = RevisionLectureElement::model()->findByPk($arr['idBlock']);
        $lectureElementRevision->html_block = $arr['condition'];
        $lectureElementRevision->update(array('html_block'));

        switch($lectureElementRevision->id_type)
        {
            case 'plain_task' :
                break;
            case LectureElement::TEST :
                $test = RevisionTests::model()->findByAttributes(array('id_lecture_element' => $lectureElementRevision->id));
                $test->editTest($arr['testTitle'], $arr['answers']);
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

    public static function deleteQuiz($idBlock) {
        //todo refactor deleting lecture element
        $lectureElementRevision = RevisionLectureElement::model()->findByPk($idBlock);

        switch($lectureElementRevision->id_type)
        {
            case 'plain_task' :
                break;
            case LectureElement::TEST :
                $test = RevisionTests::model()->findByAttributes(array('id_lecture_element' => $idBlock));
                if($test->deleteTest()) {
                    $test->delete();
                };
                break;
            case 'task' :
                break;
            case 'skip_task':
                break;
            default:
                break;
        }

        $lectureElementRevision->delete();
        return null;
    }
}