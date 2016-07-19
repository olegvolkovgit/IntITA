<?php

class RevisionController extends Controller {
    public $layout = 'revisionlayout';

    public function init()
    {
        parent::init();
        $app = Yii::app();
        $app->language = isset($app->session['lg'])?$app->session['lg']:'ua';
        
        if (Yii::app()->user->isGuest) {
            $this->render('/site/authorize');
            die();
        } else return true;
    }

    public function actionIndex() {
        if (!$this->isUserApprover(Yii::app()->user)) {
            throw new RevisionControllerException(403, Yii::t('error', '0590'));
        }

        $this->render('index',array(
            'isApprover' => true,
            'userId' => Yii::app()->user->getId(),
        ));
    }

    public function actionCreateNewLecture() {

        $idModule = Yii::app()->request->getPost("idModule");
        $titleUa = trim(Yii::app()->request->getPost("titleUa"));
        $titleEn = trim(Yii::app()->request->getPost("titleEn"));
        $titleRu = trim(Yii::app()->request->getPost("titleRu"));

        if (!$this->isUserTeacher(Yii::app()->user, $idModule)) {
            throw new RevisionControllerException(403, Yii::t('error', '0590'));
        }
        //$order remove
        $revLecture = RevisionLecture::createNewLecture($idModule, $titleUa, $titleEn, $titleRu, Yii::app()->user);

        $this->redirect(array('revision/editlecturerevision', 'idRevision' => $revLecture->id_revision));
    }

    public function actionEditLectureRevision($idRevision) {

        $lectureRevision = RevisionLecture::model()->with("properties", "lecturePages")->findByPk($idRevision);
        if(!$lectureRevision)
            throw new RevisionControllerException(404);
        if (!$this->isUserEditor(Yii::app()->user, $lectureRevision)) {
            throw new RevisionControllerException(403, Yii::t('revision', '0825'));
        }

        if (!$lectureRevision->isEditable()) {
            throw new RevisionControllerException(400, Yii::t('revision', '0826'));
        }

        $this->render("lectureview", array(
            "lectureRevision" => $lectureRevision,
            "pages" => $lectureRevision->lecturePages
        ));
    }

    public function actionPreviewLectureRevision($idRevision) {

        $lectureRevision = RevisionLecture::model()->with("properties", "lecturePages")->findByPk($idRevision);
        if(!$lectureRevision)
            throw new RevisionControllerException(404);
        if (!$this->isUserTeacher(Yii::app()->user, $lectureRevision->id_module) && !$this->isUserApprover(Yii::app()->user, $lectureRevision->id_module)) {
            throw new RevisionControllerException(403, Yii::t('error', '0590'));
        }

        $this->render("lecturePreview/lectureview", array(
            "lectureRevision" => $lectureRevision,
            "idRevision" => $idRevision,
            "pages" => $lectureRevision->lecturePages
        ));
    }

    public function actionAddPage() {

        $idRevision = Yii::app()->request->getPost("idRevision");

        $lectureRevision = RevisionLecture::model()->with('properties')->findByPk($idRevision);

        if (!$this->isUserEditor(Yii::app()->user, $lectureRevision)) {
            throw new RevisionControllerException(Yii::t('error', '0590'));
        }

        $newPage = $lectureRevision->addPage(Yii::app()->user);

        $json = json_encode(array(
            "id" => $newPage->id,
            "title" => $newPage->page_title,
            "order" => $newPage->page_order,
        ));

        echo $json;
    }

    public function actionEditPageRevision($idPage) {

        $page = RevisionLecturePage::model()->findByPk($idPage);
        if(!$page)
            throw new RevisionControllerException(404);
        $lectureRevision=RevisionLecture::model()->findByPk($page->id_revision);

        if (!$this->isUserEditor(Yii::app()->user, RevisionLecture::model()->findByPk($page->id_revision))) {
            throw new RevisionControllerException(403, Yii::t('error', '0590'));
        }
        if (!$lectureRevision->isEditable()) {
            throw new RevisionControllerException(400, Yii::t('revision', '0826'));
        }

        $lectureBody = $page->getLectureBody();
        $dataProvider = new CArrayDataProvider($lectureBody);
        $quiz = $page->getQuiz();

        $this->render("indexCKE", array(
            'user' => Yii::app()->user->getId(),
            "page" => $page,
            "dataProvider" => $dataProvider,
            "quiz" => $quiz,
            "pages"=>$lectureRevision->lecturePages
        ));
    }

    /**
     * curl -XPOST http://intita.project/revision/addvideo -d 'idRevision=138&idPage=691'  -b XDEBUG_SESSION=PHPSTORM
     * @throws RevisionControllerException
     */

    public function actionAddVideo() {
        $idRevision = Yii::app()->request->getPost('idRevision');
        $idPage = Yii::app()->request->getPost('idPage');
        $idType = LectureElement::VIDEO;

        $url = Yii::app()->request->getPost("url");

        $lectureRevision = RevisionLecture::model()->findByPk($idRevision);

        if (!$this->isUserEditor(Yii::app()->user, $lectureRevision)) {
            throw new RevisionControllerException(403, Yii::t('error', '0590'));
        }

        $lectureRevision->addLectureElement($idPage, ['idType' => $idType, 'html_block' => $url], Yii::app()->user);

        $this->redirect(Yii::app()->request->urlReferrer);
    }

    /**
     * curl -XPOST http://intita.project/revision/editvideo -d 'idRevision=138&idPage=691&pk=758&value=url2'  -b XDEBUG_SESSION=PHPSTORM
     * @throws RevisionControllerException
     */
    public function actionEditVideo() {
        $idRevision = Yii::app()->request->getPost('idRevision');
        $idPage = Yii::app()->request->getPost('idPage');
        $idElement = Yii::app()->request->getPost("pk");
        $url = trim(Yii::app()->request->getPost("value"));

        $lectureRevision = RevisionLecture::model()->findByPk($idRevision);

        if (!$this->isUserEditor(Yii::app()->user, $lectureRevision)) {
            throw new RevisionControllerException(403, Yii::t('error', '0590'));
        }

        $lectureRevision->editLectureElement($idPage, ['id_block' => $idElement, 'html_block' => $url], Yii::app()->user);

        $this->redirect(Yii::app()->request->urlReferrer);
    }

    /**
     * curl -XPOST http://intita.project/revision/deletevideo -d 'idRevision=138&idPage=691&pk=758'  -b XDEBUG_SESSION=PHPSTORM
     * @throws RevisionControllerException
     */
    public function actionDeleteVideo() {
        $idRevision = Yii::app()->request->getPost('idRevision');
        $idPage = Yii::app()->request->getPost('idPage');
        $idElement = Yii::app()->request->getPost("pk");

        $lectureRevision = RevisionLecture::model()->findByPk($idRevision);

        if (!$this->isUserEditor(Yii::app()->user, $lectureRevision)) {
            throw new RevisionControllerException(403, Yii::t('error', '0590'));
        }

        $lectureRevision->deleteLectureElement($idPage, $idElement, Yii::app()->user);

        $this->redirect(Yii::app()->request->urlReferrer);
    }

    /**
     * curl -XPOST http://intita.project/revision/EditPageTitle -d 'idRevision=139&pk=694&value=title'  -b XDEBUG_SESSION=PHPSTORM
     * @throws RevisionControllerException
     */
    public function actionEditPageTitle() {
        $idRevision = Yii::app()->request->getPost('idRevision');
        $idPage = Yii::app()->request->getPost("pk");
        $title = trim(Yii::app()->request->getPost("value"));

        $lectureRevision = RevisionLecture::model()->findByPk($idRevision);

        if (!$this->isUserEditor(Yii::app()->user, $lectureRevision)) {
            throw new RevisionControllerException(403, Yii::t('error', '0590'));
        }

        $lectureRevision->setPageTitle($idPage, $title, Yii::app()->user);

        $this->redirect(Yii::app()->request->urlReferrer);
    }

    /**
     * curl -XPOST http://intita.project/revision/AddLectureElement -d 'idRevision=139&idPage=694&idType=1&html_block=html_block'  -b XDEBUG_SESSION=PHPSTORM
     * @throws RevisionControllerException
     */

    public function actionAddLectureElement() {
        $idRevision = Yii::app()->request->getPost('idRevision');
        $idPage = Yii::app()->request->getPost('idPage');
        $idType = Yii::app()->request->getPost('idType');
        $html_block = trim(Yii::app()->request->getPost('html_block'));

        $lectureRevision = RevisionLecture::model()->findByPk($idRevision);

        if (!$this->isUserEditor(Yii::app()->user, $lectureRevision)) {
            throw new RevisionControllerException(403, Yii::t('error', '0590'));
        }

        $lectureRevision->addLectureElement($idPage, ['idType' => $idType, 'html_block' => $html_block], Yii::app()->user);

        $this->redirect(Yii::app()->request->urlReferrer);
    }

    /**
     * curl -XPOST http://intita.project/revision/EditLectureElement -d 'idRevision=139&idPage=694&idElement=763&html_block=block_html'  -b XDEBUG_SESSION=PHPSTORM
     * @throws RevisionControllerException
     */
    public function actionEditLectureElement() {
        $idRevision = Yii::app()->request->getPost('idRevision');
        $idPage = Yii::app()->request->getPost('idPage');
        $idElement = Yii::app()->request->getPost('idElement');
        $html_block = trim(Yii::app()->request->getPost('html_block'));

        $lectureRevision = RevisionLecture::model()->findByPk($idRevision);

        if (!$this->isUserEditor(Yii::app()->user, $lectureRevision)) {
            throw new RevisionControllerException(403, Yii::t('error', '0590'));
        }

        $lectureRevision->editLectureElement($idPage, ['id_block' => $idElement, 'html_block' => $html_block], Yii::app()->user);

        //$this->redirect(Yii::app()->request->urlReferrer);
    }

    /**
     * curl -XPOST http://intita.project/revision/DeleteLectureElement -d 'idRevision=139&idPage=694&idElement=763'  -b XDEBUG_SESSION=PHPSTORM
     * @throws RevisionControllerException
     */
    public function actionDeleteLectureElement() {
        $idRevision = Yii::app()->request->getPost('idRevision');
        $idPage = Yii::app()->request->getPost('idPage');
        $idElement = Yii::app()->request->getPost('idElement');

        $lectureRevision = RevisionLecture::model()->findByPk($idRevision);

        $page = RevisionLecturePage::model()->with('lectureElements')->findByPk($idPage);

        if (!$this->isUserEditor(Yii::app()->user, $lectureRevision)) {
            throw new RevisionControllerException(403, Yii::t('error', '0590'));
        }

        $lectureRevision->deleteLectureElement($idPage, $idElement, Yii::app()->user);
    }

    //@todo
    public function actionGetLectureElement() {
        $idEl = Yii::app()->request->getPost('idElement');
        $html = RevisionLectureElement::model()->findByPk($idEl)->html_block;
        echo $html;
    }

    /**
     * curl -XPOST --data 'idRevision=136&idPage=686' 'http://intita.project/revision/UpPage' -b XDEBUG_SESSION=PHPSTORM
     * @throws RevisionControllerException
     */
    public function actionUpPage() {
        $idRevision = Yii::app()->request->getPost('idRevision');
        $idPage = Yii::app()->request->getPost('idPage');

        $lectureRevision = RevisionLecture::model()->findByPk($idRevision);

        if (!$this->isUserEditor(Yii::app()->user, $lectureRevision)) {
            throw new RevisionControllerException(403, Yii::t('error', '0590'));
        }

        $lectureRevision->movePageUp($idPage, Yii::app()->user);
    }

    /**
     * curl -XPOST --data 'idRevision=136&idPage=686' 'http://intita.project/revision/DownPage' -b XDEBUG_SESSION=PHPSTORM
     * @throws RevisionControllerException
     */
    public function actionDownPage() {
        $idRevision = Yii::app()->request->getPost('idRevision');
        $idPage = Yii::app()->request->getPost('idPage');

        $lectureRevision = RevisionLecture::model()->findByPk($idRevision);

        if (!$this->isUserEditor(Yii::app()->user, $lectureRevision)) {
            throw new RevisionControllerException(403, Yii::t('error', '0590'));
        }

        $lectureRevision->movePageDown($idPage, Yii::app()->user);
    }

    // @todo
    public function actionCheckLecture() {
        $idRevision = Yii::app()->request->getPost('idRevision');

        $lectureRevision = RevisionLecture::model()->with('lecturePages')->findByPk($idRevision);

        if (!$this->isUserEditor(Yii::app()->user, $lectureRevision)) {
            throw new RevisionControllerException(403, Yii::t('error', '0590'));
        }

        $result = $lectureRevision->checkConflicts();

        if (empty($result)) {
            echo "Конфліктів не виявлено!";
            return;
        } else {
            echo implode("; ", $result);
            return;
        }
    }

    public function actionSendForApproveLecture() {
        $idRevision = Yii::app()->request->getPost('idRevision');

        $lectureRev = RevisionLecture::model()->with('lecturePages', 'properties')->findByPk($idRevision);

        if (!$this->isUserEditor(Yii::app()->user, $lectureRev)) {
            throw new RevisionControllerException(403, Yii::t('error', '0590'));
        }

        $result = $lectureRev->checkConflicts();

        if (empty($result)) {
            $lectureRev->state->changeTo('sendForApproval', Yii::app()->user);
            $this->sendRevisionRequest($lectureRev);
        } else {
            echo implode(", ",$result);
        }
    }
    
    public function actionCancelSendForApproveLecture() {
        $idRevision = Yii::app()->request->getPost('idRevision');

        $lectureRev = RevisionLecture::model()->with('lecturePages', 'properties')->findByPk($idRevision);

        if (!$this->isUserEditor(Yii::app()->user, $lectureRev)) {
            throw new RevisionControllerException(403, Yii::t('error', '0590'));
        }

        $lectureRev->state->changeTo('editable', Yii::app()->user);
        $revisionRequest=MessagesRevisionRequest::model()->findByAttributes(array('id_revision'=>$lectureRev->id_revision,'cancelled'=>0));
        if($revisionRequest){
            $revisionRequest->setDeleted();
        }
    }

    public function actionRejectLectureRevision() {

        if (!$this->isUserApprover(Yii::app()->user)) {
            throw new RevisionControllerException(403, Yii::t('revision', '0827'));
        }

        $idRevision = Yii::app()->request->getPost('idRevision');
        $lectureRev = RevisionLecture::model()->with("properties", "lecturePages")->findByPk($idRevision);

        $lectureRev->state->changeTo('rejected', Yii::app()->user);
        $revisionRequest=MessagesRevisionRequest::model()->findByAttributes(array('id_revision'=>$lectureRev->id_revision,'cancelled'=>0, 'user_rejected'=> null));
        if($revisionRequest){
            $revisionRequest->setRejected();
        }
    }

    public function actionCancelLectureRevision () {
        $idRevision = Yii::app()->request->getPost('idRevision');
        $lectureRev = RevisionLecture::model()->with("properties", "lecturePages")->findByPk($idRevision);

        if (!$this->isUserApprover(Yii::app()->user)) {
            throw new RevisionControllerException(403, Yii::t('error', '0590'));
        }

        $lectureRev->state->changeTo('cancel', Yii::app()->user);
    }

    /**
     * curl -XPOST --data 'idLecture=126' 'http://intita.project/revision/ApproveLectureRevision' -b XDEBUG_SESSION=PHPSTORM
     * @throws Exception
     * @throws RevisionControllerException
     */
    public function actionApproveLectureRevision() {

        if (!$this->isUserApprover(Yii::app()->user)) {
            throw new RevisionControllerException(403, Yii::t('revision', '0828'));
        }

        $idRevision = Yii::app()->request->getPost('idRevision');
        $lectureRev = RevisionLecture::model()->with("properties", "lecturePages")->findByPk($idRevision);
        $lectureRev->state->changeTo('approved', Yii::app()->user);
        $revisionRequest=MessagesRevisionRequest::model()->findByAttributes(array('id_revision'=>$lectureRev->id_revision,'cancelled'=>0, 'user_approved'=> null));
        if($revisionRequest){
            $revisionRequest->setApproved();
        }
    }

    public function actionReadyLectureRevision() {

        if (!$this->isUserApprover(Yii::app()->user)) {
            throw new RevisionControllerException(403, Yii::t('revision', '0828'));
        }

        $idRevision = Yii::app()->request->getPost('idRevision');
        $lectureRev = RevisionLecture::model()->with("properties", "lecturePages")->findByPk($idRevision);
        $lectureRev->state->changeTo('release', Yii::app()->user);
    }

    public function actionProposedToReleaseRevision() {

        if (!$this->isUserApprover(Yii::app()->user)) {
            throw new RevisionControllerException(403, Yii::t('revision', '0828'));
        }

        $idRevision = Yii::app()->request->getPost('idRevision');
        $lectureRev = RevisionLecture::model()->with("properties", "lecturePages")->findByPk($idRevision);
        $lectureRev->state->changeTo('readyForRelease', Yii::app()->user);
    }

    public function actionCancelProposedToReleaseRevision() {

        if (!$this->isUserApprover(Yii::app()->user)) {
            throw new RevisionControllerException(403, Yii::t('revision', '0828'));
        }

        $idRevision = Yii::app()->request->getPost('idRevision');
        $lectureRev = RevisionLecture::model()->with("properties", "lecturePages")->findByPk($idRevision);
        $lectureRev->state->changeTo('approved', Yii::app()->user);
    }
    
    public function actionCancelEditRevisionByEditor () {
        $idRevision = Yii::app()->request->getPost('idRevision');
        $lectureRev = RevisionLecture::model()->with('lecturePages', 'properties')->findByPk($idRevision);

        if (!$this->isUserEditor(Yii::app()->user, $lectureRev) && $lectureRev->canCancelEdit()) {
            throw new RevisionControllerException(403, Yii::t('error', '0590'));
        }
        $lectureRev->state->changeTo('cancelledAuthor', Yii::app()->user);
    }

    public function actionRestoreEditRevisionByEditor () {
        $idRevision = Yii::app()->request->getPost('idRevision');
        $lectureRev = RevisionLecture::model()->with('lecturePages', 'properties')->findByPk($idRevision);

        if (!$this->isUserEditor(Yii::app()->user, $lectureRev) && $lectureRev->canRestoreEdit()) {
            throw new RevisionControllerException(403, Yii::t('error', '0590'));
        }
        $lectureRev->state->changeTo('editable', Yii::app()->user);
    }

    /**
     * curl -XPOST http://intita.project/revision/UpLectureElement -d 'idRevision=139&idPage=694&idElement=772' -b XDEBUG_SESSION=PHPSTORM
     */

    public function actionUpLectureElement() {
        $idRevision = Yii::app()->request->getPost('idRevision');
        $idPage = Yii::app()->request->getPost('idPage');
        $idElement = Yii::app()->request->getPost('idElement');

        $lectureRevision = RevisionLecture::model()->findByPk($idRevision);

        if (!$this->isUserEditor(Yii::app()->user, $lectureRevision)) {
            throw new RevisionControllerException(403, Yii::t('error', '0590'));
        }

        $lectureRevision->upElement($idPage, $idElement, Yii::app()->user);
    }

    /**
     * curl -XPOST http://intita.project/revision/DownLectureElement -d 'idRevision=139&idPage=694&idElement=772' -b XDEBUG_SESSION=PHPSTORM
     */

    public function actionDownLectureElement() {
        $idRevision = Yii::app()->request->getPost('idRevision');
        $idPage = Yii::app()->request->getPost('idPage');
        $idElement = Yii::app()->request->getPost('idElement');

        $lectureRevision = RevisionLecture::model()->findByPk($idRevision);

        if (!$this->isUserEditor(Yii::app()->user, $lectureRevision)) {
            throw new RevisionControllerException(403, Yii::t('error', '0590'));
        }

        $lectureRevision->downElement($idPage, $idElement, Yii::app()->user);
    }

    /**
     * curl -XGET 'http://intita.project/revision/EditLecture?idLecture=104' -b XDEBUG_SESSION=PHPSTORM
     * @param $idLecture
     * @throws Exception
     * @throws RevisionControllerException
     */

    public function actionEditLecture($idLecture) {

        $lectureRevisions = RevisionLecture::model()->findAllByAttributes(array("id_lecture" => $idLecture));
        $lecture = Lecture::model()->findByPk($idLecture);
        if (!$lecture || !$lecture->idModule) {
            throw new RevisionControllerException(404, Yii::t('breadcrumbs', '0782'));
        }

        if (!$this->isUserTeacher(Yii::app()->user, $lecture->idModule) && !$this->isUserApprover(Yii::app()->user)) {
            throw new RevisionControllerException(403, Yii::t('revision', '0829'));
        }

        $lectureRev = null;
        /*if there is no revisions we create new revision from lecture in DB, else we should find */
        if (empty($lectureRevisions)) {
            $lectureRev = RevisionLecture::createNewRevisionFromLecture($lecture, Yii::app()->user)->cloneLecture(Yii::app()->user);
        } else {
            /*find all editable revisions */
            $editableRevisions = [];
            $lastApproved = null;
            foreach ($lectureRevisions as $lectureRevision) {
                if ($lectureRevision->canEdit()) {
                    array_push($editableRevisions, $lectureRevision);
                } 
                if ($lectureRevision->isApproved()) {
                    $lastApproved = $lectureRevision;
                }
            }
            /*
             * If we haven't found any editable revision or found one revision other user we should create new revision from last approved
             * If we have found only one revision of this user just show it
             * If we have found several editable revisions show revisions tree;
             */
            if (count($editableRevisions) == 0 || (count($editableRevisions) == 1 && !$editableRevisions[0]->canEdit())) {
                $lectureRev = $lastApproved->cloneLecture(Yii::app()->user);
            } else if(count($editableRevisions) == 1 && $editableRevisions[0]->canEdit()) {
                $lectureRev = $editableRevisions[0];
            } else {
                $this->render('revisionsBranch', array(
                    'idModule' => $editableRevisions[0]->id_module,
                    'idRevision' => $editableRevisions[0]->id_revision,
                    'isApprover' => $this->isUserApprover(Yii::app()->user),
                    'userId' => Yii::app()->user->getId(),
                ));
                return;
            }
        }

        $this->render("lectureview", array(
            "lectureRevision" => $lectureRev,
            "pages" => $lectureRev->lecturePages
        ));

    }

    public function actionRevisionsBranch($idRevision) {
        $lectureRev = RevisionLecture::model()->findByPk($idRevision);
        if(!$lectureRev)
            throw new RevisionControllerException(404);
        if (!$this->isUserTeacher(Yii::app()->user,$lectureRev->id_module) && !$this->isUserApprover(Yii::app()->user)) {
            throw new RevisionControllerException(403, Yii::t('revision', '0829'));
        }

        $this->render('revisionsBranch', array(
            'idModule' => $lectureRev->id_module,
            'idRevision' => $idRevision,
            'isApprover' => $this->isUserApprover(Yii::app()->user),
            'userId' => Yii::app()->user->getId(),
        ));
    }

    public function actionDeleteLecture() {
        $idLecture = Yii::app()->request->getPost('idLecture');
        $user = Yii::app()->user;
        $lecture = Lecture::model()->findByPk($idLecture);

        $lectureRev = RevisionLecture::model()->findByAttributes(array("id_lecture" => $idLecture));

        if (!$this->isUserTeacher($user, $lecture->idModule)) {
            throw new RevisionControllerException(403, Yii::t('revision', '0830'));
        }

        if ($lectureRev == null) {
            $lectureRev = RevisionLecture::createNewRevisionFromLecture($lecture, $user);
        }

        $lectureRev->state->changeTo('cancel', Yii::app()->user);
        $lectureRev->deleteLectureFromRegularDB();
    }

    public function actionModuleLecturesRevisions($idModule) {
        if (!$this->isUserTeacher(Yii::app()->user, $idModule) && !$this->isUserApprover(Yii::app()->user)) {
            throw new RevisionControllerException(403, Yii::t('revision', '0829'));
        }

        $this->render('moduleLecturesRevisions', array(
            'idModule' => $idModule,
            'isApprover' => $this->isUserApprover(Yii::app()->user),
            'userId' => Yii::app()->user->getId(),
            'author' => $this->isUserTeacher(Yii::app()->user, $idModule)
        ));
    }

    public function actionBuildRevisionsInModule() {
        $idModule = Yii::app()->request->getPost('idModule');
        $lectureRev = RevisionLecture::model()->findAllByAttributes(array("id_module" => $idModule));
        $relatedTree = RevisionLecture::getLecturesTree($idModule);
        $json = $this->buildLectureTreeJson($lectureRev, $relatedTree);

        echo $json;
    }

    public function actionBuildRevisionsBranch() {
        $idRevision = Yii::app()->request->getPost('idRevision');
        $lectureRev = RevisionLecture::model()->findByPk(array("id_revision" => $idRevision));
        $relatedRev = $lectureRev->getRelatedLectures();
        $relatedTree = RevisionLecture::getLecturesTree($lectureRev->id_module);
        $json = $this->buildLectureTreeJson($relatedRev, $relatedTree);

        echo $json;
    }
    
    public function actionBuildAllRevisions() {
        $lectureRev = RevisionLecture::model()->with("properties")->findAll();
        $lecturesTree = RevisionLecture::getLecturesTree();
        $json = $this->buildLectureTreeJson($lectureRev, $lecturesTree);

        echo $json;
    }
    //build revisions tree in branch from approved lecture
    //todo refactor
    public function actionBuildApprovedLectureRevisions() {
        $idRevision = Yii::app()->request->getPost('idRevision');
        $lectureRev = RevisionLecture::model()->findByPk($idRevision);

        $relatedTree = RevisionLecture::getLecturesTree($lectureRev->id_module);

        $quickUnion=$lectureRev->getQuickUnionRevisions();
        $branchRevisionsId=$lectureRev->getRelatedIdListInBranch($quickUnion);
        //get revision which is approved
        $approvedRevision=$lectureRev->getApprovedRevision($branchRevisionsId);
        if($approvedRevision){
            $branchRevisionsIdFromApproved=$lectureRev->getRelatedIdListFromApproved($quickUnion,$approvedRevision->id_revision);
            $relatedTree[$approvedRevision->id_revision]=$approvedRevision->id_revision;
        }else{
            $branchRevisionsIdFromApproved=[];
        }

        $relatedRev = RevisionLecture::model()->with('properties')->findAllByPk($branchRevisionsIdFromApproved);

        //make id_parent of approved revision as id_revision

        $json = $this->buildLectureTreeJson($relatedRev, $relatedTree);

        echo $json;
    }

    public function actionBuildApprovedBranchPartInModule() {
        $idModule = Yii::app()->request->getPost('idModule');
        $lectureRev = RevisionLecture::model()->findAllByAttributes(array("id_module" => $idModule));
        $relatedTree = RevisionLecture::getLecturesTree($idModule);

        $approvedRevisions=RevisionLecture::getApprovedRevisionsInModule($idModule);
        if(count($lectureRev)) {
            $quickUnion = $lectureRev[0]->getQuickUnionRevisions();
            if ($approvedRevisions) {
                $moduleRevisions = [];
                foreach ($approvedRevisions as $branch) {
                    $moduleRevisions = array_merge($moduleRevisions, $branch->getRelatedIdListFromApproved($quickUnion, $branch->id_revision));
                    $relatedTree[$branch->id_revision] = $branch->id_revision;
                }
            } else {
                $moduleRevisions = [];
            }
            $relatedRev = RevisionLecture::model()->with('properties')->findAllByPk($moduleRevisions);
            $json = $this->buildLectureTreeJson($relatedRev, $relatedTree);
            echo $json;
        }
    }

    public function actionShowRevision($idRevision) {
        $lectureRev = RevisionLecture::model()->with('properties, lecturePages')->findByPk($idRevision);

    }

    /**
     * Test
     * curl -XPOST --data 'revisionId=138&pageId=691&idType=12&condition=condition&testTitle=testTitle&optionsNum=2&answer1=answer1&is_valid1=1&answer2=answer2&is_valid2=0' 'http://intita.project/revision/addtest' -b XDEBUG_SESSION=PHPSTORM
     *
     * Plain task
     * curl -XPOST --data 'revisionId=139&pageId=699&idType=6&condition=condition' 'http://intita.project/revision/addtest' -b XDEBUG_SESSION=PHPSTORM
     *
     * Skip task
     * curl -XPOST --data 'revisionId=141&pageId=705&idType=9&condition=condition&question=question&source=source&text=text&answer[0][index]=1&answer[0][caseInsensitive]=1&answer[0][value]=answer1&answer[1][index]=2&answer[1][caseInsensitive]=0&answer[1][value]=answer1' 'http://intita.project/revision/addtest' -b XDEBUG_SESSION=PHPSTORM
     *
     * Taks
     * curl -XPOST --data 'revisionId=141&pageId=715&idType=5&condition=condition&language=language&assignment=1&table=table' 'http://intita.project/revision/addtest' -b XDEBUG_SESSION=PHPSTORM
     *
     * @return bool|null
     * @throws CDbException
     * @throws RevisionLectureElementException
     */
    public function actionAddTest() {
        $revisionId = Yii::app()->request->getPost('revisionId');
        $pageId = Yii::app()->request->getPost('pageId');
        $idType = Yii::app()->request->getPost('idType');

        $htmlBlock = trim(Yii::app()->request->getPost('condition', ''));

        $quiz = RevisionQuizFactory::getQuizParams($idType, Yii::app()->request);

        $lectureRevision = RevisionLecture::model()->findByPk($revisionId);

        //todo check

        $lectureRevision->addLectureElement($pageId, ['idType' => $idType,
            'html_block' => $htmlBlock,
            'quiz' => $quiz], Yii::app()->user);

        $this->redirect(Yii::app()->request->urlReferrer);
    }

    /**
     * curl -XPOST --data 'revisionId=138&pageId=691&idBlock=756&condition=condition2&testTitle=testTit le2&optionsNum=2&answer1=answer3&answer2=answer4&is_valid2=1' 'http://intita.project/revision/EditTest' -b XDEBUG_SESSION=PHPSTORM
     */
    public function actionEditTest() {

        $revisionId = Yii::app()->request->getPost('revisionId');
        $pageId = Yii::app()->request->getPost('pageId');
        $lectureElementId = Yii::app()->request->getPost('idBlock');
        $idType = Yii::app()->request->getPost('idType');

        $htmlBlock = trim(Yii::app()->request->getPost('condition', ''));

        $quiz = RevisionQuizFactory::getQuizParams($idType, Yii::app()->request);

        $lectureRevision = RevisionLecture::model()->findByPk($revisionId);

        $lectureRevision->editLectureElement($pageId, [
            'id_block' => $lectureElementId,
            'html_block' => $htmlBlock,
            'quiz' => $quiz
        ], Yii::app()->user);

        $this->redirect(Yii::app()->request->urlReferrer);
    }

    /**
     * curl -XPOST --data 'revisionId=138&pageId=691&idBlock=757' 'http://intita.project/revision/DeleteTest'  -b XDEBUG_SESSION=PHPSTORM
     */
    public function actionDeleteTest() {
        $revisionId = Yii::app()->request->getPost('revisionId');
        $pageId = Yii::app()->request->getPost('pageId');
        $idBlock = Yii::app()->request->getPost('idBlock', 0);

        $lectureRevision = RevisionLecture::model()->findByPk($revisionId);
        $lectureRevision->deleteLectureElement($pageId, $idBlock, Yii::app()->user);
    }

    /**
     * curl -XPOST --data 'idRevision=99' 'http://intita.project/revision/CloneLecture' -b XDEBUG_SESSION=PHPSTORM
     */
    public function actionCloneLecture() {
        $idRevision = Yii::app()->request->getPost('idRevision');

        $lectureRevision = RevisionLecture::model()->findByPk($idRevision);

        $lectureRevision->cloneLecture(Yii::app()->user);
    }

    /**
     *  curl -XPOST --data 'idPage=588' 'http://intita.project/revision/DeletePage' -b XDEBUG_SESSION=PHPSTORM
     */
    public function actionDeletePage() {
        $idPage = Yii::app()->request->getPost('idPage');
        $idRevision = Yii::app()->request->getPost('idRevision');
        $lectureRevision = RevisionLecture::model()->findByPk($idRevision);
        $lectureRevision->deletePage($idPage, Yii::app()->user);
    }

    /**
     *  curl -XPOST --data 'idRevision=139&title_ua=title_ua&title_ru=title_ru&title_en=title_en&alias=alias' 'http://intita.project/revision/EditProperties' -b XDEBUG_SESSION=PHPSTORM
     */
    public function actionEditProperties() {
        $idRevision = Yii::app()->request->getPost('idRevision');

        $lectureRevision = RevisionLecture::model()->findByPk($idRevision);

        if (!$this->isUserEditor(Yii::app()->user, $lectureRevision)) {
            throw new RevisionControllerException(403, Yii::t('error', '0590'));
        }

        $params = [];
        foreach (RevisionLecture::getEditableProperties() as $property) {
            $input = Yii::app()->request->getPost($property);
            if (isset($input)) {
                $params[$property] = $input;
            }
        }

        $lectureRevision->editProperties($params, Yii::app()->user);
    }

//    action editProperties for editable.EditableField widget
    public function actionXEditableEditProperties() {
        $idRevision = Yii::app()->request->getPost('pk');
        $attr = Yii::app()->request->getPost('name');
        $input = Yii::app()->request->getPost('value');

        $lectureRevision = RevisionLecture::model()->findByPk($idRevision);

        if (!$this->isUserEditor(Yii::app()->user, $lectureRevision)) {
            throw new RevisionControllerException(403, Yii::t('error', '0590'));
        }

        $params[$attr] = $input;
        $lectureRevision->editProperties($params, Yii::app()->user);
    }

    /**
     * Returns true if $user can approve or reject.
     * @param $user
     * @return bool
     * @throws CDbException
     */
    private function isUserApprover($user) {
        return RegisteredUser::userById($user->getId())->canApprove();
    }

    /**
     * Returns true if $user can edit $lecture (if the $user created the $lecture)
     * @param $user
     * @param RevisionLecture $lectureRev
     * @return mixed
     */
    private function isUserEditor($user, $lectureRev) {
        return ($lectureRev->properties->id_user_created == $user->getId());
    }

    /**
     * Returns true if $user is belongs to module teachers.
     * @param $user
     * @param $idModule
     * @return bool
     */
    private function isUserTeacher($user, $idModule) {
        return Teacher::isTeacherAuthorModule($user->getId(), $idModule);
    }

    /**
     * Function to build tree of lectures based on quickUnion data structure
     * @param $tree - tree to build, passed by reference
     * @param $node - node to add
     * @param $parents - quick union structure
     */
    private function appendNode(&$tree, $node, $parents) {
        if ($parents[$node['id']] == $node['id']) {
            //if root node
            $tree[$node['id']] = $node;
        } else {
            $path = [];
            $parentId = $parents[$node['id']];

            //building path from root to target node
            array_push($path, $parentId);
            while ($parents[$parentId] != $parentId) {
                array_push($path, $parents[$parentId]);
                $parentId = $parents[$parentId];
            }

            //finding reference to target node
            $targetNode = &$tree;
            while (count($path) != 0) {
                if (!array_key_exists('nodes', $targetNode)) {
                    $targetNode =& $targetNode[array_pop($path)];
                } else {
                    $targetNode =& $targetNode['nodes'][array_pop($path)];
                }
            }

            //adding node to 'nodes' array in target node
            if (!array_key_exists('nodes', $targetNode)) {
                $targetNode['nodes'] = array();
            }
            $targetNode['nodes'][$node['id']] = $node;
        }
    }

    private function appendNodeMultiselect(&$tree, $node, $parents, $actualRevisionsList) {
//       do if node is in array list
        if (in_array($node['id'], $actualRevisionsList)) {
//       change parent node if current parent node absent in array list
            if(!in_array($parents[$node['id']], $actualRevisionsList)){
                $tempParent=$parents[$node['id']];
                while (!in_array($tempParent, $actualRevisionsList)) {
                    $oldParent=$tempParent;
                    $tempParent=$parents[$tempParent];
                    if($oldParent==$tempParent){
                        $tempParent=$node['id'];
                        break;
                    }
                }
                $parents[$node['id']]=$tempParent;
            }
            if ($parents[$node['id']] == $node['id']) {
                //if root node
                $tree[$node['id']] = $node;
            } else{
                $path = [];

                if (in_array($parents[$node['id']], $actualRevisionsList)) {
                    $parentId = $parents[$node['id']];
                } else {
                    $parentId = $node['id'];
                }
                //building path from root to target node
                array_push($path, $parentId);
                $i=0;

                while ($parents[$parentId] != $parentId) {
                    $i=$i+1;

                    if (!in_array($parents[$parentId], $actualRevisionsList)) {
                        // find parent
                        $tempParent=$parents[$parentId];
                        $end=false;

                        while (!in_array($tempParent, $actualRevisionsList)) {
                            $oldParent=$tempParent;
                            $tempParent=$parents[$tempParent];
                            if($oldParent==$tempParent){
                                if(!in_array($tempParent, $actualRevisionsList)){
                                    $end=true;
                                    break;
                                }else{
                                    $parentId=$tempParent;
                                    break;
                                }
                            }
                        }
                        if($end) break;

                        array_push($path, $tempParent);
                        $parentId=$tempParent;

                    }
                    if($parents[$parentId] != $parentId){
                        if (in_array($parents[$parentId], $actualRevisionsList)) {
                            array_push($path, $parents[$parentId]);
                        }
                        $parentId = $parents[$parentId];
                    }
                }
                
                //finding reference to target node
                $targetNode = &$tree;
                while (count($path) != 0) {
                    if (!array_key_exists('nodes', $targetNode)) {
                        $targetNode =& $targetNode[array_pop($path)];
                    } else {
                        $targetNode =& $targetNode['nodes'][array_pop($path)];
                    }
                }
                //adding node to 'nodes' array in target node

                if (!array_key_exists('nodes', $targetNode)) {
                    $targetNode['nodes'] = array();
                }
                $targetNode['nodes'][$node['id']] = $node;
            }
        }
    }

    private function buildLectureTreeJson($lectures, $lectureTree) {
        $jsonArray = [];
        foreach ($lectures as $lecture) {
            $node = array();
            $node['text'] = "Ревізія №" . $lecture->id_revision . " " .
                $lecture->properties->title_ua . ". Статус: <strong>" . $lecture->state->getName().'</strong>'.
                ' Створена: '.$lecture->properties->start_date.' Модифікована: '.$lecture->properties->update_date;
            $node['selectable'] = false;
            $node['id'] = $lecture->id_revision;
            $node['creatorId'] = $lecture->properties->id_user_created;
            $node['isSendable'] = $lecture->isSendable();
            $node['canCancelProposedToRelease'] = $lecture->canCancelProposedToRelease();
            $node['isApprovable'] = $node['canCancelProposedToRelease']?false:$lecture->isApprovable();
            $node['isCancellable'] = $lecture->isCancellable();
            $node['isEditable'] = $lecture->isEditable();
            $node['isRejectable'] = $lecture->isRejectable();
            $node['isSendedCancellable'] = $lecture->isRevokeable();
            $node['isEditCancellable'] = $lecture->isEditable();
            $node['canRestoreEdit'] = $lecture->isCancelledEditor();
            $node['canCreate'] = $lecture->canCreate();
            $node['canProposedToRelease'] = $lecture->canProposedToRelease();

            $this->appendNode($jsonArray, $node, $lectureTree);
        }
        return json_encode(array_values($jsonArray));
    }

    public function buildLectureTreeJsonMultiselect($lectures, $lectureTree, $actualIdList) {
        $jsonArray = [];
        foreach ($lectures as $lecture) {
            $node = array();
            $node['text'] = "Ревізія №" . $lecture->id_revision . " " .
                $lecture->properties->title_ua . ". Статус: <strong>" . $lecture->state->getName().'</strong>'.
                ' Створена: '.$lecture->properties->start_date.' Модифікована: '.$lecture->properties->update_date;
            $node['selectable'] = false;
            $node['id'] = $lecture->id_revision;
            $node['creatorId'] = $lecture->properties->id_user_created;
            $node['isSendable'] = $lecture->isSendable();
            $node['canCancelProposedToRelease'] = $lecture->canCancelProposedToRelease();
            $node['isApprovable'] = $node['canCancelProposedToRelease']?false:$lecture->isApprovable();
            $node['isCancellable'] = $lecture->isCancellable();
            $node['isEditable'] = $lecture->isEditable();
            $node['isRejectable'] = $lecture->isRejectable();
            $node['isSendedCancellable'] = $lecture->isRevokeable();
            $node['isEditCancellable'] = $lecture->isEditable();
            $node['canRestoreEdit'] = $lecture->isCancelledEditor();
            $node['canCreate'] = $lecture->canCreate();
            $node['canProposedToRelease'] = $lecture->canProposedToRelease();

            $this->appendNodeMultiselect($jsonArray, $node, $lectureTree, $actualIdList);
        }
        return json_encode(array_values($jsonArray));
    }

    public function actionDataTest() {
        $idPage = Yii::app()->request->getPost('idPage');
        $page = RevisionLecturePage::model()->findByPk($idPage);
        $data = [];
        $data["condition"] =  $page->getQuiz()->html_block;
        $answers=RevisionTests::getTestAnswers($page->quiz);
        $valid=RevisionTestsAnswers::getTestValid($page->quiz);
        $data["answers"]=$answers;
        $data["valid"]=$valid;

        echo CJSON::encode($data);
    }

    public function actionCreateLectureRevision($idRevision) {

        $lectureRevision = RevisionLecture::model()->with("properties", "lecturePages")->findByPk($idRevision);

        if (!$this->isUserTeacher(Yii::app()->user, $lectureRevision->id_module)) {
            throw new RevisionControllerException(403, Yii::t('error', '0590'));
        }

        $lectureRevision = $lectureRevision->cloneLecture(Yii::app()->user);
        if($lectureRevision){
            $this->redirect(Yii::app()->createUrl('/revision/editLectureRevision',array('idRevision'=>$lectureRevision->id_revision)));
        }else{
            throw new RevisionControllerException(500, 'CreateLectureRevision error');
        }
    }

    public function actionGetRevisionPreviewData()
    {
        $idRevision = Yii::app()->request->getPost('idRevision');

        $lectureRevision = RevisionLecture::model()->with("properties", "lecturePages")->findByPk($idRevision);

        $pages = [];
        $lecture = [];
        $data = array('lecture' => array(),'pages' => array());
        foreach ($lectureRevision->lecturePages as $key=>$page) {
            $pages[$key]["id"] = $page->id;
            $pages[$key]['title'] = $page->page_title;
            $pages[$key]["page_order"] = $page->page_order;
            $pages[$key]["quiz"] = isset($page->getQuiz()->id_type)?$page->getQuiz()->id_type:null;
            $pages[$key]["video"] = $page->video;
        }
        $lecture['status']=$lectureRevision->state->getName();
        $lecture['canEdit']=$lectureRevision->canEdit();
        $lecture['canSendForApproval']=$lectureRevision->canSendForApproval();
        $lecture['canCancelSendForApproval']=$lectureRevision->canCancelSendForApproval();
        $lecture['canApprove']=$lectureRevision->canApprove();
        $lecture['canCancelReadyRevision']=$lectureRevision->canCancelReadyRevision();
        $lecture['canRejectRevision']=$lectureRevision->canRejectRevision();
        $lecture['canCancelEdit']=$lectureRevision->canCancelEdit();
        $lecture['canRestoreEdit']=$lectureRevision->canRestoreEdit();
        $lecture['canProposedToRelease'] = $lectureRevision->canProposedToRelease();
        $lecture['canCancelProposedToRelease'] = $lectureRevision->canCancelProposedToRelease();
        $lecture['link']=
            $lecture['canCancelReadyRevision']?
                Yii::app()->createUrl("lesson/index", array("id" => $lectureRevision->id_lecture, "idCourse" => 0)):null;

        $data['lecture']=$lecture;
        $data['pages']=$pages;
        echo CJSON::encode($data);
    }

    public function actionVideoPreview()
    {
        $idRevision = $_GET['idRevision'];
        $pageOrder = $_GET['idPage'];

        $lectureRevision = RevisionLecture::model()->findByPk($idRevision);
        $page=$lectureRevision->lecturePages[$pageOrder-1];

        echo $this->renderPartial('lecturePreview/_videoTab',
            array('page' => $page), true);
    }

    public function actionTextPreview()
    {
        $idRevision = $_GET['idRevision'];
        $pageOrder = $_GET['idPage'];

        $lectureRevision = RevisionLecture::model()->findByPk($idRevision);
        $page=$lectureRevision->lecturePages[$pageOrder-1];

        $dataProvider = new CArrayDataProvider($page->getLectureBody());

        echo $this->renderPartial('lecturePreview/_textTab',
            array('data' => $dataProvider->getData()), true);
    }

    public function actionQuizPreview()
    {
        $idRevision = $_GET['idRevision'];
        $pageOrder = $_GET['idPage'];

        $lectureRevision = RevisionLecture::model()->findByPk($idRevision);
        $page=$lectureRevision->lecturePages[$pageOrder-1];

        $quiz = $page->getQuiz();
        echo $this->renderPartial('lecturePreview/_quiz',
            array('quiz' => $quiz), true);
    }

    public function actionCheckTestAnswer()
    {
        $emptyanswers = [];
        $test =  Yii::app()->request->getPost('test', '');
        $answers = Yii::app()->request->getPost('answers', $emptyanswers);

        echo RevisionTestsAnswers::checkTestAnswer($test, $answers);
    }

    public function actionCheckSkipAnswer()
    {
        $quizId = $_POST['id'];
        $answers = $_POST['answers'];
        echo RevisionSkipTaskAnswers::checkSkipAnswer($quizId,$answers);
    }

    public function actionBuildCurrentLectureJson() {
        $idModule = Yii::app()->request->getPost('idModule');
        $currentLectures=Lecture::model()->findAllByAttributes(array("idModule" => $idModule),array('order'=>'`order` ASC'));
        $data = [];
        foreach ($currentLectures as $key=>$lecture) {
            $data[$key]['title'] = $lecture->title_ua;
            $data[$key]['order'] = $lecture->order;
            $data[$key]['id'] = $lecture->id;
            $data[$key]['revisionsLink'] = Yii::app()->createUrl('/revision/editLecture',array('idLecture'=>$lecture->id));
            $data[$key]['lecturePreviewLink'] = Yii::app()->createUrl("lesson/index", array("id" => $lecture->id, "idCourse" => 0));
            $lectureRev = RevisionLecture::getParentRevisionForLecture($lecture->id);
            $data[$key]['approvedFromRevision'] = ($lectureRev)?$lectureRev->id_revision:null;
        }
        echo CJSON::encode($data);
    }

    public function actionPlainTaskCondition()
    {
        $idBlock = Yii::app()->request->getPost('idBlock');
        $data = [];
        $plainTask=RevisionLectureElement::model()->findByPk($idBlock);
        $data["condition"]=$plainTask->html_block;

        echo CJSON::encode($data);
    }

    public function actionDataSkipTaskCondition()
    {
        $idBlock = Yii::app()->request->getPost('idBlock');
        $data = [];
        $skipTask=RevisionSkipTask::model()->findByAttributes(array("condition" => $idBlock));
        $data["condition"]=$skipTask->lectureElement->html_block;
        $data["source"]=$skipTask->source;

        echo CJSON::encode($data);
    }

    public function actionDataTaskCondition()
    {
        $idBlock = Yii::app()->request->getPost('idBlock');
        $data = [];
        $task=RevisionTask::model()->findByAttributes(array("id_lecture_element" => $idBlock));
        $data["condition"] =  $task->lectureElement->html_block;;

        echo CJSON::encode($data);
    }

    //get task uid by revision page id
    public function actionGetTaskUIDbyElementId()
    {
        $blockId = Yii::app()->request->getPost('blockId');
        $quiz=RevisionTask::model()->findByAttributes(array('id_lecture_element'=>$blockId));
        if($quiz)
            echo $quiz->uid;
        else echo false;
    }

    //get data for send letter to author of revision
    public function actionGetDataForRevisionMail()
    {
        $idRevision = Yii::app()->request->getPost('idRevision');
        $lectureRevision = RevisionLecture::model()->findByPk($idRevision);

        if (!$this->isUserTeacher(Yii::app()->user, $lectureRevision->id_module) && !$this->isUserApprover(Yii::app()->user)) {
            throw new RevisionControllerException(403, Yii::t('error', '0590'));
        }

        $data = [];
        $data['authorName'] =StudentReg::getUserNamePayment($lectureRevision->properties->id_user_created);
        $data['authorId'] =$lectureRevision->properties->id_user_created;
        $data['theme'] = "Ревізія №" . $lectureRevision->id_revision . " " . $lectureRevision->properties->title_ua;
        $data["link"]=Yii::app()->createUrl('/revision/previewLectureRevision',array('idRevision'=>$lectureRevision->id_revision));

        echo CJSON::encode($data);
    }

    public function actionBuildTreeInBranch() {
        $idRevision = Yii::app()->request->getPost('idRevision');
        $status = Yii::app()->request->getPost('status');
        $idAuthor = Yii::app()->request->getPost('idAuthor');
        $lectureRev = RevisionLecture::model()->findByPk(array("id_revision" => $idRevision));
        
        $actualIdList=RevisionLecture::getFilteredIdRevisions($status,$lectureRev->id_module,$idAuthor);
        
        $relatedRev = $lectureRev->getRelatedLectures();
        $relatedTree = RevisionLecture::getLecturesTree($lectureRev->id_module);
        $json = $this->buildLectureTreeJsonMultiselect($relatedRev, $relatedTree, $actualIdList);

        echo $json;
    }

    public function actionBuildTreeInModule() {
        $idModule = Yii::app()->request->getPost('idModule');
        $status = Yii::app()->request->getPost('status');
        $idAuthor = Yii::app()->request->getPost('idAuthor');
        $lectureRev = RevisionLecture::model()->findAllByAttributes(array("id_module" => $idModule));
        $actualIdList=RevisionLecture::getFilteredIdRevisions($status,$idModule,$idAuthor);
        $relatedTree = RevisionLecture::getLecturesTree($idModule);
        $json = $this->buildLectureTreeJsonMultiselect($lectureRev, $relatedTree, $actualIdList);

        echo $json;
    }

    public function actionBuildAllFilteredRevisionsTree() {
        $status = Yii::app()->request->getPost('status');
        $idAuthor = Yii::app()->request->getPost('idAuthor');
        $lectureRev = RevisionLecture::model()->with("properties")->findAll();
        $actualIdList=RevisionLecture::getFilteredIdRevisions($status,null,$idAuthor);
        $lecturesTree = RevisionLecture::getLecturesTree();
        $json = $this->buildLectureTreeJsonMultiselect($lectureRev, $lecturesTree, $actualIdList);

        echo $json;
    }

    private function sendRevisionRequest(RevisionLecture $revision){
        if($revision){
            $message = new MessagesRevisionRequest();
            if($message->isRequestOpen(array($revision))) {
                echo "Такий запит вже надіслано. Ви не можете надіслати запит на затвердження ревізії лекції двічі.";
            } else {
                $transaction = Yii::app()->db->beginTransaction();
                try {
                    $message->build($revision, Yii::app()->user->model->registrationData);
                    $message->create();
                    $sender = new MailTransport();

                    $message->send($sender);
                    $transaction->commit();
                    echo "Запит на затвердження ревізії лекції успішно відправлено. Зачекайте, поки адміністратор сайта підтвердить запит.";
                } catch (Exception $e) {
                    $transaction->rollback();
                    throw new \application\components\Exceptions\IntItaException(500, "Запит на затвердження ревізії лекції не вдалося надіслати.");
                }
            }
        } else {
            throw new \application\components\Exceptions\IntItaException(400);
        }
    }

    public function actionRevisionsAuthors() {
        if(Yii::app()->request->getPost('idModule')){
            $idModule=Yii::app()->request->getPost('idModule');
            echo json_encode(RevisionLecture::getRevisionsAuthors($idModule));
            die;
        }else if(Yii::app()->request->getPost('idRevision')){
            $idModule=RevisionLecture::model()->findByPk(Yii::app()->request->getPost('idRevision'))->id_module;
            echo json_encode(RevisionLecture::getRevisionsAuthors($idModule));
            die;
        }else{
            echo json_encode(RevisionLecture::getRevisionsAuthors());
            die;
        }
    }
    
}