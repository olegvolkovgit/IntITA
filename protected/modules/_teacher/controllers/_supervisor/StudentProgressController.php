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

    public function actionGetUsers($page=1,$count=10,$filter=null){

        $criteria = new CDbCriteria();

        if ($filter){
            $criteria->with = ['idUser'];
            $criteria->addSearchCondition('idUser.email',$filter,true,'OR');
            $criteria->addSearchCondition('idUser.firstName',$filter,true,'OR');
            $criteria->addSearchCondition('idUser.secondName',$filter,true,'OR');
            $criteria->addSearchCondition('idUser.middleName',$filter,true,'OR');
        }
        $models = RatingUserCourse::model()->count($criteria);
        $criteria->limit = $count;
        $criteria->offset = ($page-1)*$count;
        $ratingModels = RatingUserCourse::model()->findAll($criteria);;
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
        $user = StudentReg::model()->findByPk((int)$student);
        $course = RatingUserCourse::model()->find('id_course=:idCourse AND id_user=:idUser',['idCourse'=>$course,'idUser'=>$student]);
        $result = [];
        if ($course){
            $modules = RevisionCourseModule::model()->findAll('id_course_revision=:idRevision',[':idRevision'=>$course->course_revision]);
            $rate = new PercentageProgress((int)$student);
            foreach ($modules as $module){
                array_push($result, ['module'=>$module->module->title_ua,'idModule'=>$module->id_module, 'progress'=>$rate->getModuleProgress($module)]);
            }
        }
        echo CJSON::encode( ['student'=>['id'=>$user->id,'fullName'=>$user->fullName()],'data'=>$result]);
    }

    public function actionGetModuleProgress($student,$module){
        $result = [];
        $user = StudentReg::model()->findByPk((int)$student);
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

                array_push($result, ['lecture'=>$lectureTitle,'id_lecture'=>$lecture->id,
                    'progress'=>array_intersect_key($rate->getLectureProgress($lecture->lecture),array_flip(['lecturePages','passedPages','isDone']))]);
            }
        }
        echo CJSON::encode(['student'=>['id'=>$user->id,'fullName'=>$user->fullName()],'data'=>$result]);
    }

    public function actionGetLectureProgress($student, $lecture){
        $lectureForPregress = RevisionModuleLecture::model()->with(['lecture'])->find('id=:lecture',['lecture'=>$lecture]);
        $user = StudentReg::model()->findByPk((int)$student);
        $rate = new PercentageProgress((int)$student);
        $data = $rate->getLectureElementProgress($lectureForPregress->lecture->id_lecture);
        echo CJSON::encode((array_merge(['student'=>['id'=>$user->id,'fullName'=>$user->fullName()]],$data)));
    }

}