<?php

class AccountantController extends TeacherCabinetController {
    public function hasRole() {
        return Yii::app()->user->model->isAccountant();
    }

    public function actionIndex($id = 0) {
        $this->renderPartial('/_accountant/_dashboard', array(), false, true);
    }

    public function actionUsersDocuments($organization) {
        $this->renderPartial('/_accountant/documents/index', array('organization'=>$organization), false, true);
    }

    public function actionGetDocumentsList()
    {
        Yii::app()->user->model->hasAccessToGlobalRoleLists($_GET['organization']);
        $requestParams = $_GET;
        $ngTable = new NgTableAdapter('UserDocuments', $requestParams);
        if ($_GET['organization']){
            $criteria = new CDbCriteria();
            $criteria->join = 'left join user_student us on us.id_user=t.id_user';
            $criteria->addCondition('us.id_organization=' . Yii::app()->user->model->getCurrentOrganization()->id.' 
            and us.end_date IS NULL and t.actual='.UserDocuments::ACTUAL);
            $ngTable->mergeCriteriaWith($criteria);
        }
        $result = $ngTable->getData();
        echo json_encode($result);
    }

    public function actionCreateDocumentsFolder() {
        if (!file_exists(Yii::app()->basePath . "/../files/documents")) {
            mkdir(Yii::app()->basePath . "/../files/documents");
        }
    }

    public function actionOrganizationCoursesAndModules() {
        $organization = Yii::app()->user->model->getCurrentOrganization();
        $statusCode = 200;

        $body = array_map(function($item) {
            $type = $item instanceof Course ? 'course' : 'module';
            return array_merge($item->toArray(), ['type' => $type]);
        }, $organization->getCoursesAndModulesWithCorporateEntity());

        $this->renderPartial('//ajax/json', ['body' => json_encode($body), 'statusCode' => $statusCode]);
    }

    public function actionGetDocument($id){

        $document = UserDocuments::model()->with(['idUser','documentsFiles'])->find('documentsFiles.id=:documentId',
            ['documentId'=>$id]);
        if ($document){
            $file = "/files/documents/{$document->idUser->id}/{$document->type}/{$document->documentsFiles[0]->file_name}";
            if (file_exists($_SERVER['DOCUMENT_ROOT'].$file)){
                return   Yii::app()->request->xSendFile($file,[
                    'forceDownload'=>true,
                    'xHeader'=>'X-Accel-Redirect',
                    'terminate'=>false
                ]);
            }
            else{
                throw new CHttpException(404,'Документ не знайдено');
            }

        }
        else {
            throw new CHttpException(404,'Документ не знайдено');
        }
    }

    public function actionOfflineGroups()
    {
        $this->renderPartial('/_accountant/students/offlineGroupsTable', array(), false, true);
    }

    public function actionOfflineGroup($id)
    {
        Yii::app()->user->model->hasAccessToOrganizationModel(OfflineGroups::model()->findByPk($id));
        $this->renderPartial('/_accountant/students/offlineGroup', array(), false, true);
    }
}