<?php

class RevisionLectureReadyForReleaseState extends RevisionState {

    protected function _init() {
    }

    public function approved($user) {
        parent::_approved($user);
    }
    
    public function released($user) {
        if (empty($this->revisionUnit->checkConflicts())) {
            $this->revisionUnit->cancelReleasedInTree($user);

            parent::_released($user);
            return true;
        } else {
            //todo inform user
        }
    }
    
}