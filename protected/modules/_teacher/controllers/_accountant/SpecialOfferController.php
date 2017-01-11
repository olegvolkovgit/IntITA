<?php

class SpecialOfferController extends TeacherCabinetController {

    public function hasRole() {
        return Yii::app()->user->model->isAccountant() || Yii::app()->user->model->isAdmin();
    }

    public function actionIndex() {
        $this->renderPartial('/_accountant/specialOffer/index', null, false, true);
    }
//    todo I suppose this method is not used anymore
//    public function actionCreate() {
//        $result = ['result' => 'success'];
//        $offer = null;
//        $specialOfferFactory = new SpecialOfferFactory($_POST);
//        try {
//            $offer = $specialOfferFactory->createSpecialOffer();
//        } catch (Exception $e) {
//            $result = ['result' => 'fail'];
//        }
//
//        if (Yii::app()->request->isAjaxRequest) {
//            echo $result;
//        } else {
//            return $result;
//        }
//    }

    public function actionGetUserOffersNgTable() {
        $ngTableAdapter = new NgTableAdapter(UserSpecialOffer::model(), $_GET);
        echo json_encode($ngTableAdapter->getData());
    }

    public function actionGetCourseOffersNgTable() {
        $ngTableAdapter = new NgTableAdapter(ServiceSpecialOffer::model(), $_GET, [
            'Course' => 'NgTableCourseShort'
        ]);
        $ngTableAdapter->mergeCriteriaWith(new CDbCriteria([
            'with' => ['service.courseServices', 'service.courseServices.educForm', 'service.courseServices.courseModel'],
            'condition' => 'courseServices.course_id IS NOT NULL']));
        echo json_encode($ngTableAdapter->getData());
    }

    public function actionGetServiceOffersNgTable() {
        $ngTableAdapter = new NgTableAdapter(ServiceSpecialOffer::model(), $_GET);
        echo json_encode($ngTableAdapter->getData());
    }

    public function actionGetModuleOffersNgTable() {
        $ngTableAdapter = new NgTableAdapter(ServiceSpecialOffer::model(), $_GET);
        $ngTableAdapter->mergeCriteriaWith(new CDbCriteria([
            'with' => ['service.moduleServices', 'service.moduleServices.educForm', 'service.moduleServices.moduleModel'],
            'condition' => 'moduleServices.module_id IS NOT NULL']));
        echo json_encode($ngTableAdapter->getData());
    }

    public function actionGetPaymentSchemasNgTable() {
        $ngTableAdapter = new NgTableAdapter(PaymentScheme::model(), $_GET);
        echo json_encode($ngTableAdapter->getData());
    }
}