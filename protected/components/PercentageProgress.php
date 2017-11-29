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
        $result = ['parts'=>1,'passed'=>0,'isDone'=>false];
        $courceForRating = $users = RatingUserCourse::model()->find('id_course=:idCourse AND id_user = :idUser',['idUser'=>$this->userId, 'idCourse'=>$course]);
        if ($courceForRating->course_done == 1 ){
            $result['passed'] = 1;
            $result['isDone'] = true;
            $result['rating'] = $courceForRating->rating;
        }
        else{
            $modules = RevisionCourseModule::model()->findAll('id_course_revision=:idRevision',[':idRevision'=>$courceForRating->course_revision]);
            $passedModules = 0;
            $result['parts'] = count($modules);
            foreach ($modules as $module){
                $rateModule = RatingUserModule::model()->find('id_module=:module AND id_user=:user AND module_done = 1',[':module'=>$module->id_module,':user'=>$this->userId]);
                if ($rateModule){
                    $passedModules++;
                }
            }
            $result['passed'] = $passedModules;
            $result['isDone'] = false;
            $result['rating'] = $courceForRating->rating;

        }
        return $result;
    }

    public function getModuleProgress($module){
        $result = ['parts'=>1,'passed'=>0,'isDone'=>false];
        $rateModule = RatingUserModule::model()->find('id_user=:idUser AND id_module=:idModule',
            ['idUser'=>$this->userId,'idModule'=>$module]);
        if ($rateModule) {
            if ($rateModule->module_done) {
                $result = ['parts'=>1,'passed'=>1,'isDone'=>true,'rating'=>$rateModule->rating];
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
                $result['parts'] = count($progress);
                $result['passed'] = count(array_filter($progress,function($value){
                    if($value['isDone']) return $value;
                }));
                $result['isDone'] = false;
            }
        }
        return $result;

    }

    public function getLectureProgress($lecture){
        $result =$this->getLectureElementProgress($lecture->id_lecture);
        ($result['parts'] === $result['passed'])?$result['isDone'] = true:$result['isDone'] = false;
        return $result;
    }

    public function getLectureElementProgress($lecture_id, $pageProgress=false){
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
                'rating' => $pageProgress?$page->getPageRate($this->userId):false,
                'link'=>Yii::app()->createUrl("lesson/index", array("id" => $lecture_id, "idCourse" => 0)).'#/page'.$page->page_order
            ]);
        }

        $passdPages = count (array_filter($result,function($value){
            if($value['isDone']) return $value;
        }));
        return ['parts'=>count($pages),'passed'=>$passdPages,'data'=>$result];
    }

    public function getUserId()
    {
        return $this->userId;
    }

}