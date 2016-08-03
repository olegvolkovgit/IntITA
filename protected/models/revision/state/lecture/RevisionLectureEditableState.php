<?php

class RevisionLectureEditableState extends RevisionState {

    protected function _init() {
    }

    public function sendForApproval($user) {

        if (empty($this->revisionUnit->checkConflicts())) {
            parent::_sendForApproval($user);
        }
    }

    public function cancelledAuthor($user) {
        parent::_cancelledAuthor($user);
    }
}