<?php

class RevisionModuleApprovedState extends RevisionState {

    protected function _init() {
        $this->stateName = "Затверджена";
    }

    public function released($user) {
        $transaction = Yii::app()->db->beginTransaction();

        try {
            $this->revisionUnit->saveModulePropertiesToRegularDB();
            $this->revisionUnit->deleteModuleLecturesFromRegularDB();

            $this->revisionUnit->cancelReleasedModuleInTree($user);
            /*
             * Костыль
             */
            foreach ($this->revisionUnit->moduleLecturesModels as $key=>$moduleLecture){
                $newLecture[$key] = $moduleLecture->lecture->saveModuleLecturesToRegularDB($user);
                if ($moduleLecture->lecture->state->getCode() == RevisionState::ApprovedState) {
                    $moduleLecture->lecture->state->changeTo('readyForRelease', $user);
                }
                if ($moduleLecture->lecture->state->getCode() != RevisionState::ReleasedState) {
                    $moduleLecture->lecture->state->changeTo('released', $user);
                }
            }

            parent::_released($user);

            $transaction->commit();
        } catch (Exception $e) {
            $transaction->rollback();
            throw $e;
        }

        foreach ($this->revisionUnit->moduleLecturesModels as $key=>$moduleLecture){
            $lectureRev=$moduleLecture->lecture;
            $lectureRev->createDirectory($newLecture[$key]);
            $lectureRev->createTemplates($newLecture[$key]);
        }

        Module::model()->updateByPk($this->revisionUnit->id_module, array('id_module_revision'=>$this->revisionUnit->id_module_revision));

        return true;
    }

}