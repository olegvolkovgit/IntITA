<?php

class RevisionLectureCancelledAuthorState extends RevisionState {

    protected function _init() {
    }
    
    public function editable($user) {
        parent::_editable($user);
    }

}