<?php

class RevisionModuleCancelledAuthorState extends RevisionState {

    protected function _init() {
        $this->stateName = "Скасована автором";
    }
    
    public function editable($user) {
        parent::_editable($user);
    }

}