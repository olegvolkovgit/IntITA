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
        $this->renderPartial('//ajax/json', ['body' => json_encode($model->getAttributes())]);
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
}