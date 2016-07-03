<?php

class RevisionModuleCancelledAuthorState extends RevisionState {

    protected function _init() {
        $this->stateName = "Скасована автором";
    }
    
    public function editable($user) {
        $this->revisionUnit->properties->cancel_edit_date = new CDbExpression('NULL');
        $this->revisionUnit->properties->id_user_cancelled_edit = null;
        $this->revisionUnit->properties->saveCheck();
    }

}