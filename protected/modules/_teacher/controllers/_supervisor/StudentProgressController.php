<?php
/**
 * Created by PhpStorm.
 * User: Adm
 * Date: 14.09.2017
 * Time: 12:26
 */




class StudentProgressController extends TeacherCabinetController
{
    public function hasRole()
    {

        return Yii::app()->user->model->isSuperVisor();
    }

    public function actionIndex(){

        return $this->renderPartial('_index');
    }

    public function actionCourseProgress(){
        return $this->renderPartial('_courseProgress');
    }

    public function actionModuleProgress(){
        return $this->renderPartial('_moduleProgress');
    }

    public function actionLectureProgress(){
        return $this->renderPartial('_lectureProgress');
    }

    public function actionGetUsers($page=1,$count=10){
        $criteria = new CDbCriteria();
        $users = RatingUserCourse::model();
        $models = $users->count();
        $criteria->limit = $count;
        $criteria->offset = $page*$count;
        $ratingModels = $users->findAll($criteria);
        $result = [];
        foreach ($ratingModels as $ratingModel){
            $rate = new PercentageProgress($ratingModel->id_user);
            array_push($result,[
                'user'=>$ratingModel->idUser->fullName(),
                'user_id'=>$ratingModel->idUser->id,
                'course'=>$ratingModel->idCourse->title_ua,
                'course_id'=>$ratingModel->idCourse->course_ID,
                'progress' => $rate->getCourseProgress($ratingModel->idCourse->course_ID)
                ]);
        }
        echo CJSON::encode(['count'=>$models,'data'=>$result]);
    }

    public function actionGetCourseProgress($student,$course){
        $course = RatingUserCourse::model()->find('id_course=:idCourse AND id_user=:idUser',['idCourse'=>$course,'idUser'=>$student]);
        $result = [];
        if ($course){
            $modules = RevisionCourseModule::model()->findAll('id_course_revision=:idRevision',[':idRevision'=>$course->course_revision]);
            $rate = new PercentageProgress((int)$student);
            foreach ($modules as $module){
                array_push($result, ['student'=>$student,'module'=>$module->module->title_ua,'idModule'=>$module->id_module, 'progress'=>$rate->getModuleProgress($module)]);
            }
        }
        echo CJSON::encode(['data'=>$result]);
    }

    public function actionGetModuleProgress($student,$module){
        $result = [];
        $criteria = new CDbCriteria();
        $module = RatingUserModule::model()->find('id_module=:idModule AND id_user=:idUser',['idModule'=>$module,'idUser'=>$student]);
        if ($module){
            $rate = new PercentageProgress((int)$student);
            $criteria = new CDbCriteria();
            $criteria->addCondition('id_module_revision=:moduleRevision');
            $criteria->params = [':moduleRevision' => $module->module_revision];
            $criteria->order = 'lecture_order';
            $lectures = RevisionModuleLecture::model()->with(['lecture'])->findAll($criteria);
            foreach ($lectures as $lecture){
                $lectureTitle = Lecture::model()->find('id = :lectureId',['lectureId'=>$lecture->lecture->id_lecture])->attributes['title_ua'];
                array_push($result, ['student'=>$student,'lecture'=>$lectureTitle,'id_lecture'=>$lecture->id,'progress'=>round(($rate->getLectureProgress($lecture->lecture)*100),2)]);
            }
        }
        echo CJSON::encode(['data'=>$result]);
    }

    public function actionGetLectureProgress($student, $lecture){
        $lectureForPregress = RevisionModuleLecture::model()->with(['lecture'])->find('id=:lecture',['lecture'=>$lecture]);
        $passed = Lecture::model()->findByPk($lectureForPregress->lecture->id_lecture)->accessPages($student);
        $isDoneElements = count(array_filter($passed,function($value){
            if ($value['isDone']){
                return $value;
            }
        }));


        echo CJSON::encode(['data'=>$passed]);
    }


}