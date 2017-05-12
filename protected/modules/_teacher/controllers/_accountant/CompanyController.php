<?php

class CompanyController extends TeacherCabinetController {
    public function hasRole() {
        $allowedAuditorsActions = ['index','list','viewCompany','upsert','representatives','servicesList'];
        $action = Yii::app()->controller->action->id;
        return Yii::app()->user->model->isAccountant() ||
            (Yii::app()->user->model->isAuditor() && in_array($action, $allowedAuditorsActions));
    }

    public function actionIndex($id = 0) {
        $this->renderPartial('index', array(), false, true);
    }

    public function actionCitiesByQuery($query) {
        echo AddressCity::citiesByQuery($query);
    }

    /**
     * @deprecated use actionList method instead.
     */
    public function actionGetCompaniesList() {
        $params = $_GET;
        echo CorporateEntity::companiesList($params);
    }

    public function actionRenderAddForm() {
        $this->renderPartial('_addForm', array(), false, true);
    }

    public function actionNewCompany() {
        $model = new CorporateEntity();
        $model->attributes = $_POST;
        $cityLegal = Yii::app()->request->getPost('legal_address_city_code', 0);
        $cityActual = Yii::app()->request->getPost('actual_address_city_code', 0);
        $cityLegalVal = Yii::app()->request->getPost('legal_address_city_value', '');
        $cityActualVal = Yii::app()->request->getPost('actual_address_city_value', '');
        if (!AddressCity::model()->findByPk($cityLegal)) {
            $model->legal_address_city_code = AddressCity::newCity(AddressCountry::model()->findByPk(AddressCountry::UKRAINE), $cityLegalVal, $cityLegalVal, $cityLegalVal)->id;
        }
        if (!AddressCity::model()->findByPk($cityActual)) {
            $model->actual_address_city_code = AddressCity::newCity(AddressCountry::model()->findByPk(AddressCountry::UKRAINE), $cityActualVal, $cityLegalVal, $cityLegalVal)->id;
        }
        if ($model->validate()) {
            $model->save();
            echo "Компанію успішно створено.";
        } else {
            echo "Неправильні дані.";
        }
    }

    public function actionViewCompany($id) {
        $organization = Yii::app()->user->model->getCurrentOrganization();
        $model = CorporateEntity::model()->belongsToOrganization($organization)->findByPk($id);
        $body = [];
        if ($model) {
            $body = json_encode($model->getAttributes());
        }
        $this->renderPartial('//ajax/json', ['body' => $body]);
    }

    public function actionUpsert() {
        $id = Yii::app()->request->getParam('id', null);
        $model = null;
        $body = [];
        $statusCode = 200;

        if (empty($id)) {
            $model = new CorporateEntity();
        } else {
            $model = CorporateEntity::model()->findByPk($id);
        }

        if (!empty($model)) {
            $attributes = $model->collectAttributes($_POST);
            $attributes['id_organization'] = Yii::app()->user->model->getCurrentOrganization()->id;
            $model->setAttributes($attributes);

            if ($model->validate()) {
                try {
                    $model->save(false);
                    $body = ['message' => 'OK'];
                } catch (Exception $error) {
                    $statusCode = 400;
                    $body = ['message' => $error->getMessage()];
                }
            } else {
                $statusCode = 400;
                $body = [
                    'message' => 'Validation error',
                    'validationResult' => $model->getErrors()
                ];
            }
        } else {
            $statusCode = 400;
            $body = ['message' => "Can't find CorporateEntity with id = ${$id}"];
        }

        $this->renderPartial('//ajax/json', ['body' => json_encode($body), 'statusCode' => $statusCode]);
    }

    public function actionCompaniesByQuery($query) {
        if ($query) {
            $users = CorporateEntity::companiesByQuery($query);
            echo $users;
        } else {
            throw new \application\components\Exceptions\IntItaException('400');
        }
    }

    public function actionList() {
        $requestParams = $_GET;
        $organization = Yii::app()->user->model->getCurrentOrganization();
        $ngTable = new NgTableAdapter(CorporateEntity::model()->belongsToOrganization($organization), $requestParams);
        $result = $ngTable->getData();
        $this->renderPartial('//ajax/json', ['body' => json_encode($result)]);
    }

    public function actionRepresentatives() {
        $companyId = Yii::app()->request->getParam('companyId', null);
        $representativeId = Yii::app()->request->getParam('representativeId', null);
        $ngTable = new NgTableAdapter(CorporateRepresentative::model());
        if ($companyId) {
            $criteria = new CDbCriteria();
            $criteria->condition = 'corporateEntityRepresentatives.corporate_entity = :companyId';
            $criteria->params = ['companyId' => $companyId];
            $ngTable->mergeCriteriaWith($criteria);
        }
        if ($representativeId) {
            $criteria = new CDbCriteria();
            $criteria->condition = 't.id = :representativeId';
            $criteria->params = ['representativeId' => $representativeId];
            $ngTable->mergeCriteriaWith($criteria);
        }
        $result = $ngTable->getData();

        $this->renderPartial('//ajax/json', ['body' => json_encode($result)]);
    }

    public function actionSaveRepresentative() {
        $companyId = Yii::app()->request->getParam('companyId', null);
        $representativeId = Yii::app()->request->getParam('representativeId', null);
        $body = [];
        $statusCode = 200;
        try {
            $criteria = new CDbCriteria([
                'condition' => 't.id = :representativeId AND corporateEntity.id = :companyId',
                'params' => ['representativeId' => $representativeId, 'companyId' => $companyId],
                'with' => ['corporateEntity', 'corporateEntityRepresentatives']
            ]);
            $model = CorporateRepresentative::model()->find($criteria);
            if ($model) {
                $model->updateData($_POST);
                $body = ['message' => 'OK'];
            } else {
                $representative = CorporateRepresentative::model()->createRepresentative($_POST);
                if (!empty($representative)) {
                    $statusCode = 201;
                    $body = ['message' => 'OK', 'id' => $representative->id];
                } else {
                    $statusCode = 400;
                }
            }
        } catch (Exception $exception) {
            $statusCode = 400;
            $body = ['error' => $exception->getMessage()];
        }
        $this->renderPartial('//ajax/json', ['body' => json_encode($body), 'statusCode' => $statusCode]);

    }

    public function actionServicesList() {
        $companyId = Yii::app()->request->getParam('companyId', null);
        $body = [];
        if ($companyId) {
            $criteria = new CDbCriteria([
                'condition' => 'corporateEntity.id = :companyId',
                'params' => ['companyId' => $companyId],
                'with' => ['corporateEntity',]
            ]);
            $ngTable = new NgTableAdapter(Service::model());
            $ngTable->mergeCriteriaWith($criteria);
            $body = $ngTable->getData();
        }
        $statusCode = 200;
        $this->renderPartial('//ajax/json', ['body' => json_encode($body), 'statusCode' => $statusCode]);
    }

    public function actionBindService() {
        $companyId = filter_var(Yii::app()->request->getParam('companyId', null), FILTER_SANITIZE_NUMBER_INT);
        $id = filter_var(Yii::app()->request->getParam('id', null), FILTER_SANITIZE_NUMBER_INT);
        $type = filter_var(Yii::app()->request->getParam('type', null), FILTER_SANITIZE_STRING);
        $educationForm = filter_var(Yii::app()->request->getParam('educationForm', null), FILTER_SANITIZE_NUMBER_INT);
        $statusCode = 200;

        if ($companyId && $id && $type && $educationForm) {
            $organization = Yii::app()->user->model->getCurrentOrganization();
            $criteria = new CDbCriteria([
                'condition' => 'id = :companyId AND id_organization = :organizationId',
                'params' => ['companyId' => $companyId, 'organizationId' => $organization->id]
            ]);
            $company = CorporateEntity::model()->find($criteria);

            if ($type === 'module') {
                $modelClass = Module::model();
            } else {
                $modelClass = Course::model();
            }
            $model = $modelClass->findByPk($id);
            $educationFormModel = EducationForm::model()->findByPk($educationForm);

            if ($company && $model && $educationFormModel) {
                $company->bindServiceByEducationUnit($model, $educationFormModel);
                $body = $company->toArray();
            } else {
                $statusCode = 400;
            }
        } else {
            $statusCode = 400;
        }
        $this->renderPartial('//ajax/json', ['body' => json_encode($body), 'statusCode' => $statusCode]);
    }

    public function actionUnBindService() {
        $companyId = filter_var(Yii::app()->request->getParam('companyId', null), FILTER_SANITIZE_NUMBER_INT);
        $serviceId = filter_var(Yii::app()->request->getParam('serviceId', null), FILTER_SANITIZE_NUMBER_INT);
        $statusCode = 200;
        $body = [];
        if ($companyId && $serviceId) {
            $organization = Yii::app()->user->model->getCurrentOrganization();
            $criteria = new CDbCriteria([
                'condition' => 'id = :companyId AND id_organization = :organizationId',
                'params' => ['companyId' => $companyId, 'organizationId' => $organization->id]
            ]);
            $company = CorporateEntity::model()->find($criteria);

            $service = Service::model()->findByPk($serviceId);
            if ($company && $service) {
                $company->unBindService($service);
            } else {
                $statusCode = 400;
            }
        } else {
            $statusCode = 400;
        }
        $this->renderPartial('//ajax/json', ['body' => json_encode($body, JSON_FORCE_OBJECT), 'statusCode' => $statusCode]);
    }

}