<?php

class RevisionController extends Controller {
    public $layout = 'revisionlayout';

    public function init()
    {
        parent::init();
        $app = Yii::app();
        if (isset($app->session['lg'])) {
            $app->language = $app->session['lg'];
        }
        if (Yii::app()->user->isGuest) {
            $this->render('/site/authorize');
            die();
        } else return true;
    }

    public function actionIndex() {
        if (!$this->isUserApprover(Yii::app()->user)) {
            throw new RevisionControllerException(403, 'Access denied.');
        }

        $this->render('index',array(
            'isApprover' => true,
            'userId' => Yii::app()->user->getId(),
        ));
    }

    public function actionCreateNewLecture() {

        $idModule = Yii::app()->request->getPost("idModule");
//        $order = Yii::app()->request->getPost("order");
        $titleUa = trim(Yii::app()->request->getPost("titleUa"));
        $titleEn = trim(Yii::app()->request->getPost("titleEn"));
        $titleRu = trim(Yii::app()->request->getPost("titleRu"));

        if (!$this->isUserTeacher(Yii::app()->user, $idModule)) {
            throw new RevisionControllerException(403, 'Access denied.');
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
            throw new RevisionControllerException(403, 'У тебе немає прав для редагування цієї ревізії');
        }

        if (!$lectureRevision->isEditable()) {
            throw new RevisionControllerException(403, 'Цю ревізію редагувати не можна');
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
            throw new RevisionControllerException(403, 'Access denied.');
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
//            throw new CHttpException(403, 'Access denied.');
            throw new RevisionControllerException('Access denied.');
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
            throw new RevisionControllerException(403, 'Access denied.');
        }
        if (!$lectureRevision->isEditable()) {
            throw new RevisionControllerException(400, 'This lecture cannot be modified.');
        }

        $lectureBody = $page->getLectureBody();
        $dataProvider = new CArrayDataProvider($lectureBody);
        $quiz = $page->getQuiz();

        $this->render("indexCKE", array(
            'user' => Yii::app()->user->getId(),
            "page" => $page,
            "dataProvider" => $dataProvider,
            "quiz" => $quiz));
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
            throw new RevisionControllerException(403, 'Access denied.');
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
            throw new RevisionControllerException(403, 'Access denied.');
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
            throw new RevisionControllerException(403, 'Access denied.');
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
            throw new RevisionControllerException(403, 'Access denied.');
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
            throw new RevisionControllerException(403, 'Access denied.');
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
            throw new RevisionControllerException(403, 'Access denied.');
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
            throw new RevisionControllerException(403, 'Access denied.');
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
            throw new RevisionControllerException(403, 'Access denied.');
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
            throw new RevisionControllerException(403, 'Access denied.');
        }

        $lectureRevision->movePageDown($idPage, Yii::app()->user);
    }

    // @todo
    public function actionCheckLecture() {
        $idRevision = Yii::app()->request->getPost('idRevision');

        $lectureRevision = RevisionLecture::model()->with('lecturePages')->findByPk($idRevision);

        if (!$this->isUserEditor(Yii::app()->user, $lectureRevision)) {
            throw new RevisionControllerException(403, 'Access denied.');
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
            throw new RevisionControllerException(403, 'Access denied.');
        }

        $result = $lectureRev->checkConflicts();

        if (empty($result)) {
            $lectureRev->sendForApproval(Yii::app()->user);
        } else {
            echo implode(", ",$result);
        }
    }
    public function actionCancelSendForApproveLecture() {
        $idRevision = Yii::app()->request->getPost('idRevision');

        $lectureRev = RevisionLecture::model()->with('lecturePages', 'properties')->findByPk($idRevision);

        if (!$this->isUserEditor(Yii::app()->user, $lectureRev)) {
            throw new RevisionControllerException(403, 'Access denied.');
        }

        $lectureRev->cancelSendForApproval();
    }

    public function actionRejectLectureRevision() {

        if (!$this->isUserApprover(Yii::app()->user)) {
            throw new RevisionControllerException(403, 'Access denied. You have not privileges to reject a lecture');
        }

        $idRevision = Yii::app()->request->getPost('idRevision');
        $lectureRev = RevisionLecture::model()->with("properties", "lecturePages")->findByPk($idRevision);

        $lectureRev->reject(Yii::app()->user);

    }

    public function actionCancelLectureRevision () {
        $idRevision = Yii::app()->request->getPost('idRevision');
        $lectureRev = RevisionLecture::model()->with("properties", "lecturePages")->findByPk($idRevision);

        if (!$this->isUserApprover(Yii::app()->user)) {
            throw new RevisionControllerException(403, 'Access denied.');
        }

        $lectureRev->cancel(Yii::app()->user);
        $lectureRev->deleteLectureFromRegularDB();
    }

    /**
     * curl -XPOST --data 'idLecture=126' 'http://intita.project/revision/ApproveLectureRevision' -b XDEBUG_SESSION=PHPSTORM
     * @throws Exception
     * @throws RevisionControllerException
     */
    public function actionApproveLectureRevision() {

        if (!$this->isUserApprover(Yii::app()->user)) {
            throw new RevisionControllerException(403, 'Access denied. You have not privileges to approve a lecture');
        }

        $idRevision = Yii::app()->request->getPost('idRevision');
        $lectureRev = RevisionLecture::model()->with("properties", "lecturePages")->findByPk($idRevision);
        $lectureRev->approve(Yii::app()->user);
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
            throw new RevisionControllerException(403, 'Access denied.');
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
            throw new RevisionControllerException(403, 'Access denied.');
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
        if (!$lecture) {
            throw new RevisionControllerException(404, 'Сторінка не знайдена');
        }

        if (!$this->isUserTeacher(Yii::app()->user, $lecture->idModule) && !$this->isUserApprover(Yii::app()->user)) {
            throw new RevisionControllerException(403, 'Access denied. You have not privileges to view lecture.');
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
                if ($lectureRevision->isEditable()) {
                    array_push($editableRevisions, $lectureRevision);
                } 
                if ($lectureRevision->isApproved()) {
                    $lastApproved = $lectureRevision;
                }
            }
            /*
             * If we haven't found any editable revision we should create new revision from last approved
             * If we have found only one revision just show it
             * If we have found several editable revisions show revisions tree;
             */
            if (count($editableRevisions) == 0) {
                $lectureRev = $lastApproved->cloneLecture(Yii::app()->user);
            } else if(count($editableRevisions) == 1) {
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
            throw new RevisionControllerException(403, 'Access denied. You have not privileges to view lecture.');
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
            throw new RevisionControllerException(403, 'Access denied. You have not privileges to delete lecture.');
        }

        if ($lectureRev == null) {
            $lectureRev = RevisionLecture::createNewRevisionFromLecture($lecture, $user);
        }

        $lectureRev->cancel($user);
        $lectureRev->deleteLectureFromRegularDB();
    }

    public function actionModuleLecturesRevisions($idModule) {
        if (!$this->isUserTeacher(Yii::app()->user, $idModule) && !$this->isUserApprover(Yii::app()->user)) {
            throw new RevisionControllerException(403, 'Access denied. You have not privileges to view lecture.');
        }

        $this->render('moduleLecturesRevisions', array(
            'idModule' => $idModule,
            'isApprover' => $this->isUserApprover(Yii::app()->user),
            'userId' => Yii::app()->user->getId(),
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
        $quickUnion=$lectureRev[0]->getQuickUnionRevisions();
        if($approvedRevisions){
            $moduleRevisions=[];
            foreach($approvedRevisions as $branch){
                $moduleRevisions=array_merge($moduleRevisions, $branch->getRelatedIdListFromApproved($quickUnion,$branch->id_revision));
                $relatedTree[$branch->id_revision]=$branch->id_revision;
            }
        }else{
            $moduleRevisions=[];
        }
        $relatedRev = RevisionLecture::model()->with('properties')->findAllByPk($moduleRevisions);
        $json = $this->buildLectureTreeJson($relatedRev, $relatedTree);

        echo $json;
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
            throw new RevisionControllerException(403, 'Access denied.');
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
            throw new RevisionControllerException(403, 'Access denied.');
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
     * @param $parents - quik union structre
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

    private function buildLectureTreeJson($lectures, $lectureTree) {
        $jsonArray = [];
        foreach ($lectures as $lecture) {
            $node = array();
            $node['text'] = "Ревізія №" . $lecture->id_revision . " " .
                $lecture->properties->title_ua . ". Статус: <strong>" . $lecture->getStatus().'</strong>'.
                ' Створена: '.$lecture->properties->start_date.' Модифікована: '.$lecture->properties->update_date;
            $node['selectable'] = false;
            $node['id'] = $lecture->id_revision;
            $node['creatorId'] = $lecture->properties->id_user_created;
            $node['isSendable'] = $lecture->isSendable();
            $node['isApprovable'] = $lecture->isApprovable();
            $node['isCancellable'] = $lecture->isCancellable();
            $node['isEditable'] = $lecture->isEditable();
            $node['isRejectable'] = $lecture->isRejectable();
            $node['isSendedCancellable'] = $lecture->isSendedCancellable();

            $this->appendNode($jsonArray, $node, $lectureTree);
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

    /**
     * Legacy methods
     *
     */

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

    //reorder blocks on lesson page - up block

    public function actionUpElement() {
        $idLecture = Yii::app()->request->getPost('idLecture');
        $order = Yii::app()->request->getPost('order');

        $lecture = Lecture::model()->findByPk($idLecture);

        $lecture->upElement($order);

        // if AJAX request, we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(Yii::app()->request->urlReferrer);
    }

    //reorder blocks on lesson page - down block

    public function actionDownElement() {
        $idLecture = Yii::app()->request->getPost('idLecture');
        $order = Yii::app()->request->getPost('order');

        $lecture = Lecture::model()->findByPk($idLecture);

        $lecture->downElement($order);

        // if AJAX request, we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(Yii::app()->request->urlReferrer);
    }

    public function actionCreateLectureRevision($idRevision) {

        $lectureRevision = RevisionLecture::model()->with("properties", "lecturePages")->findByPk($idRevision);

        if (!$this->isUserTeacher(Yii::app()->user, $lectureRevision->id_module)) {
            throw new RevisionControllerException(403, 'Access denied.');
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
            $pages[$key]["quiz"] = $page->quiz;
            $pages[$key]["video"] = $page->video;
        }
        $lecture['status']=$lectureRevision->getStatus();
        $lecture['canEdit']=$lectureRevision->canEdit();
        $lecture['canSendForApproval']=$lectureRevision->canSendForApproval();
        $lecture['canCancelSendForApproval']=$lectureRevision->canCancelSendForApproval();
        $lecture['canApprove']=$lectureRevision->canApprove();
        $lecture['canCancelRevision']=$lectureRevision->canCancelRevision();
        $lecture['canRejectRevision']=$lectureRevision->canRejectRevision();
        $lecture['link']=
            $lecture['canCancelRevision']?
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
}