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
            throw new RevisionLectureException(500, $this->revisionUnit->checkConflicts()[0]);
        }
    }
    
}