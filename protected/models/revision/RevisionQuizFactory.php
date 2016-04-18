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

    public static function deleteQuiz($idLectureElement) {
        //todo refactor deleting lecture element
        $lectureElementRevision = RevisionLectureElement::model()->findByPk($idLectureElement);

        switch($lectureElementRevision->id_type)
        {
            case 'plain_task' :
                break;
            case LectureElement::TEST :
                $test = RevisionTests::model()->findByAttributes(array('id_lecture_element' => $idLectureElement));
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

    /**
     * @param RevisionLectureElement $lectureElementOld
     * @param RevisionLectureElement $lectureElementNew
     * @return array|mixed|null
     */
    public static function cloneQuiz($lectureElementOld, $lectureElementNew){
        switch($lectureElementOld->id_type)
        {
            case 'plain_task' :
                break;
            case LectureElement::TEST :
                $test = RevisionTests::model()->findByAttributes(array('id_lecture_element' => $lectureElementOld->id));
                $test->cloneTest($lectureElementNew->id);
                return $test;
                break;
            case 'task' :
                break;
            case 'skip_task':
                break;
            default:
                break;
        }
    }

    public static function saveToRegularDB($revisionLectureElement, $newLectureElement, $idUserCreated) {
        switch($newLectureElement->id_type)
        {
            case 'plain_task' :
                break;
            case LectureElement::TEST :
                $test = RevisionTests::model()->findByAttributes(array('id_lecture_element' => $revisionLectureElement->id));
                return $test->saveToRegularDB($newLectureElement->id_block, $idUserCreated);
                break;
            case 'task' :
                break;
            case 'skip_task':
                break;
            default:
                break;
        }
    }

    public static function deleteQuizesFromRegularDB($quizes) {
        foreach ($quizes as $idType => $idElements) {
            if (count($idElements)>0) {
                switch($idType)
                {
                    case 'plain_task' :
                        break;
                    case LectureElement::TEST :
                        foreach ($idElements as $element) {
                            $test = Tests::model()->findByAttributes(array('block_element'=>$element));
                            $testAnswers = TestsAnswers::model()->findAllByAttributes(array('id_test'=>$test->id));
                            foreach ($testAnswers as $testAnswer) {
                                $testAnswer->delete();
                            }
                            $test->delete();
                        }
                        break;
                    case 'task' :
                        break;
                    case 'skip_task':
                        break;
                    default:
                        break;
                }
            }
        }
    }
}