<?php

class RevisionController extends Controller
{
    public function actionIndex()
    {
        $this->render('index');
    }

    public function actionCreateNewBlock() {
        $pageOrder = Yii::app()->request->getPost('page');
        $idType = Yii::app()->request->getPost('type');
        $htmlBlock = Yii::app()->request->getPost('editorAdd');
        $idLecture = Yii::app()->request->getPost('idLecture');

        $lecture = Lecture::model()->findByPk($idLecture);

        $lecture->createNewBlock($htmlBlock, $idType, $pageOrder, Yii::app()->user->getId());

        $this->redirect(Yii::app()->request->urlReferrer);
    }

    public function actionDeleteElement() {
        $idLecture = Yii::app()->request->getPost('idLecture');
        $order = Yii::app()->request->getPost('order');

        $lecture = Lecture::model()->with("lectureEl")->findByPk($idLecture);

        $lecture->deleteLectureElement($order, Yii::app()->user->getId());

        if (!isset($_GET['ajax']))
            $this->redirect(Yii::app()->request->urlReferrer);
    }

    public function actionSaveBlock() {
        $order = Yii::app()->request->getPost('order');
        $idLesson = Yii::app()->request->getPost('idLecture');
        $content = str_replace("\n</p>", "</p>", Yii::app()->request->getPost('content'));

        $lesson = Lecture::model()->findByPk($idLesson);

        $lesson->saveBlock($order, $content, Yii::app()->user->getId());
    }

    public function actionAddVideo()
    {
        $htmlBlock = Yii::app()->request->getPost('newVideoUrl');
        $pageOrder = Yii::app()->request->getPost('page');
        $lectureId = Yii::app()->request->getPost('idLecture');

        $lecture = Lecture::model()->findByPk($lectureId);

        $lecture->addVideo($htmlBlock, $pageOrder, Yii::app()->user->getId());

//        $model = new LectureElement();
//        $model->addVideo($htmlBlock, $pageOrder, $lectureId);

        $this->redirect(Yii::app()->request->urlReferrer);
    }

}