<?php

class RevisionLectureReadyForReleaseState extends RevisionState {

    protected function _init() {
        $this->stateName = "Готова до релізу";
    }

    public function approved($user) {
        $this->revisionUnit->properties->proposed_to_release_date = new CDbExpression('NULL');
        $this->revisionUnit->properties->id_user_proposed_to_release = null;
        $this->revisionUnit->properties->saveCheck();
    }
    
    public function released($user) {
        if (empty($this->revisionUnit->checkConflicts())) {
            $this->revisionUnit->cancelReleasedInTree($user);

            $this->revisionUnit->properties->release_date = new CDbExpression('NOW()');
            $this->revisionUnit->properties->id_user_released = $user->getId();
            $this->revisionUnit->properties->saveCheck();

            return true;
        } else {
            //todo inform user
        }
    }
    
}