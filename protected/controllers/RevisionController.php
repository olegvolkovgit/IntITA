<?php

class RevisionController extends Controller
{
    public function actionIndex()
    {
        $lectureRev = RevisionLecture::model()->with("properties")->findAll();

        $lecturesDataProvider = new CActiveDataProvider("RevisionLecture");
        $lecturesDataProvider->setData($lectureRev);

        $this->render('index', array(
            'lectures' => $lecturesDataProvider,
        ));
    }

    public function actionCreateNewLecture(){
        $idModule = Yii::app()->request->getPost("idModule");
        $order = Yii::app()->request->getPost("order");
        $titleUa = Yii::app()->request->getPost("titleUa");
        $titleEn = Yii::app()->request->getPost("titleEn");
        $titleRu = Yii::app()->request->getPost("titleRu");

        $revLecture = RevisionLecture::createNewLecture($idModule, $order, $titleUa, $titleEn, $titleRu, Yii::app()->user);

        $this->redirect(array('revision/editlecturerevision', 'idRevision' => $revLecture->id_revision));
    }

    public function actionEditLectureRevision($idRevision) {
        $lectureRevision = RevisionLecture::model()->with("properties", "lecturePages")->findByPk($idRevision);

        if (!$lectureRevision->isEditable()) {
            $lectureRevision = $lectureRevision->cloneLecture(Yii::app()->user);
        }

        $pagesDataProvider = new CActiveDataProvider("RevisionLecturePage");
        $pagesDataProvider->setData($lectureRevision->lecturePages);

        $this->render("lectureview", array(
                        "lectureRevision" => $lectureRevision,
                        "pages" => $pagesDataProvider));
    }

    public function actionAddPage(){
        $idRevision = Yii::app()->request->getPost("idRevision");

        $lectureRevision = RevisionLecture::model()->findByPk($idRevision);
        $lectureRevision->addPage(Yii::app()->user);

        $this->redirect(Yii::app()->request->urlReferrer);
    }

    public function actionNewPageRevision() {
        $idPage = Yii::app()->request->getPost("idPage");
        $newRevision = RevisionLecturePage::model()->findByPk($idPage)->clonePage(Yii::app()->user);
        $this->redirect(Yii::app()->request->urlReferrer);
    }

    public function actionEditPageRevision() {
        $idPage = Yii::app()->request->getPost("idPage");

        $page = RevisionLecturePage::model()->findByPk($idPage);

        if (!$page->isEditable()) {
            // create new revision;
            $page = $page->clonePage(Yii::app()->user);
        }

        $video = $page->getVideo();
        $lectureBody = $page->getLectureBody();
        $quiz = $page->getQuiz();

        $this->renderPartial("pageview", array(
                        "page" => $page,
                        "video" => $video,
                        "lectureBody" => $lectureBody,
                        "quiz" => $quiz));
    }

    public function actionAddVideo() {
        $idPage = Yii::app()->request->getPost("idPage");
        $url = Yii::app()->request->getPost("url");

        $page = RevisionLecturePage::model()->findByPk($idPage);

        $page->saveVideo($url);

        $this->redirect(Yii::app()->request->urlReferrer);
    }

    public function actionSendPageRevision() {
        $idPage = Yii::app()->request->getPost("idPage");
        $page = RevisionLecturePage::model()->findByPk($idPage);

        $page->sendForApproval(Yii::app()->user);
    }

    public function actionApprovePageRevision() {
        $idPage = Yii::app()->request->getPost("idPage");
        $page = RevisionLecturePage::model()->findByPk($idPage);

        $page->approve(Yii::app()->user);
    }

    public function actionCancelPageRevision() {
        $idPage = Yii::app()->request->getPost("idPage");
        $page = RevisionLecturePage::model()->findByPk($idPage);

        $page->cancel(Yii::app()->user);
    }

    public function actionRejectPageRevision() {
        $idPage = Yii::app()->request->getPost("idPage");
        $page = RevisionLecturePage::model()->findByPk($idPage);

        $page->reject(Yii::app()->user);
    }

    public function actionEditPageTitle() {
        $idPage = Yii::app()->request->getPost("idPage");
        $title = Yii::app()->request->getPost("title");
        $page = RevisionLecturePage::model()->findByPk($idPage);

        $page->setTitle($title);

        $this->redirect(Yii::app()->request->urlReferrer);
    }

    public function actionAddLectureElement() {
        $idPage = Yii::app()->request->getPost('idPage');
        $idType = Yii::app()->request->getPost('idType');
        $html_block = Yii::app()->request->getPost('html_block');

        $page = RevisionLecturePage::model()->findByPk($idPage);

        $page->addTextBlock($idType, $html_block);

        $this->redirect(Yii::app()->request->urlReferrer);
    }

    public function actionEditLectureElement() {
        $idElement = Yii::app()->request->getPost('idElement');
        $html_block = Yii::app()->request->getPost('html_block');

        $element = RevisionLectureElement::model()->findByPk($idElement);

        $element->html_block = $html_block;

        $element->saveCheck();

        $this->redirect(Yii::app()->request->urlReferrer);
    }

    public function actionUpPage() {
        $idPage = Yii::app()->request->getPost('idPage');

        $page = RevisionLecturePage::model()->findByPk($idPage);
        if ($page->isEditable()) {
            $page->moveUp();
        }
    }

    public function actionDownPage() {
        $idPage = Yii::app()->request->getPost('idPage');

        $page = RevisionLecturePage::model()->findByPk($idPage);
        if ($page->isEditable()) {
            $page->moveDown();
        }
    }

    public function actionCheckLecture() {
        $idLecture = Yii::app()->request->getPost('idLecture');

        $lectureRevision = RevisionLecture::model()->with('lecturePages')->findByPk($idLecture);

        $result = $lectureRevision->checkConflicts();

        if (empty($result)) {
            echo "Ok!";
            return;
        } else {
            echo implode("; ", $result);
            return;
        }
    }

    public function actionSendForApproveLecture() {
        $idLecture = Yii::app()->request->getPost('idLecture');

        $lectureRev = RevisionLecture::model()->with('lecturePages', 'properties')->findByPk($idLecture);

        $result = $lectureRev->checkConflicts();

        if (empty($result)) {
            $lectureRev->sendForApproval(Yii::app()->user);
        } else {
            echo implode("; ", $result);
        }
    }

    public function actionNewLectureRevision() {
        $idLecture = Yii::app()->request->getPost('idLecture');
        $lectureRev = RevisionLecture::model()->with("properties", "lecturePages")->findByPk($idLecture);
//        $lectureRev = RevisionLecture::model()->with('lecturePages', 'properties', 'lecturePages.lectureElements')->findByPk($idLecture);

        $newRevision = $lectureRev->cloneLecture(Yii::app()->user);
    }

    public function actionRejectLectureRevision () {
        $idLecture = Yii::app()->request->getPost('idLecture');
        $lectureRev = RevisionLecture::model()->with("properties", "lecturePages")->findByPk($idLecture);

        $lectureRev->reject(Yii::app()->user);

    }

    public function actionCancelLectureRevision () {
        $idLecture = Yii::app()->request->getPost('idLecture');
        $lectureRev = RevisionLecture::model()->with("properties", "lecturePages")->findByPk($idLecture);

        $lectureRev->cancel(Yii::app()->user);

    }

    public function actionApproveLectureRevision () {
        $idLecture = Yii::app()->request->getPost('idLecture');
        $lectureRev = RevisionLecture::model()->with("properties", "lecturePages")->findByPk($idLecture);

        $lectureRev->approve(Yii::app()->user);
    }

    public function actionUpLectureElement() {
        $idPage = Yii::app()->request->getPost('idPage');
        $idElement = Yii::app()->request->getPost('idElement');

        $page = RevisionLecturePage::model()->with('lectureElements')->findByPk($idPage);
        $page->upElement($idElement);
    }

    public function actionDownLectureElement() {
        $idPage = Yii::app()->request->getPost('idPage');
        $idElement = Yii::app()->request->getPost('idElement');

        $page = RevisionLecturePage::model()->with('lectureElements')->findByPk($idPage);
        $page->downElement($idElement);
    }

    /***************/

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

//    public function actionAddVideo()
//    {
//        $htmlBlock = Yii::app()->request->getPost('newVideoUrl');
//        $pageOrder = Yii::app()->request->getPost('page');
//        $idLecture = Yii::app()->request->getPost('idLecture');
//
//        $lecture = Lecture::model()->findByPk($idLecture);
//
//        $lecture->addVideo($htmlBlock, $pageOrder, Yii::app()->user->getId());
//
//        $this->redirect(Yii::app()->request->urlReferrer);
//    }

    public function actionDeleteVideo()
    {
        $idLecture = Yii::app()->request->getPost('idLecture');
        $pageOrder = Yii::app()->request->getPost('pageOrder');

        $lecture = Lecture::model()->findByPk($idLecture);

        $lecture->deleteVideo($pageOrder, Yii::app()->user->getId());

        if (!isset($_GET['ajax']))
            $this->redirect(Yii::app()->request->urlReferrer);
    }

    //reorder blocks on lesson page - up block

    public function actionUpElement()
    {
        $idLecture = Yii::app()->request->getPost('idLecture');
        $order = Yii::app()->request->getPost('order');

        $lecture = Lecture::model()->findByPk($idLecture);

        $lecture->upElement($order);

        // if AJAX request, we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(Yii::app()->request->urlReferrer);
    }
    //reorder blocks on lesson page - down block

    public function actionDownElement()
    {
        $idLecture = Yii::app()->request->getPost('idLecture');
        $order = Yii::app()->request->getPost('order');

        $lecture = Lecture::model()->findByPk($idLecture);

        $lecture->downElement($order);

        // if AJAX request, we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(Yii::app()->request->urlReferrer);
    }

}