<?php

class RevisionLectureSendForApprovalState extends RevisionState {

    protected function _init() {
    }

    public function editable($user) {
        parent::_editable($user);
    }
    
    public function rejected($user) {
        parent::_rejected($user);
    }

    public function approved($user) {
        parent::_approved($user);
    }

}