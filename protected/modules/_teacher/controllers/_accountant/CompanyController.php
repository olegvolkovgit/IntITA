<?php

class CompanyController extends TeacherCabinetController {
    public function hasRole() {
        return Yii::app()->user->model->isAccountant();
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

    /**
     * curl -v -XPOST 'http://intita.project/_teacher/_accountant/company/saveRepresentative' -H 'Cookie: XDEBUG_SESSION=PHPSTORM; PHPSESSID=vmsgnp4f0d7h1ju1s95jrldvrr;' --data 'representativeId=2&companyId=2&full_name=%D0%AF%D0%BD%D1%83%D1%81+%D0%9F%D0%BE%D0%BB%D1%83%D1%8D%D0%BA%D1%82%D0%BE%D0%B2%D0%B8%D1%87+%D0%9D%D0%B5%D0%B2%D1%81%D1%82%D1%80%D1%83%D0%B5%D0%B2&full_name_accusative=%D0%AF%D0%BD%D1%83%D1%81+%D0%9F%D0%BE%D0%BB%D1%83%D1%8D%D0%BA%D1%82%D0%BE%D0%B2%D0%B8%D1%87+%D0%9D%D0%B5%D0%B2%D1%81%D1%82%D1%80%D1%83%D0%B5%D0%B2&full_name_short=%D0%AF%D0%BD%D1%83%D1%81+%D0%9F%D0%BE%D0%BB%D1%83%D1%8D%D0%BA%D1%82%D0%BE%D0%B2%D0%B8%D1%87+%D0%9D%D0%B5%D0%B2%D1%81%D1%82%D1%80%D1%83%D0%B5%D0%B2&representative_order=1&position=%D0%94%D0%B8%D1%80%D0%B5%D0%BA%D1%82%D0%BE%D1%80&position_accusative=%D0%94%D0%B8%D1%80%D0%B5%D0%BA%D1%82%D0%BE%D1%80&credentialsFrom=2017-04-11+21%3A05%3A23&credentialsTo=9999-12-31+23%3A59%3A59'
     */
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
            } else {
                $statusCode = 204;
            }
            $body = ['message' => 'OK'];
        } catch (Exception $exeption) {
            $statusCode = 400;
            $body = ['error' => $exeption->getMessage()];
        }
        $this->renderPartial('//ajax/json', ['body' => json_encode($body), 'statusCode' => $statusCode]);

    }
}