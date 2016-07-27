<?php

class RevisionCourseReleasedState extends RevisionState {

    protected function _init() {
        $this->stateName = "Реліз";
    }

    public function cancel($user) {

        $transaction = null;
        if (Yii::app()->db->getCurrentTransaction() == null) {
            $transaction = Yii::app()->db->beginTransaction();
        }

        try {
            $this->revisionUnit->deleteCourseModulesFromRegularDB();

            parent::_cancel($user);

            if ($transaction) {
                $transaction->commit();
            }
        } catch (Exception $e) {
            if ($transaction) {
                $transaction->rollback();
            }
            throw $e;
        }

        return true;
    }

    public function approved($user) {
        parent::_approved($user);
    }
    
}