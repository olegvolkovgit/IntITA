<?php

class CourseController extends Controller
{//http://localhost/IntIta/course/ua/php
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';


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
        $canEdit = StudentReg::isAdmin();
        $model = Course::model()->findByPk($id);

        $dataProvider = new CourseModules('search');

		$this->render('index',array(
			'model'=>$model,
            'dataProvider' => $dataProvider,
            'canEdit' => $canEdit,
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
        $idCourse = $_GET['idCourse'];

        $order = CourseModules::model()->findByPk(array('id_course'=>$idCourse,'id_module'=> $idModule))->order;

        CourseModules::model()->deleteByPk(array('id_course'=>$idCourse,'id_module'=> $idModule));
        $issetCourseModule = CourseModules::model()->findByAttributes(array('id_module'=>$idModule));
        if($issetCourseModule) TeacherModule::model()->deleteAllByAttributes(array('idModule' => $idModule));

        $count = Course::model()->findByPk($idCourse)->modules_count;
        for ($i = $order + 1; $i <= $count; $i++){
            $nextModule = CourseModules::model()->findByAttributes(array('id_course'=>$idCourse,'order'=>$i))->id_module;
            CourseModules::model()->updateByPk(array('id_course'=>$idCourse,'id_module'=> $nextModule), array('order' => $i-1));
        }
        Course::model()->updateByPk($idCourse, array('modules_count' => ($count - 1)));

        // if AJAX request, we should not redirect the browser
        if(!isset($_GET['ajax']))
			$this->redirect(Yii::app()->request->urlReferrer);
    }

    public function actionUpModule(){
        $idModule = $_GET['idModule'];
        $idCourse = $_GET['idCourse'];

        $order = CourseModules::model()->findByPk(array('id_course'=>$idCourse,'id_module'=> $idModule))->order;

        if($order > 1) {
            $idPrev = CourseModules::getPrevModule($idCourse, $order);
            $prevRecord = CourseModules::model()->findByAttributes(array('id_course'=>$idCourse,'id_module'=> $idPrev));

            CourseModules::model()->updateByPk(array('id_course'=>$idCourse,'id_module'=> $idModule),
                array('order' => $prevRecord->order));
            $prevRecord->order = $order;
            $prevRecord->save();
        }
//        // if AJAX request, we should not redirect the browser
        if(!isset($_GET['ajax']))
            $this->redirect(Yii::app()->request->urlReferrer);
    }

    public function actionDownModule(){
        $idModule = $_GET['idModule'];
        $idCourse = $_GET['idCourse'];

        $count = Course::model()->findByPk($idCourse)->modules_count;
        $order = CourseModules::model()->findByPk(array('id_course'=>$idCourse,'id_module'=> $idModule))->order;

        if($order < $count) {
            $idNext = CourseModules::getNextModule($idCourse, $order);
            $nextRecord = CourseModules::model()->findByAttributes(array('id_course'=>$idCourse,'id_module'=> $idNext));

            CourseModules::model()->updateByPk(array(
                'id_course'=>$idCourse,
                'id_module'=> $idModule),
                array('order' => $nextRecord->order));
            $nextRecord->order = $order;
            $nextRecord->save();
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

    public function actionSchema($id)
    {
        $lg = Yii::app()->session['lg'];
        $filename = StaticFilesHelper::pathToCourseSchema('schema_course_'.$id.'_'. $lg  .'.html');

        if (file_exists($filename)) {
            $path = Config::getBaseUrl() .'/'.$filename;
            $this->redirect($path);
        }
        else
            throw new \application\components\Exceptions\IntItaException('The scheme has not been created!!!'); //$this->render('_schemaError');
    }

}