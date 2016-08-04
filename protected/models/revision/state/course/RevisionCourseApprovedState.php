<?php

class RevisionCourseApprovedState extends RevisionState {

    protected function _init() {
        $this->stateName = "Затверджена";
    }

    public function released($user) {
        $transaction = Yii::app()->db->beginTransaction();

        try {
            $this->revisionUnit->saveCoursePropertiesToRegularDB();
            $this->revisionUnit->deleteCourseModulesFromRegularDB();

            /*
             * Костыль
             */
            $this->revisionUnit->cancelReleasedCourseInTree($user);

            foreach ($this->revisionUnit->courseModules as $key=>$courseModule){
                $courseModule->saveCourseModuleToRegularDB();
            }
            
            parent::_released($user);

            $transaction->commit();
        } catch (Exception $e) {
            $transaction->rollback();
            throw $e;
        }

        return true;
    }
    
}