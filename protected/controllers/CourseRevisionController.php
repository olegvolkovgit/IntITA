<?php

class CourseRevisionController extends Controller {
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
        if (!Yii::app()->user->model->canApprove()) {
            throw new RevisionControllerException(403, 'Доступ заборонено. У тебе недостатньо прав для перегляду ревізій курсу');
        }

        $this->render('index',array(
            'isApprover' => true,
            'userId' => Yii::app()->user->getId(),
        ));
    }

    public function actionCourseRevisions($idCourse) {
        if (!Yii::app()->user->model->canApprove()) {
            throw new RevisionControllerException(403, 'Доступ заборонено. У тебе недостатньо прав для перегляду ревізій модулів курсу');
        }
        $course = Course::model()->findByPk($idCourse);
        $courseRevision = RevisionCourse::model()->exists('id_course='.$idCourse);
        $this->render('courseRevisions', array(
            'course' => $course,
            'isApprover' => Yii::app()->user->model->canApprove(),
            'userId' => Yii::app()->user->getId(),
            'revisionExists' => $courseRevision,
        ));
    }

    public function actionEditCourseRevision() {
        $courseModules = json_decode(Yii::app()->request->getPost('courseModules'),true);
        $idCourse = Yii::app()->request->getPost('id_course_revision');
        $courseRevision = RevisionCourse::model()->findByAttributes(['id_course_revision' => $idCourse]);
        if ($courseRevision->properties->id_user_created!=Yii::app()->user->getId()) {
            throw new RevisionControllerException(403, 'Доступ заборонено. У тебе недостатньо прав для редагування ревізії курсу');
        }
        $courseRevision->editModulesList($courseModules, Yii::app()->user);
    }

    public function actionBuildCourseRevisions() {
        $idCourse = Yii::app()->request->getPost('idCourse');
        $relatedRev  = RevisionCourse::model()->findAllByAttributes(array('id_course'=>$idCourse));
        $relatedTree = RevisionCourse::getCourseTree($idCourse);
        $json = $this->buildCourseTreeJson($relatedRev, $relatedTree);

        echo $json;
    }

    public function actionBuildAllCoursesRevisions() {
        $courseRev = RevisionCourse::model()->findAll();
        $relatedTree = RevisionCourse::getCoursesTree();
        $json = $this->buildCourseTreeJson($courseRev, $relatedTree);

        echo $json;
    }

    private function buildCourseTreeJson($courses, $courseTree) {
        $jsonArray = [];
        foreach ($courses as $course) {
            $node = array();
            $node['text'] = "Ревізія №" . $course->id_course_revision . " " .
                $course->properties->title_ua . ". Статус: <strong>" . $course->state->getName() .'</strong>'.
                ' Створена: '.$course->properties->start_date.' Модифікована: '.$course->properties->update_date;
            $node['selectable'] = false;
            $node['id'] = $course->id_course_revision;
            $node['creatorId'] = $course->properties->id_user_created;
            $statusList=$course->statusList();
            $node=array_merge ($node, $statusList);

            $this->appendNode($jsonArray, $node, $courseTree);
        }
        return json_encode(array_values($jsonArray));
    }

    public function buildCourseTreeJsonMultiselect($courses, $courseTree, $actualIdList) {
        $jsonArray = [];
        foreach ($courses as $course) {
            $node = array();
            $node['text'] = "Ревізія №" . $course->id_course_revision . " " .
                $course->properties->title_ua . ". Статус: <strong>" . $course->state->getName() .'</strong>'.
                ' Створена: '.$course->properties->start_date.' Модифікована: '.$course->properties->update_date;
            $node['selectable'] = false;
            $node['id'] = $course->id_course_revision;
            $node['creatorId'] = $course->properties->id_user_created;
            $statusList=$course->statusList();
            $node=array_merge ($node, $statusList);

            $this->appendNodeMultiselect($jsonArray, $node, $courseTree, $actualIdList);
        }
        return json_encode(array_values($jsonArray));
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

    public function actionCreateRevisionFromCourse() {
        $idCourse = trim(Yii::app()->request->getPost("idCourse"));
        $course=Course::model()->findByPk($idCourse);

        if(RevisionCourse::model()->find('id_course=:id', array(':id'=>$idCourse))){
            echo false;
            return;
        }

        if (!Yii::app()->user->model->isContentManager()) {
            throw new RevisionControllerException(403, Yii::t('error', '0590'));
        }

        $revCourse =  RevisionCourse::createNewRevisionFromCourse($course, Yii::app()->user)->cloneCourse(Yii::app()->user);
        
        echo $revCourse->id_course_revision;
    }

    public function actionCreateCourseRevision($idRevision) {
        $courseRevision = RevisionCourse::model()->findByPk($idRevision);
        if (!Yii::app()->user->model->isContentManager()) {
            throw new RevisionControllerException(403, Yii::t('revision', '0825'));
        }
        $courseRevision = $courseRevision->cloneCourse(Yii::app()->user);
        if($courseRevision){
            $this->redirect(Yii::app()->createUrl('/courseRevision/editCourseRevisionPage',array('idRevision'=>$courseRevision->id_course_revision)));
        }else{
            throw new RevisionControllerException(500, 'CreateModuleRevision error');
        }
    }

    public function actionCancelEditCourseRevisionByEditor () {
        $idRevision = Yii::app()->request->getPost('idRevision');
        $revision = RevisionCourse::model()->findByPk($idRevision);
        if (!$revision->canCancelEdit()) {
            throw new RevisionControllerException(403, Yii::t('revision', '0590'));
        }
        $revision->state->changeTo('cancelledAuthor', Yii::app()->user);
    }

    public function actionRestoreEditCourseRevisionByEditor () {
        $idRevision = Yii::app()->request->getPost('idRevision');
        $revision = RevisionCourse::model()->findByPk($idRevision);
        if (!$revision->canRestoreEdit()) {
            throw new RevisionControllerException(403, Yii::t('revision', '0590'));
        }
        $revision->state->changeTo('editable', Yii::app()->user);
    }

    public function actionSendForApproveCourse() {
        $idRevision = Yii::app()->request->getPost('idRevision');
        $revision = RevisionCourse::model()->findByPk($idRevision);
        if (!$revision->canSendForApproval()) {
            throw new RevisionControllerException(403, Yii::t('error', '0590'));
        }
        $result = $revision->checkConflicts();

        if (empty($result)) {
            $revision->state->changeTo('sendForApproval', Yii::app()->user);
//            $this->sendModuleRevisionRequest($revision);
        } else {
            echo $result;
        }
    }

    public function actionCancelSendForApproveCourse() {
        $idRevision = Yii::app()->request->getPost('idRevision');
        $revision = RevisionCourse::model()->findByPk($idRevision);
        if (!$revision->canCancelSendForApproval()) {
            throw new RevisionControllerException(403, Yii::t('revision', '0590'));
        }
        $revision->state->changeTo('editable', Yii::app()->user);
//        $revisionRequest=MessagesModuleRevisionRequest::model()->findByAttributes(array('id_module_revision'=>$moduleRev->id_module_revision,'cancelled'=>0));
//        if($revisionRequest){
//            $revisionRequest->setDeleted();
//        }
    }

    public function actionRejectCourseRevision() {
        $idRevision = Yii::app()->request->getPost('idRevision');
//        $comment=Yii::app()->request->getPost('comment','');
        $revision = RevisionCourse::model()->findByPk($idRevision);
        if (!$revision->canRejectRevision()) {
            throw new RevisionControllerException(403, Yii::t('revision', '0827'));
        }
        $revision->state->changeTo('rejected', Yii::app()->user);

//        $message = new MessagesRejectModuleRevision();
//        $message->sendModuleRevisionRejectMessage($revision, $comment);
        
//        $revisionRequest=MessagesModuleRevisionRequest::model()->findByAttributes(array('id_module_revision'=>$moduleRev->id_module_revision,'cancelled'=>0, 'user_rejected'=> null));
//        if($revisionRequest){
//            $revisionRequest->setRejected();
//        }
    }

    public function actionApproveCourseRevision() {
        $idRevision = Yii::app()->request->getPost('idRevision');
        $revision = RevisionCourse::model()->findByPk($idRevision);
        if (!$revision->canApprove()) {
            throw new RevisionControllerException(403, Yii::t('revision', '0828'));
        }
        $revision->state->changeTo('approved', Yii::app()->user);
//        $revisionRequest=MessagesModuleRevisionRequest::model()->findByAttributes(array('id_module_revision'=>$moduleRev->id_module_revision,'cancelled'=>0, 'user_approved'=> null));
//        if($revisionRequest){
//            $revisionRequest->setApproved();
//        }
    }

    public function actionCancelCourseRevision () {
        $idRevision = Yii::app()->request->getPost('idRevision');
        $revision = RevisionCourse::model()->findByPk($idRevision);
        if (!$revision->canCancel()) {
            throw new RevisionControllerException(403, Yii::t('revision', '0590'));
        }
        if($revision->deleteCourseModulesFromRegularDB()){
            $revision->state->changeTo('cancel', Yii::app()->user);
        }
    }

    public function actionReadyCourseRevision() {
        $idRevision = Yii::app()->request->getPost('idRevision');
        // confirmation to release (if revision has removed modules) 
        $confirm = Yii::app()->request->getPost('confirmRevision');
        $revision = RevisionCourse::model()->findByPk($idRevision);
        if (!$revision->canReleaseRevision()) {
            throw new RevisionControllerException(403, Yii::t('revision', '0828'));
        }
        if($confirm=='false'){
            $result = $revision->checkCourseRevision();
        }else{
            $result= array();
        }

        if (empty($result)) {
            $revision->state->changeTo('released', Yii::app()->user);
        } else {
            echo $result;
        }
    }

    public function actionPreviewCourseRevision($idRevision) {

        $revision = RevisionCourse::model()->findByPk($idRevision);
        if(!$revision)
            throw new RevisionControllerException(404);
        if (!Yii::app()->user->model->isContentManager()) {
            throw new RevisionControllerException(403, Yii::t('revision', '0825'));
        }

        $this->render("coursePreview", array(
            "courseRevision" => $revision,
        ));
    }

    public function actionEditCourseRevisionPage($idRevision) {
        $revision = RevisionCourse::model()->findByPk($idRevision);
        if(!$revision)
            throw new RevisionControllerException(404);
        if (!$revision->isEditable()) {
            throw new RevisionControllerException(400, Yii::t('revision', '0826'));
        }
        if (!$revision->canEdit()) {
            throw new RevisionControllerException(403, Yii::t('revision', '0825'));
        }

        $this->render("courseView", array(
            "courseRevision" => $revision,
        ));
    }

    public function actionGetCourseRevisionPreviewData()
    {
        $idRevision = Yii::app()->request->getPost('idRevision');

        $courseRevision = RevisionCourse::model()->findByPk($idRevision);

        $modules = [];
        $course = [];
        $data = array('course' => array(),'modules' => array());
        foreach ($courseRevision->courseModules as $key=>$modulesModel) {
            $module = $modulesModel->module;
            $modules[$key]["id"] = $module->module_ID;
            $modules[$key]["module_order"] = $modulesModel->module_order;
            $modules[$key]["title"] = $module->title_ua;
            $modules[$key]["status"] = $module->status?'Готовий':'В розробці';
            $modules[$key]["cancelled"] = $module->cancelled?true:false;
        }

        $course['status']=$courseRevision->state->getName();
        $statusList=$courseRevision->statusList();
        $course=array_merge ($course, $statusList);
        $course['view']= $courseRevision->isReleased()?
            Yii::app()->createUrl("course/index", array("id" => $courseRevision->id_course)):null;
        $data['course']=$course;
        $data['modules']=$modules;
        echo CJSON::encode($data);
    }

    // action editProperties for editable.EditableField widget
    public function actionXEditableEditProperties() {
        $id = Yii::app()->request->getPost('pk');
        $attr = Yii::app()->request->getPost('name');
        $input = Yii::app()->request->getPost('value');
        $courseRevision = RevisionCourseProperties::model()->findByPk($id)->revision;
        if (!$courseRevision || !$courseRevision->canEdit()) {
            throw new RevisionControllerException(403, Yii::t('error', '0590'));
        }

        $params[$attr] = $input;
        $courseRevision->editProperties($params, Yii::app()->user);
    }

    public function actionGetModules() {
        $idCourse = Yii::app()->request->getPost('idCourse');
        $categories = Yii::app()->request->getPost('categories');

        $rc = new RevisionCommon();
        $modulesData = $rc->getAllModules($categories);
        $modulesList = ['current' => ['ready_module' => [],'develop_module' => []],
            'foreign' => ['ready_module' => [],'develop_module' => []]];

        foreach ($modulesData as $key=>$status) {
            foreach ($status as $modulesData) {
                $section = CourseModules::model()->exists('id_module='.$modulesData['module_ID'].' and id_course='.$idCourse) ? 'current' : 'foreign';
                array_push($modulesList[$section][$key], [
                    'id' => $modulesData['module_ID'],
                    'title' => $modulesData['title_ua'],
                    'link' => Yii::app()->createUrl("module/index", array("idModule" => $modulesData['module_ID']))
                ]);
            }
        }

        echo CJSON::encode($modulesList);
    }

    public function actionBuildCourseRevisionTree() {
        $idCourse = Yii::app()->request->getPost('idCourse');
        $status = Yii::app()->request->getPost('status');
        $idAuthor = Yii::app()->request->getPost('idAuthor');
        $actualIdList=RevisionCourse::getFilteredIdRevisions($status,null,$idAuthor);

        $relatedRev  = RevisionCourse::model()->findAllByAttributes(array('id_course'=>$idCourse));
        $relatedTree = RevisionCourse::getCourseTree($idCourse);
        $json = $this->buildCourseTreeJsonMultiselect($relatedRev, $relatedTree, $actualIdList);

        echo $json;
    }

    public function actionBuildAllCoursesTree() {
        $status = Yii::app()->request->getPost('status');
        $idAuthor = Yii::app()->request->getPost('idAuthor');
        $actualIdList=RevisionCourse::getFilteredIdRevisions($status,null,$idAuthor);

        $relatedRev  = RevisionCourse::model()->findAll();
        $relatedTree = RevisionCourse::getCoursesTree();
        $json = $this->buildCourseTreeJsonMultiselect($relatedRev, $relatedTree, $actualIdList);

        echo $json;
    }

    public function actionCheckCourseRevision() {
        $idRevision = Yii::app()->request->getPost('idRevision');
        $revisionCourse=RevisionCourse::model()->findByPk($idRevision);
        $result = $revisionCourse->checkConflicts();
       
        if (empty($result)) {
            echo "Конфліктів не виявлено!";
            return;
        } else {
            echo $result;
            return;
        }
    }

    public function actionUpdateCourseRevisionImage($id)
    {
        $revisionProperties = RevisionCourseProperties::model()->findByPk($id);
        if (isset($_POST['RevisionCourseProperties'])) {
            $imageName = $_FILES['RevisionCourseProperties']['name']['course_img'];
            $tmpName = $_FILES['RevisionCourseProperties']['tmp_name']['course_img'];
            if (!empty($imageName)) {
                if ($revisionProperties->validate()) {
                    $revisionProperties->updateRevisionCourseLogo($imageName,$tmpName,$id);
                    $this->redirect(Yii::app()->request->urlReferrer);
                }else {
                    $this->redirect(Yii::app()->request->urlReferrer);
                }
            } else {
                $this->redirect(Yii::app()->request->urlReferrer);
            }
        }

    }

    // get course by revision
    public function actionGetCourseByRevision() {
        $idRevision = Yii::app()->request->getPost('idRevision');
        $courseRev= RevisionCourse::model()->findByPk($idRevision);
        echo $courseRev->id_course;
    }

    //get data for send letter to author of module revision
//    public function actionGetDataForModuleRevisionMail()
//    {
//        $idRevision = Yii::app()->request->getPost('idRevision');
//        $moduleRevision = RevisionModule::model()->findByPk($idRevision);
//
//        if (!RevisionModule::canCreateModuleRevisions($moduleRevision->id_module)) {
//            throw new RevisionControllerException(403, Yii::t('error', '0590'));
//        }
//
//        $data = [];
//        $data['authorName'] =StudentReg::getUserNamePayment($moduleRevision->properties->id_user_created);
//        $data['authorId'] =$moduleRevision->properties->id_user_created;
//        $data['theme'] = "Ревізія №" . $moduleRevision->id_module_revision . " " . $moduleRevision->properties->title_ua;
//        $data["link"]=Yii::app()->createUrl('/moduleRevision/previewModuleRevision',array('idRevision'=>$moduleRevision->id_module_revision));
//
//        echo CJSON::encode($data);
//    }

    public function actionCourseRevisionsAuthors() {
        if(Yii::app()->request->getPost('idCourse')){
            echo json_encode(RevisionCourse::getCourseRevisionsAuthors(Yii::app()->request->getPost('idModule')));
            die;
        }else{
            echo json_encode(RevisionCourse::getCourseRevisionsAuthors());
            die;
        }
    }

    private function sendCourseRevisionRequest(RevisionCourse $revision){
//        if($revision){
//            $message = new MessagesModuleRevisionRequest();
//            if($message->isRequestOpen(array($revision))) {
//                echo "Такий запит вже надіслано. Ви не можете надіслати запит на затвердження ревізії модуля двічі.";
//            } else {
//                $transaction = Yii::app()->db->beginTransaction();
//                try {
//                    $message->build($revision, Yii::app()->user->model->registrationData);
//                    $message->create();
//                    $sender = new MailTransport();
//
//                    $message->send($sender);
//                    $transaction->commit();
//                    echo "Запит на затвердження ревізії модуля успішно відправлено. Зачекайте, поки адміністратор сайта підтвердить запит.";
//                } catch (Exception $e) {
//                    $transaction->rollback();
//                    throw new \application\components\Exceptions\IntItaException(500, "Запит на затвердження ревізії модуля не вдалося надіслати.");
//                }
//            }
//        } else {
//            throw new \application\components\Exceptions\IntItaException(400);
//        }
    }
}