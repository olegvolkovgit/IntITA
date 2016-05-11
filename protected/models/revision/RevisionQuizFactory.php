<?php

class RevisionQuizFactory {


    /**
     * @param integer $idType
     * @param CHttpRequest $request
     * @return array
     */
    public static function getQuizParams($idType, $request) {

        $quiz = [];
        switch ($idType) {
            case LectureElement::PLAIN_TASK:
                break;
            case LectureElement::TEST:
                $optionsNum = $request->getPost('optionsNum', 0); //options amount
                $quiz['testTitle'] = $request->getPost('testTitle', '');
                $options = [];
                for ($i = 0; $i < $optionsNum; $i++) {
                    $options[$i]["answer"] = trim($request->getPost("answer" . ($i + 1), ''));
                    $options[$i]["is_valid"] = trim($request->getPost("is_valid" . ($i + 1), 0));
                }
                $quiz['answers'] = $options;
                break;
            case LectureElement::TASK:
                $quiz['language'] = $request->getPost('lang', 'c++');
                $quiz['assignment'] = $request->getPost('assignment', 0);
                $quiz['table'] = $request->getPost('table', '');
                break;
            case LectureElement::SKIP_TASK:
                $quiz['question'] = $request->getPost('text');      //question
                $quiz['source'] = $request->getPost('question');            //skip task
                $quiz['answers'] = $request->getPost('answer', null);   // 2D array - index value caseSensetive
                break;
        }
        return $quiz;
    }

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
     *
     * For task
     * ['assignment' => 'foo', 'language' => 'bar', 'table' => 'baz']
     *
     * @return RevisionTests|null
     */
    public static function create($lectureElement, $quiz) {
        switch ($lectureElement->id_type) {
            case LectureElement::PLAIN_TASK :
                return RevisionPlainTask::createTest($lectureElement->id);
                break;
            case LectureElement::TEST :
                return RevisionTests::createTest($lectureElement->id, $quiz['testTitle'], $quiz['answers']);
                break;
            case LectureElement::TASK :
                return RevisionTask::createTest($lectureElement->id, $quiz['assignment'], $quiz['language'], $quiz['table']);
                break;
            case LectureElement::SKIP_TASK:
                return RevisionSkipTask::createTest($lectureElement->id, $quiz['question'], $quiz['source'], $quiz['answers']);
                break;
            default:
                break;
        }
        return null;
    }

    /**
     * Factory method to edit quiz
     * @param RevisionLectureElement $revLectureElement
     * @param $quiz
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
        switch ($revLectureElement->id_type) {
            case LectureElement::PLAIN_TASK :
                break;
            case LectureElement::TEST :
                $test = RevisionTests::model()->findByAttributes(array('id_lecture_element' => $revLectureElement->id));
                if ($test) {
                    $test->editTest($quiz['testTitle'], $quiz['answers']);
                }
                return $test;
                break;
            case LectureElement::TASK :
                $test = RevisionTask::model()->findByAttributes(array('id_lecture_element' => $revLectureElement->id));
                if ($test) {
                    $test->editTest($quiz['assignment'], $quiz['language'], $quiz['table']);
                }
                return $test;
                break;
            case LectureElement::SKIP_TASK:
                $test = RevisionSkipTask::model()->findByAttributes(array('condition' => $revLectureElement->id));
                return $test->editTest($quiz['question'], $quiz['source'], $quiz['answers']);
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
        switch ($revLectureElementType) {
            case LectureElement::PLAIN_TASK :
                $test = RevisionPlainTask::model()->findByAttributes(array('id_lecture_element' => $revLectureElementId));
                if ($test) {
                    return $test->delete();
                }
                return true;
                break;
            case LectureElement::TEST :
                $test = RevisionTests::model()->findByAttributes(array('id_lecture_element' => $revLectureElementId));
                if ($test) {
                    return $test->delete();
                }
                return true;
                break;
            case LectureElement::TASK :
                $test = RevisionTask::model()->findByAttributes(array('id_lecture_element' => $revLectureElementId));
                if ($test) {
                    return $test->delete();
                }
                return true;
                break;
            case LectureElement::SKIP_TASK:
                $test = RevisionSkipTask::model()->findByAttributes(array('condition' => $revLectureElementId));
                if ($test) {
                    return $test->delete();
                }
                return true;
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
    public static function cloneQuiz($lectureElementOld, $lectureElementNew) {
        switch ($lectureElementOld->id_type) {
            case LectureElement::PLAIN_TASK :
                $test = RevisionPlainTask::model()->findByAttributes(array('id_lecture_element' => $lectureElementOld->id));
                return $test->cloneTest($lectureElementNew->id);
                break;
            case LectureElement::TEST :
                $test = RevisionTests::model()->findByAttributes(array('id_lecture_element' => $lectureElementOld->id));
                return $test->cloneTest($lectureElementNew->id);
                break;
            case LectureElement::TASK :
                $test = RevisionTask::model()->findByAttributes(array('id_lecture_element' => $lectureElementOld->id));
                return $test->cloneTest($lectureElementNew->id);
                break;
            case LectureElement::SKIP_TASK:
                $test = RevisionSkipTask::model()->findByAttributes(array('condition' => $lectureElementOld->id));
                return $test->cloneTest($lectureElementNew->id);
                break;
            default:
                return null;
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
        switch ($newLectureElement->id_type) {
            case LectureElement::PLAIN_TASK :
                $test = RevisionPlainTask::model()->findByAttributes(['id_lecture_element' => $revisionLectureElement->id]);
                return $test->saveToRegularDB($newLectureElement->id_block, $idUserCreated);
                break;
            case LectureElement::TEST :
                $test = RevisionTests::model()->findByAttributes(array('id_lecture_element' => $revisionLectureElement->id));
                return $test->saveToRegularDB($newLectureElement->id_block, $idUserCreated);
                break;
            case LectureElement::TASK :
                $test = RevisionTask::model()->findByAttributes(array('id_lecture_element' => $revisionLectureElement->id));
                return $test->saveToRegularDB($newLectureElement->id_block, $idUserCreated);
                break;
            case LectureElement::SKIP_TASK:
                $test = RevisionSkipTask::model()->findByAttributes(array('condition' => $revisionLectureElement->id));
                return $test->saveToRegularDB($newLectureElement, $idUserCreated);
                break;
            default:
                return null;
                break;
        }
    }

    /**
     * Deletes quizzes.
     *
     *   [
     *      idType => [
     *                  id_lecture_element
     *                ]
     *   ]
     * @param $quizzes
     * @throws CDbException
     */
    public static function deleteFromRegularDB($quizzes) {
        foreach ($quizzes as $idType => $idElements) {
            foreach ($idElements as $element) {
                switch ($idType) {
                    case LectureElement::PLAIN_TASK :
                        $test = PlainTask::model()->findByAttributes(array('block_element' => $element));
                        if ($test) {
                            $test->delete();
                        }
                        break;
                    case LectureElement::TEST :
                        $test = Tests::model()->findByAttributes(array('block_element' => $element));
                        $testAnswers = TestsAnswers::model()->findAllByAttributes(array('id_test' => $test->id));
                        foreach ($testAnswers as $testAnswer) {
                            $testAnswer->delete();
                        }
                        if ($test) {
                            $test->delete();
                        }
                        break;
                    case LectureElement::TASK :
                        $test = Task::model()->findByAttributes(array('condition' => $element));
                        if ($test) {
                            $test->delete();
                        }
                        break;
                    case LectureElement::SKIP_TASK:
                        $test = SkipTask::model()->findByAttributes(['condition' => $element]);
                        if ($test) {
                            $questionLE = LectureElement::model()->findByPk($test->question);
                            foreach ($test->skipTaskAnswers as $answer) {
                                $answer->delete();
                            }
                            $test->delete();
                            $questionLE->delete();
                        }
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
        switch ($lectureElement->id_type) {
            case LectureElement::PLAIN_TASK :
                $oldTest = PlainTask::model()->findByAttributes(array('block_element' => $lectureElement->id_block));
                return RevisionPlainTask::createTest($revisionLectureElement->id, $oldTest->id);
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
            case LectureElement::TASK :
                $oldTask = Task::model()->findByAttributes(array('condition' => $lectureElement->id_block));
                return RevisionTask::createTest($revisionLectureElement->id, $oldTask->assignment, $oldTask->language, $oldTask->table, $oldTask->id);
                break;
            case LectureElement::SKIP_TASK:
                $oldTask = SkipTask::model()->findByAttributes(['condition' => $lectureElement->id_block]);
                $questionLE = $oldTask->question0;
                $answers = [];
                foreach ($oldTask->skipTaskAnswers   as $answer) {
                    array_push($answers, ['value' => $answer->answer, 'caseInSensitive' => $answer->case_in_sensitive, 'index' => $answer->answer_order]);
                }
                return RevisionSkipTask::createTest($revisionLectureElement->id, $questionLE->html_block, $oldTask->source, $answers, $oldTask->id);
                break;
            default:
                break;
        }
    }
}