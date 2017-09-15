<?php
/**
 * Created by PhpStorm.
 * User: Adm
 * Date: 14.09.2017
 * Time: 15:49
 */


class PercentageProgress
{
    private $userId;

    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    public function getCourseProgress($course){
        $result = 0;
        $courceForRating = $users = RatingUserCourse::model()->find('id_course=:idCourse AND id_user = :idUser',['idUser'=>$this->userId, 'idCourse'=>$course]);
        if ($courceForRating->course_done == 1 ){
            $result = 100;
        }
        else{
            $modules = RevisionCourseModule::model()->findAll('id_course_revision=:idRevision',[':idRevision'=>$courceForRating->course_revision]);
            $passedModules = 0;
            foreach ($modules as $module){
                $rateModule = RatingUserModule::model()->find('id_module=:module AND id_user=:user AND module_done = 1',[':module'=>$module->id_module,':user'=>$this->userId]);
                if ($rateModule){
                    $passedModules++;
                }
            }
            if ($passedModules){
                $result = round(($passedModules/count($modules))*100,2);
            }

        }
        return $result;
    }

    public function getModuleProgress($module){
        $progress = 0;
        $rateModule = RatingUserModule::model()->find('id_user=:idUser AND id_module=:idModule',
            ['idUser'=>$this->userId,'idModule'=>$module->id_module]);
        if ($rateModule) {
            if ($rateModule->module_done) {
                $progress = 100;
            } else {
                $criteria = new CDbCriteria();
                $criteria->addCondition('id_module_revision=:moduleRevision');
                $criteria->params = [':moduleRevision' => $rateModule->module_revision];
                $criteria->order = 'lecture_order';
                $lectures = RevisionModuleLecture::model()->with(['lecture'])->findAll($criteria);
                foreach ($lectures as $lecture) {
                    $progress += $this->getLectureProgress($lecture->lecture);
                }
                $progress = round(($progress / count($lectures)*100),2);
            }
        }
        return $progress;

    }

    public function getLectureProgress($lecture){
        $lectureRate = 0;
        $plainTasks = LectureElement::model()->findAll('id_lecture=:lecture AND id_type = 6',[':lecture'=>$lecture->id_lecture]);
        $skipTasks = LectureElement::model()->with('skipTask')->findAll('id_lecture=:lecture AND id_type = 9 AND skipTask.condition IS NOT NULL',[':lecture'=>$lecture->id_lecture]);
        $ohterTasks = LectureElement::model()->findAll('id_lecture=:lecture AND id_type IN (5,12,13)',[':lecture'=>$lecture->id_lecture]);

        $tasks = array_merge($ohterTasks,$skipTasks, $plainTasks);

        foreach ($tasks as $task){
            switch ($task->id_type){
                case LectureElement::TEST;
                    $answers =TestsMarks::model()->with(['lectureElement'])->findAll('id_block=:block AND id_user=:user',['block'=>$task->id_block, ':user'=>$this->userId]);
                    foreach ($answers as $key=>$answer){
                        if ($answer->mark){
                            $lectureRate ++;
                            break;
                        }
                    }
                    unset($key);
                    unset($answer);
                    unset($answersCount);
                    break;
                case LectureElement::SKIP_TASK;
                    $answers =SkipTaskMarks::model()->with(['lectureElement'])->findAll('id_block=:block AND user=:user',['block'=>$task->id_block, ':user'=>$this->userId]);
                    $answersCount = 0;
                    foreach ($answers as $key=>$answer){
                        if ($answer->mark){
                            $lectureRate ++;
                            break;
                        }
                    }
                    break;
                case LectureElement::PLAIN_TASK;
                    $answers =PlainTaskMarks::model()->with(['lectureElement'])->findAll('id_block=:block AND id_user=:user',['block'=>$task->id_block, ':user'=>$this->userId]);
                    foreach ($answers as $key=>$answer){
                        if ($answer->mark){
                            $lectureRate ++;
                            break;
                        }
                    }
                    break;
                case LectureElement::TASK;
                    $answers = TaskMarks::model()->with(['lectureElement'])->findAll('id_lecture=:lecture AND id_user=:user',[':lecture'=>$lecture->id_lecture, ':user'=>$this->userId]);
                    foreach ($answers as $key=>$answer){
                        if ($answer->mark){
                            $lectureRate ++;
                            break;
                        }
                    }
                    break;
            }
        }
        if($tasks){
            return(double)$lectureRate/count($tasks);
        }
        else{
            return 0;
        }

    }

    public function getLectureElementProgress($lecturePage){
        $result = [];
        $elements = $lecturePage->lectureElements;
        $countOfAnswers = 0;
        $passedLectureElement = false;

        foreach ($elements as $lectureElement){
            //$lectureElement=LectureElement::model()->find('id_block=:element',['element'=>$element['element']]);
            switch ($lectureElement->id_type){
                case LectureElement::TEST;
                    $answers =TestsMarks::model()->with(['lectureElement'])->findAll('id_block=:block AND id_user=:user',['block'=>$lectureElement->id_block, ':user'=>$this->userId]);
                    foreach ($answers as $key=>$answer){
                        if ($answer->mark){
                            $passedLectureElement = true;
                        }
                        $countOfAnswers ++;
                    }
                    unset($key);
                    unset($answer);
                    break;
                case LectureElement::SKIP_TASK;
                    $answers =SkipTaskMarks::model()->with(['lectureElement'])->findAll('id_block=:block AND user=:user',['block'=>$lectureElement->id_block, ':user'=>$this->userId]);
                    foreach ($answers as $key=>$answer){
                        if ($answer->mark){
                            $passedLectureElement = true;
                        }
                        $countOfAnswers ++;
                    }
                    unset($key);
                    unset($answer);
                    break;
                case LectureElement::PLAIN_TASK;
                    $answers =PlainTaskMarks::model()->with(['lectureElement'])->findAll('id_block=:block AND id_user=:user',['block'=>$lectureElement->id_block, ':user'=>$this->userId]);
                    foreach ($answers as $key=>$answer){
                        if ($answer->mark){
                            $passedLectureElement = true;
                        }
                        $countOfAnswers ++;
                    }
                    unset($key);
                    unset($answer);
                    break;
                case LectureElement::TASK;
                    $answers = TaskMarks::model()->with(['lectureElement'])->findAll('id_lecture=:lecture AND id_user=:user',[':lecture'=>$lectureElement->id_lecture, ':user'=>$this->userId]);
                    foreach ($answers as $key=>$answer){
                        if ($answer->mark){
                            $passedLectureElement = true;
                        }
                        $countOfAnswers ++;
                    }
                    unset($key);
                    unset($answer);
                    break;
            }
        }
        $result = ['countOfAnswers'=>$countOfAnswers,'lecturePassed'=>$passedLectureElement];
        return $result;
    }
}