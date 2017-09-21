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
        $result = ['modules'=>1,'passedModules'=>0,'isDone'=>false];
        $courceForRating = $users = RatingUserCourse::model()->find('id_course=:idCourse AND id_user = :idUser',['idUser'=>$this->userId, 'idCourse'=>$course]);
        if ($courceForRating->course_done == 1 ){
            $result['passedModules'] = 1;
            $result['isDone'] = true;
        }
        else{
            $modules = RevisionCourseModule::model()->findAll('id_course_revision=:idRevision',[':idRevision'=>$courceForRating->course_revision]);
            $passedModules = 0;
            $result['modules'] = count($modules);
            foreach ($modules as $module){
                $rateModule = RatingUserModule::model()->find('id_module=:module AND id_user=:user AND module_done = 1',[':module'=>$module->id_module,':user'=>$this->userId]);
                if ($rateModule){
                    $passedModules++;
                }
            }
            $result['passedModules'] = $passedModules;
            $result['isDone'] = false;


        }
        return $result;
    }

    public function getModuleProgress($module){
        $result = ['lectures'=>1,'passedLectures'=>0,'isDone'=>false];
        $rateModule = RatingUserModule::model()->find('id_user=:idUser AND id_module=:idModule',
            ['idUser'=>$this->userId,'idModule'=>$module->id_module]);
        if ($rateModule) {
            if ($rateModule->module_done) {
                $result = ['lectures'=>1,'passedLectures'=>1,'isDone'=>true];
            } else {
                $criteria = new CDbCriteria();
                $criteria->addCondition('id_module_revision=:moduleRevision');
                $criteria->params = [':moduleRevision' => $rateModule->module_revision];
                $criteria->order = 'lecture_order';
                $lectures = RevisionModuleLecture::model()->with(['lecture'])->findAll($criteria);
                $progress = [];
                foreach ($lectures as $lecture) {
                    array_push($progress,$this->getLectureProgress($lecture->lecture));
                }
                $result['lectures'] = count($progress);
                $result['passedLectures'] = count(array_filter($progress,function($value){
                    if($value['isDone']) return $value;
                }));
                $result['isDone'] = false;

            }
        }
        return $result;

    }

    public function getLectureProgress($lecture){
        $result =$this->getLectureElementProgress($lecture->id_lecture);
         ($result['lecturePages'] === $result['passedPages'])?$result['isDone'] = true:$result['isDone'] = false;
        return $result;

    }

    public function getLectureElementProgress($lecture_id){
        $criteria = new CDbCriteria;
        $criteria->alias = 'lecture_page';
        $criteria->order = 'page_order ASC';
        $criteria->condition = 'id_lecture=' . $lecture_id;
        $pages = LecturePage::model()->findAll($criteria);
        $result = [];
        foreach ($pages as $page){
            array_push($result,[
               'title'=>$page->page_title,
               'order' => $page->page_order,
               'isDone' => LecturePage::isQuizDone($page->quiz, $this->userId),
            ]);
        }
        $passdPages = count (array_filter($result,function($value){
            if($value['isDone']) return $value;
        }));
        return ['lecturePages'=>count($pages),'passedPages'=>$passdPages,'data'=>$result];
    }

}