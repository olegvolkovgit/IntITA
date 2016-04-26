<?php

class RevisionQuizFactory
{
    /**
     * Factory method to create new quiz
     * @param RevisionLectureElement $lectureElement
     * @param array $quiz
     *
     * For test
     * ['testTitle' => 'foo',
     *  'answers' => [
     *          0 => ['answer' => 'RevisionTestAnswer->answer', 'is_valid' => RevisionTestAnswer->is_valid]
     *          ...
     *      ]
     * ]
     * @return RevisionTests|null
     */
    public static function create($lectureElement, $quiz)
    {
        switch($lectureElement->id_type)
        {
            case 'plain_task' :
                break;
            case LectureElement::TEST :
                return RevisionTests::createTest($lectureElement->id, $quiz['testTitle'], $quiz['answers']);
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

    /**
     * Factory method to edit quiz
     * @param RevisionLectureElement $revLectureElement
     * @param array $arr of following structure
     *
     * For test
     * ['testTitle' => 'foo',
     *  'answers' => [
     *          0 => ['answer' => 'RevisionTestAnswer->answer', 'is_valid' => RevisionTestAnswer->is_valid]
     *          ...
     *      ]
     * ]
     * @return bool|null
     */
    public static function edit($revLectureElement, $quiz) {
        switch($revLectureElement->id_type)
        {
            case 'plain_task' :
                break;
            case LectureElement::TEST :
                $test = RevisionTests::model()->findByAttributes(array('id_lecture_element' => $revLectureElement->id));
                if ($test) {
                    $test->editTest($quiz['testTitle'], $quiz['answers']);
                    return $test;
                }
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

    /**
     * Deletes quiz revision
     * @param $revLectureElementId
     * @param $revLectureElementType
     * @return null
     * @throws CDbException
     */
    public static function delete($revLectureElementId, $revLectureElementType) {
        switch($revLectureElementType)
        {
            case 'plain_task' :
                break;
            case LectureElement::TEST :
                $test = RevisionTests::model()->findByAttributes(array('id_lecture_element' => $revLectureElementId));
                return $test->delete();
                break;
            case 'task' :
                break;
            case 'skip_task':
                break;
            default:
                break;
        }
        return false;
    }

    /**
     * Clone quiz model into new revision
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

    /**
     * Save RevisionTest into regular DB
     * @param RevisionLectureElement $revisionLectureElement
     * @param LectureElement $newLectureElement
     * @param $idUserCreated
     * @return Tests
     */
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

    /**
     * Deletes quizzes.
     * @param $quizzes
     * @throws CDbException
     */
    public static function deleteFromRegularDB($quizzes) {
        foreach ($quizzes as $idType => $idElements) {
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

    /**
     * Creates quiz revision from existing lecture
     * @param LectureElement $lectureElement
     * @param RevisionLectureElement $revisionLectureElement
     * @return RevisionTests
     */
    public static function createFromLecture($lectureElement, $revisionLectureElement) {
        switch($lectureElement->id_type)
        {
            case 'plain_task' :
                break;
            case LectureElement::TEST:
                    $oldTest = Tests::model()->findByAttributes(array('block_element' => $lectureElement->id_block));
                    $oldTestAnswers = TestsAnswers::model()->findAllByAttributes(['id_test' => $oldTest->id]);
                    $answers = [];
                    foreach ($oldTestAnswers as $answer) {
                        array_push($answers, ['answer' => $answer->answer, 'is_valid' => $answer->is_valid]);
                    }
                    return RevisionTests::createTest($revisionLectureElement->id, $oldTest->title, $answers);
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