<?php

class ModuleController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}


	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Module;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Module']))
		{
			$model->attributes=$_POST['Module'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->module_ID));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Module']))
		{
			$model->attributes=$_POST['Module'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->module_ID));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex($idModule)
	{
        $model = Module::model()->findByPk($idModule);
        $owners = explode(';',$model->owners); //array of teacher's ids that cna edit this module
        $teachers = Teacher::model()->findAllByAttributes(array('teacher_id'=>$owners)); //info about owners


        $criteria=new CDbCriteria();
        $criteria->addCondition('idModule>0');
        $criteria->addCondition('idModule='.$idModule);

        $dataProvider = new CActiveDataProvider('Lecture', array(
            'criteria' =>$criteria,
            'pagination'=>false,
            'sort'=>array(
                'defaultOrder'=>array(
                    'order'=>CSort::SORT_ASC,
                )
            )
        ));

        $editMode = 0; //init editMode flag
        //find id teacher related to current user id
        if (Yii::app()->user->isGuest){ //if user guest
            $editMode = 0;
        } else {

            if (Teacher::model()->exists('user_id=:user_id', array(':user_id' => Yii::app()->user->getId()))) {
                if ($teacherId = Teacher::model()->findByAttributes(array('user_id' => Yii::app()->user->getId()))->teacher_id) {
                    //check edit mode
                    if (TeacherModule::model()->exists('idTeacher=:teacher AND idModule=:module', array(':teacher' => $teacherId, ':module' => $idModule))){
                        $editMode = 1;
                    } else {
                        $editMode = 0;
                    }
                } else{
                    $editMode = 0;
                }
            } else {
                $editMode = 0;
            }
        }

        $lecturesTitles = Lecture::model()->getLecturesTitles($idModule);

        $this->render('index', array(
            'post' => $model,
            'teachers' => $teachers,
            'editMode' => $editMode,
            'lecturesTitles' => $lecturesTitles,
            'dataProvider' => $dataProvider,
        ));
	}


	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Module('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Module']))
			$model->attributes=$_GET['Module'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Modules the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Module::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Modules $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='modules-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

    public  function actionSaveLesson(){
        $teacher = Yii::app()->user->getId();

        $newOrder = Lecture::model()->addNewLesson(
            $_POST['idModule'],
            $_POST['newLectureName'],
            $_POST['lang'],
            Teacher::model()->find('user_id=:user', array(':user' => $teacher))->teacher_id
        );

        Module::model()->updateByPk($_POST['idModule'], array('lesson_count'=>$_POST['order']));
        Yii::app()->user->setFlash('newLecture','Нова лекція №'.$newOrder.$_POST['newLectureName'] .'додана до цього модуля');
        // if AJAX request, we should not redirect the browser
        $permission = new Permissions();
        var_dump($permission->setPermission(
            $teacher,
            Lecture::model()->findByAttributes(array('idModule' => $_POST['idModule'], 'order' => $newOrder))->id,
            array('read', 'edit', 'create', 'delete'))
        );
        if(!isset($_GET['ajax']))
            $this->redirect(Yii::app()->request->urlReferrer);

        $this->actionIndex($_POST['idModule']);

    }

    public  function actionSaveModule(){
        $newOrder = Module::model()->addNewModule($_POST['idCourse'], $_POST['newModuleName'], $_POST['lang']);
        Course::model()->updateByPk($_POST['idCourse'], array('modules_count'=>$newOrder));

        $model = new TeacherModule();
        $model->idModule = Module::model()->findByAttributes(array('course' => $_POST['idCourse'], 'order' => $newOrder));
        $model->idTeacher = Yii::app()->user->getId();

        // if AJAX request, we should not redirect the browser
        if(!isset($_GET['ajax']))
            $this->redirect(Yii::app()->request->urlReferrer);

        $this->actionIndex($_POST['idModule']);
        //$this->render('saveLesson');
    }

    public function actionUnableLesson(){
        $idLecture = $_GET['idLecture'];

        $idModule =Lecture::model()->findByPk($idLecture)->idModule;
        $order = Lecture::model()->findByPk($idLecture)->order;

        Lecture::model()->updateByPk($idLecture, array('order' => 0));
        Lecture::model()->updateByPk($idLecture, array('idModule' => 0));

        $count = Module::model()->findByPk($idModule)->lesson_count;
        for ($i = $order + 1; $i <= $count; $i++){
            $id = Lecture::model()->findByAttributes(array('idModule'=>$idModule,'order'=>$i))->id;
            Lecture::model()->updateByPk($id, array('order' => $i-1));
        }
        Module::model()->updateByPk($idModule, array('lesson_count' => ($count - 1)));

        // if AJAX request, we should not redirect the browser
        if(!isset($_GET['ajax']))
            $this->redirect(Yii::app()->request->urlReferrer);
    }

    public function actionUpLesson(){
        $idLecture = $_GET['idLecture'];

        $idModule =Lecture::model()->findByPk($idLecture)->idModule;
        $order = Lecture::model()->findByPk($idLecture)->order;

        if($order > 1) {
            $idPrev = Lecture::model()->findByAttributes(array('idModule'=>$idModule, 'order' => $order - 1))->id;

            Lecture::model()->updateByPk($idLecture, array('order' => $order - 1));
            Lecture::model()->updateByPk($idPrev, array('order' => $order));
        }

        // if AJAX request, we should not redirect the browser
        if(!isset($_GET['ajax']))
            $this->redirect(Yii::app()->request->urlReferrer);
    }

    public function actionDownLesson(){
        $idLecture = $_GET['idLecture'];
        $idModule =Lecture::model()->findByPk($idLecture)->idModule;
        $count = Module::model()->findByPk($idModule)->lesson_count;
        $order = Lecture::model()->findByPk($idLecture)->order;

        if($order < $count) {
            $idNext = Lecture::model()->findByAttributes(array('idModule'=>$idModule, 'order' => $order + 1))->id;

            Lecture::model()->updateByPk($idLecture, array('order' => $order + 1));
            Lecture::model()->updateByPk($idNext, array('order' => $order));
        }
        // if AJAX request, we should not redirect the browser
        if(!isset($_GET['ajax']))
            $this->redirect(Yii::app()->request->urlReferrer);
    }
}
