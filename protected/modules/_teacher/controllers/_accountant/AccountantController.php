<?php

class AccountantController extends TeacherCabinetController
{
    public function hasRole(){
        return Yii::app()->user->model->isAccountant();
    }

    public function actionIndex($id=0)
    {
        $this->renderPartial('/_accountant/_dashboard', array(), false, true);
    }

    public function actionUsersDocuments()
    {
        $this->renderPartial('/_accountant/documents/index', array(), false, true);
    }
    
    public function actionGetDocumentsList()
    {
        $requestParams = $_GET;
        $ngTable = new NgTableAdapter('UserDocuments', $requestParams);
        $result = $ngTable->getData();
        echo json_encode($result);
    }

    public function actionChangeDocumentStatus()
    {
        $id = Yii::app()->request->getPost('id');
        $model = UserDocuments::model()->findByPk($id);
        $model->changeCheckDocuments();
    }

    public function actionCreateDocumentsFolder()
    {
        if (!file_exists(Yii::app()->basePath . "/../files/documents")) {
            mkdir(Yii::app()->basePath . "/../files/documents");
        }
    }
}