<?php

class ModuleController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * Lists all models.
     */
    public function actionIndex($idModule, $idCourse=0)
    {
        $model = Module::model()->findByPk($idModule);
        if($model->cancelled && !StudentReg::isAdmin()) {
            throw new CHttpException(403, 'Ти запросив сторінку, доступ до якої обмежений спеціальними правами. Для отримання доступу увійди на сайт з логіном адміністратора.');
        }
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
        if(Module::model()->addNewModule($_POST['idCourse'], $titleUa, $titleRu, $titleEn, $_POST['lang'])){
            $count=count(Yii::app()->db->createCommand("SELECT DISTINCT id_module FROM course_modules WHERE id_course =" . $_POST['idCourse']
            )->queryAll());
            Course::model()->updateByPk($_POST['idCourse'], array('modules_count' => $count));
        }
        // if AJAX request, we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(Yii::app()->request->urlReferrer);

        $this->actionIndex($_POST['idModule'], $_POST['idCourse']);
    }

    public function actionUnableLesson($idLecture)
    {
        $idModule = Lecture::model()->findByPk($idLecture)->idModule;
        $order = Lecture::model()->findByPk($idLecture)->order;

        $count =  Lecture::model()->count("idModule=$idModule and `order`>0");
        Lecture::model()->updateByPk($idLecture, array('order' => 0));
        Lecture::model()->updateByPk($idLecture, array('idModule' => 0));

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
            $imageName = $_FILES['Module']['name']['module_img'];
            $tmpName = $_FILES['Module']['tmp_name']['module_img'];
            if (!empty($imageName)) {
                $model->logo = $_FILES['Module'];
                if ($model->validate()) {
                    Avatar::updateModuleAvatar($imageName,$tmpName,$id,$model->oldLogo);
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
