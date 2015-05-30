<?php

class CourseController extends Controller
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
	public function actionView($courseID=1)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($courseID),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Course;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Course']))
		{
			$model->attributes=$_POST['Course'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->CourseID));
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

		if(isset($_POST['Course']))
		{
			$model->attributes=$_POST['Course'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->CourseID));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex($id)
	{
        $criteria=new CDbCriteria();
        $criteria->addCondition('course='.$id);

        $dataProvider = new CActiveDataProvider('Module', array(
            'criteria' =>$criteria,
            'pagination'=>false,
            'sort'=>array(
                'defaultOrder'=>array(
                    'order'=>CSort::SORT_ASC,
                )
            )
        ));

        $dataProvider1 = new CActiveDataProvider('Teacher', array(
        ));

        $canEdit = false;
        $model = Course::model()->findByPk($id);
        $modules = Module::getModules($id);

        $teachers = TeacherModule::getCourseTeachers($modules);
        $user = Yii::app()->user->getId();
        if ($user = Teacher::isTeacher($user)) {
            if(Teacher::isTeacherCanEdit($user, $modules)){
                $canEdit = true;
            }
            if(count($modules) <= 3){
                $canEdit = true;
            }
        }

		$this->render('index',array(
			'model'=>$model,
            'modules' => $modules,
            'dataProvider' => $dataProvider,
            'canEdit' => $canEdit,
            'dataProvider1' => $dataProvider1,
            'teachers' => $teachers,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Course('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Course']))
			$model->attributes=$_GET['Course'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Course the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Course::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Course $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='course-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

    public function actionUnableModule(){
        $idModule = $_GET['idModule'];

        $idCourse =Module::model()->findByPk($idModule)->course;
        $order = Module::model()->findByPk($idModule)->order;

        Module::model()->deleteByPk($idModule);
        TeacherModule::model()->deleteAllByAttributes(array('idModule' => $idModule));
        //Module::model()->updateByPk($idModule, array('order' => 0));
        //Module::model()->updateByPk($idModule, array('course' => 0));

        $count = Course::model()->findByPk($idCourse)->modules_count;
        for ($i = $order + 1; $i <= $count; $i++){
            $id = Module::model()->findByAttributes(array('course'=>$idCourse,'order'=>$i))->module_ID;
            Module::model()->updateByPk($id, array('order' => $i-1));
        }
        Course::model()->updateByPk($idCourse, array('modules_count' => ($count - 1)));

        // if AJAX request, we should not redirect the browser
        if(!isset($_GET['ajax']))
            $this->redirect(Yii::app()->request->urlReferrer);
    }

    public function actionUpModule($idModule){

        $idCourse =Module::model()->findByPk($idModule)->course;
        $order = Module::model()->findByPk($idModule)->order;

        if($order > 1) {
            $idPrev = Module::model()->findByAttributes(array('course'=>$idCourse,'order' => $order - 1))->module_ID;

            Module::model()->updateByPk($idModule, array('order' => $order - 1));
            Module::model()->updateByPk($idPrev, array('order' => $order));
        }
//        // if AJAX request, we should not redirect the browser
        if(!isset($_GET['ajax']))
            $this->redirect(Yii::app()->request->urlReferrer);
    }

    public function actionDownModule(){
        $idModule = $_GET['idModule'];
        $idCourse =Module::model()->findByPk($idModule)->course;

        $count = Course::model()->findByPk($idCourse)->modules_count;
        $order = Module::model()->findByPk($idModule)->order;

        if($order < $count) {
            $idNext = Module::model()->findByAttributes(array('course'=>$idCourse,'order' => $order + 1))->module_ID;

            Module::model()->updateByPk($idModule, array('order' => $order + 1));
            Module::model()->updateByPk($idNext, array('order' => $order));
        }
        // if AJAX request, we should not redirect the browser
        if(!isset($_GET['ajax']))
            $this->redirect(Yii::app()->request->urlReferrer);
    }
    public function actionModulesUpdate(){
        $model = Course::model()->findByPk($_POST['idcourse']);
        $this->renderPartial('_addLessonForm',array('newmodel'=>$model), false, true);
    }

    public function actionCourseUpdate(){
        if(Yii::app()->request->isPostRequest) {
            $model = new Course;
            $model->attributes = $_POST;
            if($model->save()) {
                echo CJSON::encode(array('id' => $model->primaryKey));
            } else {
                $errors = array_map(function($v){ return join(', ', $v); }, $model->getErrors());
                echo CJSON::encode(array('errors' => $errors));
            }
        } else {
            throw new CHttpException(400, 'Invalid request');
        }
    }
}
