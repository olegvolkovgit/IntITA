<?php

class AgreementsController extends TeacherCabinetController {
    public function hasRole() {
        $allowedTrainerActions = ['renderUserAgreements','getUserAgreementsList','agreement','getAgreement'];
        $allowedAuditorsActions = ['index','getAgreementsList','agreement','getAgreement'];
        $action = Yii::app()->controller->action->id;
        return Yii::app()->user->model->isAccountant() ||
            (Yii::app()->user->model->isTrainer() && in_array($action, $allowedTrainerActions)) ||
            (Yii::app()->user->model->isAuditor() && in_array($action, $allowedAuditorsActions));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return UserAgreements the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = UserAgreements::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param UserAgreements $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'user-agreements-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /**
     * Lists all models.
     * @param $organization
     */
    public function actionIndex($organization) {
        $this->renderPartial('index', array('organization'=>$organization));
    }

    public function actionGetAgreementsList() {
        $requestParams = $_GET;
        $organization = Yii::app()->user->model->getCurrentOrganization();
        $ngTable = new NgTableAdapter(UserAgreements::model()->belongsToOrganization($organization), $requestParams);
        $result = $ngTable->getData();
        echo json_encode($result);
    }

    public function actionGetUserAgreementsList() {
//        $requestParams = $_GET;
//        $organization = Yii::app()->user->model->getCurrentOrganization();
//        $ngTable = new NgTableAdapter(UserAgreements::model()->belongsToOrganization($organization), $requestParams);
//        $result = $ngTable->getData();
//        echo json_encode($result);

//        todo
        $requestParams = $_GET;
        $ngTable = new NgTableAdapter('UserAgreements', $requestParams);
        $criteria =  new CDbCriteria();
        $criteria->alias = 't';
        $criteria->join = 'left join acc_course_service cs on cs.service_id=t.service_id';
        $criteria->join .= ' left join course c on c.course_ID=cs.course_id';
        $criteria->join .= ' left join acc_module_service ms on ms.service_id=t.service_id';
        $criteria->join .= ' left join module m on m.module_ID=ms.module_id';
        $criteria->addCondition('t.user_id='.$requestParams['user'].' and (m.id_organization='.Yii::app()->user->model->getCurrentOrganization()->id.' 
        or c.id_organization='.Yii::app()->user->model->getCurrentOrganization()->id.')');
        $ngTable->mergeCriteriaWith($criteria);
        $result = $ngTable->getData();
        echo json_encode($result);
    }
    
    public function actionGetTypeahead($query) {
        $agreements = new Agreements();
        $models = $agreements->getTypeahead($query);
        echo json_encode($models);
    }

    public function actionConfirm($id = 0) {
        $model = UserAgreements::model()->findByPk($id);
        $response = [];
        if ($model && $model->confirm(Yii::app()->user)) {
            $response['result'] = 'success';
        } else {
            $response['result'] = 'fail';
        }

        echo json_encode($response);
    }

    public function actionCancel($id = 0) {
        $model = UserAgreements::model()->findByPk($id);
        $response = [];
        if ($model && $model->cancel(Yii::app()->user)) {
            $response['result'] = 'success';
        } else {
            $response['result'] = 'fail';
        }
        echo json_encode($response);
    }

    public function actionAgreement($id) {
        if(Yii::app()->user->model->isTrainer()){
            $agreement=UserAgreements::model()->findByPk($id);
            Yii::app()->user->model->hasAccessToOrganizationModel(
                TrainerStudent::model()->findByAttributes(
                    array(
                        'student'=>$agreement->user_id,
                        'trainer'=>Yii::app()->user->getId(),
                        'id_organization'=>Yii::app()->user->model->getCurrentOrganization()->id,
                        'end_time'=>null,
                    )
                ));
            Yii::app()->user->model->hasAccessToOrganizationModel($agreement->getAgreementContentModel());
        }
        $this->renderPartial('agreement');
    }

    public function actionGetAgreement($id) {
        $agreements = new Agreements();
        $agreements->getUserAgreement($id);
        echo json_encode($agreements->getUserAgreement($id), JSON_FORCE_OBJECT);
    }

    public function actionRenderUserAgreements($idUser) {
        Yii::app()->user->model->hasAccessToOrganizationModel(
            TrainerStudent::model()->findByAttributes(
                array(
                    'student'=>$idUser,
                    'trainer'=>Yii::app()->user->getId(),
                    'id_organization'=>Yii::app()->user->model->getCurrentOrganization()->id,
                    'end_time'=>null,
                )
            ));
        $this->renderPartial('userAgreements');
    }
}