<?php

class RevisionController extends Controller {

    public $layout = 'lessonlayout';

    public function actionIndex()
    {
        if (!$this->isUserApprover(Yii::app()->user)) {
            throw new RevisionControllerException(403, 'Access denied.');
        }

        $lectureRev = RevisionLecture::model()->with("properties")->findAll();
        $lecturesTree = RevisionLecture::getLecturesTree();

        $json = $this->buildLectureTreeJson($lectureRev, $lecturesTree);

        $this->render('index', array(
            'json' => $json
        ));
    }

    public function actionCreateNewLecture(){

        $idModule = Yii::app()->request->getPost("idModule");
        $order = Yii::app()->request->getPost("order");
        $titleUa = Yii::app()->request->getPost("titleUa");
        $titleEn = Yii::app()->request->getPost("titleEn");
        $titleRu = Yii::app()->request->getPost("titleRu");

        if (!$this->isUserTeacher(Yii::app()->user, $idModule)) {
            throw new RevisionControllerException(403, 'Access denied.');
        }

        $revLecture = RevisionLecture::createNewLecture($idModule, $order, $titleUa, $titleEn, $titleRu, Yii::app()->user);

        $this->redirect(array('revision/editlecturerevision', 'idRevision' => $revLecture->id_revision));
    }

    public function actionEditLectureRevision($idRevision) {

        $lectureRevision = RevisionLecture::model()->with("properties", "lecturePages")->findByPk($idRevision);

        if (!$this->isUserTeacher(Yii::app()->user, $lectureRevision->id_module) && !$this->isUserApprover(Yii::app()->user, $lectureRevision->id_module)) {
            throw new RevisionControllerException(403, 'Access denied.');
        }

        if (!$lectureRevision->isEditable()) {
            throw new RevisionControllerException(400, 'This lecture cannot be modified.');
        }

        $this->render("lectureview", array(
                        "lectureRevision" => $lectureRevision,
                        "pages" => $lectureRevision->lecturePages));
    }

    public function actionAddPage(){

        $idRevision = Yii::app()->request->getPost("idRevision");

        $lectureRevision = RevisionLecture::model()->with('properties')->findByPk($idRevision);

        if (!$this->isUserEditor(Yii::app()->user, $lectureRevision)) {
            throw new RevisionControllerException(403, 'Access denied.');
        }

        $newPage = $lectureRevision->addPage(Yii::app()->user);

        $json = json_encode(array(
            "id" => $newPage->id,
            "title" => $newPage->page_title,
            "order" => $newPage->page_order,
        ));

        echo $json;
    }

    public function actionNewPageRevision() {

        $idPage = Yii::app()->request->getPost("idPage");

        $pageRevision = RevisionLecturePage::model()->findByPk($idPage);

        if (!$this->isUserEditor(Yii::app()->user, RevisionLecture::model()->findByPk($pageRevision->id_revision))) {
            throw new RevisionControllerException(403, 'Access denied.');
        }

        $newRevision = $pageRevision->clonePage(Yii::app()->user);
        $this->redirect(Yii::app()->request->urlReferrer);
    }

    public function actionEditPageRevision() {

        $idPage = Yii::app()->request->getPost("idPage");

        $page = RevisionLecturePage::model()->findByPk($idPage);

        if (!$this->isUserEditor(Yii::app()->user, RevisionLecture::model()->findByPk($page->id_revision))) {
            throw new RevisionControllerException(403, 'Access denied.');
        }

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

        if (!$this->isUserEditor(Yii::app()->user, RevisionLecture::model()->findByPk($page->id_revision))) {
            throw new RevisionControllerException(403, 'Access denied.');
        }

        $page->saveVideo($url, Yii::app()->user);

        $this->redirect(Yii::app()->request->urlReferrer);
    }

    public function actionEditPageTitle() {
        $idPage = Yii::app()->request->getPost("idPage");
        $title = Yii::app()->request->getPost("title");
        $page = RevisionLecturePage::model()->findByPk($idPage);

        if (!$this->isUserEditor(Yii::app()->user, RevisionLecture::model()->findByPk($page->id_revision))) {
            throw new RevisionControllerException(403, 'Access denied.');
        }

        $page->setTitle($title, Yii::app()->user);

        $this->redirect(Yii::app()->request->urlReferrer);
    }

    public function actionAddLectureElement() {
        $idPage = Yii::app()->request->getPost('idPage');
        $idType = Yii::app()->request->getPost('idType');
        $html_block = Yii::app()->request->getPost('html_block');

        $page = RevisionLecturePage::model()->findByPk($idPage);

        if (!$this->isUserEditor(Yii::app()->user, RevisionLecture::model()->findByPk($page->id_revision))) {
            throw new RevisionControllerException(403, 'Access denied.');
        }

        $page->addTextBlock($idType, $html_block, Yii::app()->user);

        $this->redirect(Yii::app()->request->urlReferrer);
    }

    public function actionEditLectureElement() {
        $idElement = Yii::app()->request->getPost('idElement');
        $html_block = Yii::app()->request->getPost('html_block');

        $element = RevisionLectureElement::model()->findByPk($idElement);

        $page = RevisionLecturePage::model()->findByPk($element->id_page);
        if (!$this->isUserEditor(Yii::app()->user, RevisionLecture::model()->findByPk($page->id_revision))) {
            throw new RevisionControllerException(403, 'Access denied.');
        }

        $element->html_block = $html_block;

        $element->saveCheck();

        $this->redirect(Yii::app()->request->urlReferrer);
    }

    /**
     * curl -XPOST --data 'idPage=2' 'http://intita.project/revision/UpPage' -b XDEBUG_SESSION=PHPSTORM
     * @throws RevisionControllerException
     */
    public function actionUpPage() {
        $idPage = Yii::app()->request->getPost('idPage');

        $page = RevisionLecturePage::model()->findByPk($idPage);

        if (!$this->isUserEditor(Yii::app()->user, RevisionLecture::model()->findByPk($page->id_revision))) {
            throw new RevisionControllerException(403, 'Access denied.');
        }

        $page->moveUp(Yii::app()->user);
    }

    public function actionDownPage() {
        $idPage = Yii::app()->request->getPost('idPage');

        $page = RevisionLecturePage::model()->findByPk($idPage);

        if (!$this->isUserEditor(Yii::app()->user, RevisionLecture::model()->findByPk($page->id_revision))) {
            throw new RevisionControllerException(403, 'Access denied.');
        }

        $page->moveDown(Yii::app()->user);
    }

    public function actionCheckLecture() {
        $idLecture = Yii::app()->request->getPost('idLecture');

        $lectureRevision = RevisionLecture::model()->with('lecturePages')->findByPk($idLecture);

        if (!$this->isUserEditor(Yii::app()->user, $lectureRevision)) {
            throw new RevisionControllerException(403, 'Access denied.');
        }

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

        if (!$this->isUserEditor(Yii::app()->user, $lectureRev)) {
            throw new RevisionControllerException(403, 'Access denied.');
        }

        $result = $lectureRev->checkConflicts();

        if (empty($result)) {
            $lectureRev->sendForApproval(Yii::app()->user);
        } else {
            echo implode("; ", $result);
        }
    }

    public function actionRejectLectureRevision () {

        if (!$this->isUserApprover(Yii::app()->user)) {
            throw new RevisionControllerException(403, 'Access denied. You have not privileges to reject a lecture');
        }

        $idLecture = Yii::app()->request->getPost('idLecture');
        $lectureRev = RevisionLecture::model()->with("properties", "lecturePages")->findByPk($idLecture);

        $lectureRev->reject(Yii::app()->user);

    }

    public function actionCancelLectureRevision () {
        $idLecture = Yii::app()->request->getPost('idLecture');
        $lectureRev = RevisionLecture::model()->with("properties", "lecturePages")->findByPk($idLecture);

        if (!$this->isUserEditor(Yii::app()->user, $lectureRev)) {
            throw new RevisionControllerException(403, 'Access denied.');
        }
        $lectureRev->cancel(Yii::app()->user);
    }

    /**
     * curl -XPOST --data 'idLecture=126' 'http://intita.project/revision/ApproveLectureRevision' -b XDEBUG_SESSION=PHPSTORM
     * @throws Exception
     * @throws RevisionControllerException
     */
    public function actionApproveLectureRevision () {

        if (!$this->isUserApprover(Yii::app()->user)) {
            throw new RevisionControllerException(403, 'Access denied. You have not privileges to approve a lecture');
        }

        $idLecture = Yii::app()->request->getPost('idLecture');
        $lectureRev = RevisionLecture::model()->with("properties", "lecturePages")->findByPk($idLecture);

        $lectureRev->approve(Yii::app()->user);
    }

    public function actionUpLectureElement() {
        $idPage = Yii::app()->request->getPost('idPage');
        $idElement = Yii::app()->request->getPost('idElement');

        $page = RevisionLecturePage::model()->with('lectureElements')->findByPk($idPage);

        if (!$this->isUserEditor(Yii::app()->user, RevisionLecture::model()->findByPk($page->id_revision))) {
            throw new RevisionControllerException(403, 'Access denied.');
        }

        $page->upElement($idElement, Yii::app()->user);
    }

    public function actionDownLectureElement() {
        $idPage = Yii::app()->request->getPost('idPage');
        $idElement = Yii::app()->request->getPost('idElement');

        $page = RevisionLecturePage::model()->with('lectureElements')->findByPk($idPage);

        if (!$this->isUserEditor(Yii::app()->user, RevisionLecture::model()->findByPk($page->id_revision))) {
            throw new RevisionControllerException(403, 'Access denied.');
        }

        $page->downElement($idElement, Yii::app()->user);
    }

    public function actionDeleteLectureElement() {
        $idPage = Yii::app()->request->getPost('idPage');
        $idElement = Yii::app()->request->getPost('idElement');

        $page = RevisionLecturePage::model()->with('lectureElements')->findByPk($idPage);

        if (!$this->isUserEditor(Yii::app()->user, RevisionLecture::model()->findByPk($page->id_revision))) {
            throw new RevisionControllerException(403, 'Access denied.');
        }

        $page->deleteElement($idElement, Yii::app()->user);
    }

    public function actionEditLecture($idLecture) {

        $lectureRev = RevisionLecture::model()->findByAttributes(array("id_lecture" => $idLecture));
        $lecture = Lecture::model()->findByPk($idLecture);

        if (!$this->isUserTeacher(Yii::app()->user, $lecture->idModule)) {
            throw new RevisionControllerException(403, 'Access denied. You have not privileges to view lecture.');
        }

        if ($lectureRev == null) {
            $lectureRev = RevisionLecture::createNewRevisionFromLecture($lecture, Yii::app()->user);
        }

        $relatedRev = $lectureRev->getRelatedLectures();
        $relatedTree = RevisionLecture::getLecturesTree($lecture->idModule);
        $json = $this->buildLectureTreeJson($relatedRev, $relatedTree);

        $this->render('index', array(
            'json' => $json,
        ));
    }

    public function actionDeleteLecture() {
        $idLecture = Yii::app()->request->getPost('idLecture');
        $idModule = Yii::app()->request->getPost('idModule');
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

        $relatedRev = $lectureRev->getRelatedLectures();
        $relatedTree = RevisionLecture::getLecturesTree($lecture->idModule);
        $json = $this->buildLectureTreeJson($relatedRev, $relatedTree);

        $this->render('index', array(
            'json' => $json,
        ));
    }

    public function actionModuleLecturesRevisions($idModule) {

        $lectureRev = RevisionLecture::model()->findAllByAttributes(array("id_module" => $idModule));
        $relatedTree = RevisionLecture::getLecturesTree($idModule);
        $json = $this->buildLectureTreeJson($lectureRev, $relatedTree);

        $this->render('index', array(
            'json' => $json,
        ));
    }

    public function actionShowRevision($idRevision) {
        $lectureRev = RevisionLecture::model()->with('properties, lecturePages')->findByPk($idRevision);

    }

    /**
     * curl -XPOST --data 'condition=condition&testTitle=testTitle&optionsNum=2&pageId=1&answer1=answer1&is_valid1=1&answer2=answer2&is_valid2=0' 'http://intita.project/revision/addtest'
     */
    public function actionAddTest() {
        $arr = [];
        $arr['condition'] = Yii::app()->request->getPost('condition', '');  //RevisionLectureElement->html_block
        $arr['testTitle'] = Yii::app()->request->getPost('testTitle', '');  //RevisionTest->title
        $arr['optionsNum'] = Yii::app()->request->getPost('optionsNum', 0); //options amount
        $arr['pageId'] = Yii::app()->request->getPost('pageId', 0);         //RevisionLecturePage->id
        $arr['type'] = LectureElement::TEST;                                //RevisionLectureElement->id_type

        $arr['author'] = Yii::app()->user->getId();

        $options = [];
        for ($i = 0; $i < $arr['optionsNum']; $i++){
            $options[$i]["answer"] = Yii::app()->request->getPost("answer".($i+1), '');     //RevisionTestAnswer->answer
            $options[$i]["is_valid"] = Yii::app()->request->getPost("is_valid".($i+1), 0);  //RevisionTestAnswer->is_valid
        }
        $arr['answers'] = $options;
        RevisionQuizFactory::createQuiz($arr);
    }

    /**
     * curl -XPOST --data 'idBlock=492&testTitle=testTitle2&optionsNum=3&PageId=1&answer1=answer3&is_valid1=1&answer2=answer4&is_valid2=0&answer3=answer5' 'http://intita.project/revision/EditTest' -b XDEBUG_SESSION=PHPSTORM
     */
    public function actionEditTest() {
        $arr = [];
        $arr['idBlock'] =  Yii::app()->request->getPost('idBlock', 0);         //RevisionLectureElement->html_block
        $arr['condition'] =  Yii::app()->request->getPost('condition', '');    //RevisionLectureElement->html_block
        $arr['testTitle'] = Yii::app()->request->getPost('testTitle', '');     //RevisionTest->title
        $arr['optionsNum'] = Yii::app()->request->getPost('optionsNum', 0);    //options amount


        $options = [];
        for ($i = 0; $i < $arr['optionsNum']; $i++){
            $options[$i]["answer"] = Yii::app()->request->getPost("answer".($i+1), '');     //RevisionTestAnswer->answer
            $options[$i]["is_valid"] = Yii::app()->request->getPost("is_valid".($i+1), 0);  //RevisionTestAnswer->is_valid
        }

        $arr['answers'] = $options;
        print_r($arr);

        RevisionQuizFactory::editQuiz($arr);
    }

    /**
     * curl -XPOST --data 'idBlock=496' 'http://intita.project/revision/DeleteTest'
     */
    public function actionDeleteTest() {
        $arr = [];
        $idBlock =  Yii::app()->request->getPost('idBlock', 0);         //RevisionLectureElement->id

        RevisionQuizFactory::deleteQuiz($idBlock);
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
    public function actionDeletePage(){
        $idPage = Yii::app()->request->getPost('idPage');
        $page = RevisionLecturePage::model()->findByPk($idPage);
        $page->delete();
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
        $module = Module::model()->with('teacher.user')->findByPk($idModule);

        foreach ($module->teacher as $teacher) {
            if ($teacher->user->id == $user->getId()) {
                return true;
            }
        }
        return false;
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
                    $targetNode=&$targetNode[array_pop($path)];
                }
                else {
                    $targetNode=&$targetNode['nodes'][array_pop($path)];
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
            $node = array ();
            $node['text'] = "Ревізія №" . $lecture->id_revision . " " . $lecture->properties->title_ua . ". Статус: " . $lecture->getStatus();
            $node['selectable'] = false;
            $node['id'] = $lecture->id_revision;

            $this->appendNode($jsonArray, $node, $lectureTree);
        }
        return json_encode(array_values($jsonArray));
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