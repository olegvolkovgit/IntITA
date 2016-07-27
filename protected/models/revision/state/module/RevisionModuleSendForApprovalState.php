<?php

class RevisionModuleSendForApprovalState extends RevisionState {

    protected function _init() {
        $this->stateName = "Відправлена на затвердження";
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