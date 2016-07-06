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
            foreach ($this->revisionUnit->moduleLecturesModels as $key=>$moduleLecture){
                $newLecture[$key] = $moduleLecture->lecture->saveModuleLecturesToRegularDB($user);
                if ($moduleLecture->lecture->state->getName() == 'Затверджена') {
                    $moduleLecture->lecture->state->changeTo('readyForRelease', $user);
                }
                if ($moduleLecture->lecture->state->getName() != 'Реліз') {
                    $moduleLecture->lecture->state->changeTo('released', $user);
                }
            }
            $this->revisionUnit->cancelReleasedModuleInTree($user);

            $this->revisionUnit->properties->release_date = new CDbExpression('NOW()');
            $this->revisionUnit->properties->id_user_released = $user->getId();
            $this->revisionUnit->properties->saveCheck();

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