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
        return Yii::app()->user->model->isSuperVisor() || Yii::app()->user->model->isTrainer() || Yii::app()->user->model->isStudent();
    }

    public function actionIndex(){

        return $this->renderPartial('_index');
    }

    public function actionContent(){

        return $this->renderPartial('studentProgress');
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

        $filter=json_decode($filter);
        $criteria = new CDbCriteria();
        $criteria->with = ['idUser'];
        if(isset($filter->owner) && $filter->owner){
            $criteria->addInCondition('idUser.id',[Yii::app()->user->getId()]);
        }else if (!Yii::app()->user->model->isSuperVisor() && Yii::app()->user->model->isTrainer()){
            $studentsIdArray = [];
            $students = TrainerStudent::getStudentByTrainer(Yii::app()->user->id);
            foreach ($students as $student){
                array_push($studentsIdArray, $student->id);
            }
            $criteria->addInCondition('idUser.id',$studentsIdArray);
        }

        if ($filter->search){
            $criteria->addSearchCondition('idUser.email',$filter->search,true,'OR');
            $criteria->addSearchCondition('idUser.firstName',$filter->search,true,'OR');
            $criteria->addSearchCondition('idUser.secondName',$filter->search,true,'OR');
            $criteria->addSearchCondition('idUser.middleName',$filter->search,true,'OR');
        }
        if ($filter->group){
            $criteria->join = 'LEFT JOIN offline_students os ON t.id_user = os.id_user';
            $criteria->join .= ' LEFT JOIN offline_subgroups osg ON osg.id = os.id_subgroup';
            $criteria->join .= ' LEFT JOIN offline_groups og ON og.id = osg.group';
            $criteria->addCondition('og.id='.$filter->group.' and os.end_date IS NULL');
        }

        $model = Rating::getInstance($filter->service);
        $models = $model->count($criteria);
        $criteria->limit = $count;
        $criteria->offset = ($page-1)*$count;
        $ratingModels = $model::model()->findAll($criteria);
        $result = [];
        foreach ($ratingModels as $ratingModel){
            $rate = new PercentageProgress($ratingModel->id_user);
            array_push($result,[
                'user'=>$ratingModel->idUser->fullName(),
                'user_id'=>$ratingModel->idUser->id,
                'content_title'=>$ratingModel->getContentModel()->title_ua,
                'content_id'=>$ratingModel->getContentModel()->getId(),
                'progress' => $filter->service==Service::COURSE?
                    $rate->getCourseProgress($ratingModel->getContentModel()->getId()):$rate->getModuleProgress($ratingModel->getContentModel()->getId())
                ]);
        }
        echo CJSON::encode(['count'=>$models,'data'=>$result]);
    }

    public function actionGetCourseProgress($student,$course){
        $this->checkPermission($student,Service::COURSE, $course);

        $user = StudentReg::model()->findByPk((int)$student);
        $course = RatingUserCourse::model()->find('id_course=:idCourse AND id_user=:idUser',['idCourse'=>$course,'idUser'=>$student]);
        $result = [];
        if ($course){
            $modules = RevisionCourseModule::model()->findAll('id_course_revision=:idRevision',[':idRevision'=>$course->course_revision]);
            $rate = new PercentageProgress((int)$student);
            foreach ($modules as $module){
                array_push($result,[
                    'user_id'=>$student,
                    'content_title'=>$module->module->title_ua,
                    'content_id'=>$module->id_module,
                    'progress'=>$rate->getModuleProgress($module->id_module)
                ]);
            }
        }
        echo CJSON::encode( ['student'=>['id'=>$user->id,'fullName'=>$user->fullName()],'data'=>$result]);
    }

    public function actionGetModuleProgress($student,$module){
        $this->checkPermission($student, Service::MODULE, $module);

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
                array_push($result,[
                    'user_id'=>$student,
                    'content_title'=>$lectureTitle,
                    'content_id'=>$lecture->id,
                    'progress'=>array_intersect_key($rate->getLectureProgress($lecture->lecture),array_flip(['parts','passed','isDone']))
                ]);
            }
        }
        echo CJSON::encode(['student'=>['id'=>$user->id,'fullName'=>$user->fullName()],'data'=>$result]);
    }

    public function actionGetLectureProgress($student, $lecture){
        $lectureForPregress = RevisionModuleLecture::model()->with(['lecture'])->find('id=:lecture',['lecture'=>$lecture]);
        $this->checkPermission($student,Service::MODULE, $lectureForPregress->lecture->id_module);
        $user = StudentReg::model()->findByPk((int)$student);
        $rate = new PercentageProgress((int)$student);
        $data = $rate->getLectureElementProgress($lectureForPregress->lecture->id_lecture, true);
        echo CJSON::encode((array_merge(['student'=>['id'=>$user->id,'fullName'=>$user->fullName()]],$data)));
    }

    private function checkPermission($studentId, $service, $contentId){
        if (!Yii::app()->user->model->isSuperVisor()){
            if (Yii::app()->user->model->isTrainer()){
                $trainer = TrainerStudent::getTrainerByStudent($studentId);
                if (!$trainer || ($trainer->id != Yii::app()->user->id)){
                    throw new CHttpException(403,'Ви не є тренером даного студента, перегляд прогресу неможливий!');
                }
            }else if (Yii::app()->user->model->isStudent()){
                switch($service){
                    case Service::COURSE:
                        $model = RatingUserCourse::model()->findByPk($contentId);
                        break;
                    case Service::MODULE:
                        $model = RatingUserModule::model()->findByPk($contentId);
                        break;
                    default :
                        $model = null;
                }
                if (!$model || ($studentId != Yii::app()->user->id)){
                    throw new CHttpException(403,'Ви не маєте доступу, перегляд прогресу неможливий!');
                }
            }
        }
    }

    public function actionGetLectureRating($student,$module,$index=false){
        $this->checkPermission($student, Service::MODULE, $module);
        $result = [];
        $module = RatingUserModule::model()->find('id_module=:idModule AND id_user=:idUser',['idModule'=>$module,'idUser'=>$student]);
        if ($module){
            $rate = new PercentageProgress((int)$student);
            $criteria = new CDbCriteria();
            $criteria->addCondition('id_module_revision=:moduleRevision');
            $criteria->params = [':moduleRevision' => $module->module_revision];
            $criteria->order = 'lecture_order';
            $lectures = RevisionModuleLecture::model()->with(['lecture'])->findAll($criteria);
            foreach ($lectures as $key=>$lecture){
                $rat=(($index!==false && $index==$key) || $index===false)?Lecture::model()->find('id = :lectureId',['lectureId'=>$lectures[$key]->lecture->id_lecture])->getLectureRate($rate->getUserId()):false;
                array_push($result, $rat);
            }
        }
        echo CJSON::encode($result);
    }
}