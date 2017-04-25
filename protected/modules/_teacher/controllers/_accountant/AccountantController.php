<?php

class AccountantController extends TeacherCabinetController {
    public function hasRole() {
        return Yii::app()->user->model->isAccountant();
    }

    public function actionIndex($id = 0) {
        $this->renderPartial('/_accountant/_dashboard', array(), false, true);
    }

    public function actionUsersDocuments() {
        $this->renderPartial('/_accountant/documents/index', array(), false, true);
    }

    public function actionGetDocumentsList() {
        $requestParams = $_GET;
        $ngTable = new NgTableAdapter('UserDocuments', $requestParams);
        $result = $ngTable->getData();
        echo json_encode($result);
    }

    public function actionChangeDocumentStatus() {
        $id = Yii::app()->request->getPost('id');
        $model = UserDocuments::model()->findByPk($id);
        $model->changeCheckDocuments();
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
}