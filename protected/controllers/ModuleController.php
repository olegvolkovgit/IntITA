<?php

class ModuleController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
//	public function filters()
//	{
//		return array(
//			'accessControl', // perform access control for CRUD operations
//			'postOnly + delete', // we only allow deletion via POST request
//		);
//	}


    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new Module;

        if (isset($_POST['Module'])) {
            $model->attributes = $_POST['Module'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->module_ID));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        if (isset($_POST['Module'])) {
            $model->attributes = $_POST['Module'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->module_ID));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Lists all models.
     */
    public function actionIndex($idModule, $idCourse)
    {
        $model = Module::model()->findByPk($idModule);
        $owners = [];

        $criteria1 = new CDbCriteria();
        $criteria1->select = 'idTeacher';
        $criteria1->addCondition('idModule=' . $idModule);
        $criteria1->toArray();
        $temp = TeacherModule::model()->findAll($criteria1); //info about owners
        for($i = 0; $i < count($temp);$i++){
            if(Teacher::model()->findByPk($temp[$i]->idTeacher)->isPrint) {
                array_push($owners, $temp[$i]->idTeacher);
            }
        }
        $teachers = Teacher::model()->findAllByPk($owners);

        $criteria = new CDbCriteria();
        $criteria->addCondition('idModule>0');
        $criteria->addCondition('idModule=' . $idModule);

        $dataProvider = new CActiveDataProvider('Lecture', array(
            'criteria' => $criteria,
            'pagination' => false,
            'sort' => array(
                'defaultOrder' => array(
                    'order' => CSort::SORT_ASC,
                )
            )
        ));
        $editMode = 0; //init editMode flag
        //find id teacher related to current user id
        if (Yii::app()->user->isGuest) { //if user guest
            $editMode = 0;
        } else {
            if (Teacher::model()->exists('user_id=:user_id', array(':user_id' => Yii::app()->user->getId()))) {
                if ($teacherId = Teacher::model()->findByAttributes(array('user_id' => Yii::app()->user->getId()))->teacher_id) {
                    //check edit mode
                    if (TeacherModule::model()->exists('idTeacher=:teacher AND idModule=:module', array(':teacher' => $teacherId, ':module' => $idModule))) {
                        $editMode = 1;
                    } else {
                        $editMode = 0;
                    }
                } else {
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
            'idCourse' => $idCourse,
        ));
    }


    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model = new Module('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Module']))
            $model->attributes = $_GET['Module'];

        $this->render('admin', array(
            'model' => $model,
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
        $model = Module::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Modules $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'modules-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionSaveLesson()
    {
        $teacher = Yii::app()->user->getId();

        $newOrder = Lecture::model()->addNewLesson(
            $_POST['idModule'],
            $_POST['titleUa'],
            $_POST['titleRu'],
            $_POST['titleEn'],
            Teacher::model()->find('user_id=:user', array(':user' => $teacher))->teacher_id
        );

        Module::model()->updateByPk($_POST['idModule'], array('lesson_count' => $_POST['order']));
        Yii::app()->user->setFlash('newLecture', 'Нова лекція №' . $newOrder . $_POST['titleUa'] . 'додана до цього модуля');
        $idLecture = Lecture::model()->findByAttributes(array('idModule' => $_POST['idModule'], 'order' => $newOrder))->id;

        LecturePage::addNewPage($idLecture, 1);

        if (!isset($_GET['ajax']))
            $this->redirect(Yii::app()->request->urlReferrer);

        $this->redirect(Yii::app()->request->urlReferrer);
    }

    public function actionSaveModule()
    {
        $titleUa = Yii::app()->request->getPost('titleUA', '');
        $titleRu = Yii::app()->request->getPost('titleRU', '');
        $titleEn = Yii::app()->request->getPost('titleEN', '');
        $newOrder = Module::model()->addNewModule($_POST['idCourse'], $titleUa, $titleRu, $titleEn, $_POST['lang']);
        Course::model()->updateByPk($_POST['idCourse'], array('modules_count' => $newOrder));

        // if AJAX request, we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(Yii::app()->request->urlReferrer);

        $this->actionIndex($_POST['idModule'], $_POST['idCourse']);
    }

    public function actionUnableLesson($idLecture)
    {
        $idModule = Lecture::model()->findByPk($idLecture)->idModule;
        $order = Lecture::model()->findByPk($idLecture)->order;

        Lecture::model()->updateByPk($idLecture, array('order' => 0));
        Lecture::model()->updateByPk($idLecture, array('idModule' => 0));

        $count = Module::model()->findByPk($idModule)->lesson_count;
        for ($i = $order + 1; $i <= $count; $i++) {
            $id = Lecture::model()->findByAttributes(array('idModule' => $idModule, 'order' => $i))->id;
            Lecture::model()->updateByPk($id, array('order' => $i - 1));
        }
        Module::model()->updateByPk($idModule, array('lesson_count' => ($count - 1)));

        // if AJAX request, we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(Yii::app()->request->urlReferrer);
    }

    public function actionUpLesson($idLecture)
    {

        $idModule = Lecture::model()->findByPk($idLecture)->idModule;
        $order = Lecture::model()->findByPk($idLecture)->order;

        if ($order > 1) {
            $orderPrev = $order - 1;
            $idPrev = Lecture::model()->findByAttributes(array(
                'idModule' => $idModule,
                'order' => $orderPrev))->id;

            Lecture::model()->updateByPk($idLecture, array('order' => $orderPrev));
            Lecture::model()->updateByPk($idPrev, array('order' => $order));
        }

        // if AJAX request, we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(Yii::app()->request->urlReferrer);
    }

    public function actionDownLesson($idLecture)
    {
        $idModule = Lecture::model()->findByPk($idLecture)->idModule;
        $count = Module::model()->findByPk($idModule)->lesson_count;
        $order = Lecture::model()->findByPk($idLecture)->order;

        if ($order < $count) {
            $idNext = Lecture::model()->findByAttributes(array('idModule' => $idModule, 'order' => $order + 1))->id;

            Lecture::model()->updateByPk($idLecture, array('order' => $order + 1));
            Lecture::model()->updateByPk($idNext, array('order' => $order));
        }
        // if AJAX request, we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(Yii::app()->request->urlReferrer);
    }

    public function actionLecturesUpdate()
    {
        $model = Module::model()->findByPk($_POST['idmodule']);
        $this->renderPartial('_addLessonForm', array('newmodel' => $model), false, true);
    }

    public function actionUpdateModuleAttribute()
    {
        $up = new EditableSaver('Module');
        $up->update();
    }

    public function actionUpdateModuleImage($id)
    {
        $model = $this->loadModel($id);
        if (isset($_POST['Module'])) {
            $model->oldLogo = $model->module_img;
            if (!empty($_FILES['Module']['name']['module_img'])) {
                $model->logo = $_FILES['Module'];
                if ($model->validate()) {
                    $ext = substr(strrchr($_FILES['Module']['name']['module_img'], '.'), 1);
                    $_FILES['Module']['name']['module_img'] = uniqid() . '.' . $ext;
                    if (copy($_FILES['Module']['tmp_name']['module_img'], Yii::getpathOfAlias('webroot') . "/images/module/" . $_FILES['Module']['name']['module_img'])) {
                        $src = Yii::getPathOfAlias('webroot') . "/images/module/" . $model->oldLogo;
                        if (is_file($src) && $model->oldLogo!='courseimg1.png')
                            unlink($src);
                    }
                    $model->updateByPk($id, array('module_img' => $_FILES['Module']['name']['module_img']));

                    ImageHelper::uploadAndResizeImg(
                        Yii::getPathOfAlias('webroot')."/images/module/".$_FILES['Module']['name']['module_img'],
                        Yii::getPathOfAlias('webroot') . "/images/module/share/shareModuleImg_".$id.'.'.$ext,
                        210
                    );

                    $this->redirect(Yii::app()->request->urlReferrer);
                }else {
                    $this->redirect(Yii::app()->request->urlReferrer);
                }
            } else {
                $this->redirect(Yii::app()->request->urlReferrer);
            }
        }

    }
}
