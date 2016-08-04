<?php

class RevisionModuleEditableState extends RevisionState {

    protected function _init() {
        $this->stateName = "Доступна до редагування";
    }

    public function sendForApproval($user) {
        parent::_sendForApproval($user);
    }

    public function cancelledAuthor($user) {
        parent::_cancelledAuthor($user);
    }
}