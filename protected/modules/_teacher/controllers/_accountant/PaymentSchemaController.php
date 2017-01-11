<?php

class PaymentSchemaController extends TeacherCabinetController
{
    public function hasRole() {
        return Yii::app()->user->model->isAccountant() || Yii::app()->user->model->isAdmin();
    }

    public function actionGetSchemas() {
        echo json_encode(ActiveRecordToJSON::toAssocArray(PaymentScheme::model()->findAll()));
    }

    public function actionCreateSchema () {
        $result = ['message' => 'OK'];
        $statusCode = 201;
        try {
            $params = array_filter($_POST);
            $educationFrom = EducationForm::model()->findByPk($params['educationForm']);

            $service = null;
            $user = null;
            if (key_exists('courseId', $params)) {
                $service = CourseService::model()->getService($params['courseId'], $educationFrom);
            } else if (key_exists('moduleId', $params)) {
                $service = ModuleService::model()->getService($params['moduleId'], $educationFrom);
            }

            if (key_exists('userId', $params)) {
                $user = StudentReg::model()->findByPk($params['userId']);
            }

            $offer = null;
            $soFactory = new SpecialOfferFactory($user, $service);
            $offer = $soFactory->createSpecialOffer($params);
            if ($offer === null) {
                $offer = new PaymentScheme();
                $offer->setAttributes($params);
                $offer->save();

                if (count($offer->getErrors())) {
                    throw new Exception(json_encode($offer->getErrors()));
                }
            }
        } catch (Exception $error) {
            $statusCode = 500;
            $result = ['message' => 'error', 'reason' => $error->getMessage()];
        }
        $this->renderPartial('//ajax/json', ['statusCode' => $statusCode, 'body' => json_encode($result)]);
    }
}