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
        $model = Module::model()->with('teacher', 'lectures')->findByPk($idModule);

        if (!isset($model))
            throw new CHttpExcepion(404, "Модуль на знайдено!");

        if($model->cancelled && !StudentReg::isAdmin()) {
            throw new CHttpException(403, 'Ти запросив сторінку, доступ до якої обмежений спеціальними правами. Для отримання доступу увійди на сайт з логіном адміністратора.');
        }

        $this->render('index', array(
            'post' => $model,
            'teachers' => $model->teacher,
            'editMode' => $model->isEditableByCurrentUser(),
            'lecturesTitles' => $model->lectures,
            'dataProvider' => $model->getLecturesDataProvider(),
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
        $newLectureParams = array (
            'titleUa' => Yii::app()->request->getParam('titleUa', ''),
            'titleRu' => Yii::app()->request->getParam('titleRu', ''),
            'titleEn' => Yii::app()->request->getParam('titleEn', ''),
            'order' => Yii::app()->request->getParam('order', 1)
        );

        //throw error if idModule is '0' or unset?
        $idModule = Yii::app()->request->getParam('idModule');

        $model = Module::model()->findByPk($idModule);

        if (!isset($model))
            throw new CHttpExcepion(404, "Модуль на знайдено!");

        $model->addLecture($newLectureParams);

        Yii::app()->user->setFlash('newLecture', 'Нова лекція №' . $newLectureParams['order'] . $newLectureParams['titleUa'] . 'додана до цього модуля');

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

    public function actionUnableLesson()
    {
        $idLecture = Yii::app()->request->getParam('idLecture');
        $idCourse = Yii::app()->request->getParam('idModule');

        $model = Module::model()->with('lectures')->findByPk($idCourse);

        if (!isset($model))
            throw new CHttpExcepion(404, "Модуль на знайдено!");

        $model->disableLesson($idLecture);

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
