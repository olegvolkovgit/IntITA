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
			throw new \application\components\Exceptions\IntItaException('404', 'Заняття не існує');
		$editMode = false;
		$author = new Author();
		if(Yii::app()->user->model->isAuthor()) {
			$editMode = $author->isTeacherAuthorModule(Yii::app()->user->getID(), $lecture->idModule);
		}

		$enabledLessonOrder = Lecture::getLastEnabledLessonOrder($lecture->idModule);
		if (Yii::app()->user->model->isAdmin() || $editMode) {
			return true;
		}
		if($idCourse!=0){
			$course = Course::model()->findByPk($idCourse);
			if(!$course->status)
				throw new \application\components\Exceptions\IntItaException('403', 'Заняття не доступне. Курс знаходиться в розробці.');
//            $module = Module::model()->findByPk($lecture->idModule);
//            if(!$module->status)
//                throw new \application\components\Exceptions\IntItaException('403', 'Заняття не доступне. Модуль знаходиться в розробці.');
		}
		if (!($lecture->isFree)) {
			$modulePermission = new PayModules();
			if (!$modulePermission->checkModulePermission(Yii::app()->user->getId(), $lecture->idModule, array('read'))
				|| $lecture->order > $enabledLessonOrder) {
				throw new CHttpException(403, 'Спочатку оплати доступ до матеріалу');
			}
		} else {
			if ($lecture->order > $enabledLessonOrder)
				throw new CHttpException(403, 'Ти не можеш запланувати консультацію. Спочатку пройди попередній матеріал.');
		}
	}

	/**
	 * Lists all available consultants.
	 */
	public function actionIndex($lectureId, $idCourse=0)
	{
		$this->initialize($lectureId,$idCourse);

        $lecture = Lecture::model()->findByPk($lectureId);
        $dataProvider = $lecture->module->getConsultants();

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
        $idteacher = Yii::app()->request->getPost('teacherid');
        $idlecture = Yii::app()->request->getPost('lectureid');

		$teacher = RegisteredUser::userById($idteacher);
        $lecture = Lecture::model()->findByPk($idlecture);
        $consultant = new Consultant();
        if($teacher->isConsultant() && !$consultant->checkModule($idteacher, $lecture->idModule)) {
			if (Yii::app()->request->getPost('saveConsultation')) {
				$numcons = explode(",", Yii::app()->request->getPost('timecons'));
				for ($i = 0; $i < count($numcons); $i++) {
					if (Consultationscalendar::consultationFree($idteacher, $numcons[$i], $date)) {
						$teacher->getTeacher()->addConsult($numcons[$i], $date, $idlecture);
					} else {
						$this->redirect(array('consultationerror', 'lecture' => $idlecture, 'idCourse' => $idCourse));
					}
				}
			}
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
