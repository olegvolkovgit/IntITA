<?php

class SpecialOfferController extends TeacherCabinetController {

    public function hasRole() {
        return Yii::app()->user->model->isAccountant();
    }

    public function actionIndex() {
        $this->renderPartial('/_accountant/specialOffer/index', null, false, true);
    }

    public function actionCreate() {
        $result = ['result' => 'success'];
        $offer = null;
        $specialOfferFactory = new SpecialOfferFactory($_POST);
        try {
            $offer = $specialOfferFactory->createSpecialOffer();
        } catch (Exception $e) {
            $result = ['result' => 'fail'];
        }

        if (Yii::app()->request->isAjaxRequest) {
            echo $result;
        } else {
            return $result;
        }
    }

    public function actionGetUserOffersNgTable() {
        $ngTableAdapter = new NgTableAdapter(UserSpecialOffer::model(), $_GET);
        echo json_encode($ngTableAdapter->getData());
    }

    public function actionGetCourseOffersNgTable() {
        $ngTableAdapter = new NgTableAdapter(CourseSpecialOffer::model(), $_GET);
        echo json_encode($ngTableAdapter->getData());
    }

    public function actionGetModuleOffersNgTable() {
        $ngTableAdapter = new NgTableAdapter(ModuleSpecialOffer::model(), $_GET);
        echo json_encode($ngTableAdapter->getData());
    }

    public function actionGetPaymentSchemasNgTable() {
        $ngTableAdapter = new NgTableAdapter(PaymentScheme::model(), $_GET);
        echo json_encode($ngTableAdapter->getData());
    }
}