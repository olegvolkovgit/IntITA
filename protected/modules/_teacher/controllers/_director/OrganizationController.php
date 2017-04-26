<?php

class OrganizationController extends TeacherCabinetController {
    public function hasRole() {
        return Yii::app()->user->model->isDirector();
    }

    public function actionIndex($id = 0) {
        $this->renderPartial('/_director/organization/index', array(), false, true);
    }

    public function actionGetOrganizationsList() {
        $requestParams = $_GET;
        $ngTable = new NgTableAdapter('Organization', $requestParams);
        $result = $ngTable->getData();
        echo json_encode($result);
    }

    public function actionCreateOrganizationForm() {
        $this->renderPartial('/_director/organization/organizationForm', array('scenario' => 'new'), false, true);
    }

    public function actionUpdateOrganizationForm() {
        $this->renderPartial('/_director/organization/organizationForm', array('scenario' => 'update'), false, true);
    }

    public function actionCreateOrganization() {
        $result = ['message' => 'OK'];
        $statusCode = 201;
        try {
            $params = array_filter($_POST);
            $organization = new Organization();
            $organization->setAttributes($params);
            $organization->save();

            if (count($organization->getErrors())) {
                throw new Exception(json_encode($organization->getErrors()));
            }

        } catch (Exception $error) {
            $statusCode = 500;
            $result = ['message' => 'error', 'reason' => $error->getMessage()];
        }
        $this->renderPartial('//ajax/json', ['statusCode' => $statusCode, 'body' => json_encode($result)]);
    }

    public function actionUpdateOrganization() {
        $result = ['message' => 'OK'];
        $statusCode = 201;
        try {
            $params = array_filter($_POST);
            $organization = Organization::model()->findByPk($params['id']);
            $organization->setAttributes($params);
            $organization->save();

            if (count($organization->getErrors())) {
                throw new Exception(json_encode($organization->getErrors()));
            }

        } catch (Exception $error) {
            $statusCode = 500;
            $result = ['message' => 'error', 'reason' => $error->getMessage()];
        }
        $this->renderPartial('//ajax/json', ['statusCode' => $statusCode, 'body' => json_encode($result)]);
    }

    public function actionGetOrganization($id) {
        $result = array();
        $result['data'] = Organization::model()->findByPk($id);
        echo CJSON::encode($result);
    }
}