<?php

class ConsultationscalendarController extends Controller
{
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function filters()
	{
		return array(
			'accessControl',
		);
	}

	public function init()
	{
		$app = Yii::app();
        $this->pageTitle = $app->name;
		if (isset($app->session['lg'])) {
			$app->language = $app->session['lg'];
		}
		if (Yii::app()->user->isGuest) {
			$this->render('/site/authorize');
			die();
		}else return true;
	}

	public function accessRules()
	{
		return array(
			array('deny',
				'users'=>array('?'),
			),
		);
	}

	public function initialize($id,$idCourse)
	{
		$lecture = Lecture::model()->findByPk($id);
		if(!$lecture)
			throw new \application\components\Exceptions\IntItaException('404', Yii::t('lecture', '0810'));
		if(!Yii::app()->user->model->hasLectureAccess($lecture, $idCourse))
			throw new \application\components\Exceptions\IntItaException('403', Yii::app()->user->model->lectureAccessErrorMessage);
	}

	/**
	 * Lists all available consultants.
	 */
	public function actionIndex($lectureId, $idCourse=0)
	{
		$this->initialize($lectureId,$idCourse);

        $lecture = Lecture::model()->findByPk($lectureId);
        $dataProvider = $lecture->module->getTeacherConsultant(Yii::app()->user->getId());

		$this->render('index',array(
			'dataProvider'=>$dataProvider,
            'lecture'=>$lecture,
            'user' => Yii::app()->user->model,
            'idCourse'=>$idCourse,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Consultationscalendar the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Consultationscalendar::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

    public function actionSaveconsultation($idCourse){
        $date = Yii::app()->request->getPost('datecons');
        $id_teacher = Yii::app()->request->getPost('teacherid');
        $teacher = StudentReg::model()->findByPk($id_teacher);
        $id_student = Yii::app()->user->getId();
        $student = StudentReg::model()->findByPk($id_student);
        $id_lecture = Yii::app()->request->getPost('lectureid');
        $result = array();

        $numcons = explode(",", Yii::app()->request->getPost('timecons'));

        for($i=0; $i< count($numcons); $i++){
            $start_time = $date." ". explode("-",$numcons[$i])[0].":00";
            $temp = "Дата - ".$date.", години - ".$numcons[$i];
            array_push($result, $temp);

            $free_time = TeacherCalendarConsultation::model()->find("(date=:date and teacher_id=:teacher_id and start_time=:start_time)", array(':date' => $date, ':teacher_id' => $id_teacher, ':start_time' => $start_time));

            if( $free_time->status == 1 ){
                $free_time->status = 2;
                $free_time->lecture_id = $id_lecture;
                $free_time->user_id = Yii::app()->user->getId();
                //var_dump($free_time->status,$free_time->start_time,$free_time->lecture_id,$free_time->user_id);
                $free_time->save();
            }else{
                $result = array();
                $this->render('consultationerror',array(
                    'lecture'=>$id_lecture,'idCourse'=>$idCourse
                ));
            }
        }

        if( !empty($result) ){
            $params[0] = $result;
            $params[1] = $student->fullName;
            $teacher->notify('_reserveConsultation', array($params), 'Замовлено консультацію');
        }
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    public function actionDeleteconsultation($id)
    {
		$model = Consultationscalendar::model()->findByPk($id);
        $user = RegisteredUser::userById(Yii::app()->user->getId());
		$model->deleteConsultation($user);

        if(!isset($_GET['ajax']))
            $this->redirect(Yii::app()->request->urlReferrer);
    }

    public function actionConsultationError($lecture, $idCourse)
    {
        $this->render('consultationerror',array(
            'lecture'=>$lecture,'idCourse'=>$idCourse
        ));
    }

}
