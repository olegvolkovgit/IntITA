<?php

class RevisionModuleSendForApprovalState extends RevisionState {

    protected function _init() {
        $this->stateName = "Відправлена на затвердження";
    }

    public function editable($user) {
        $this->revisionUnit->properties->send_approval_date = new CDbExpression('NULL');
        $this->revisionUnit->properties->id_user_sended_approval = null;
        $this->revisionUnit->properties->saveCheck();
    }
    
    public function rejected($user) {
        $this->revisionUnit->properties->reject_date = new CDbExpression('NOW()');
        $this->revisionUnit->properties->id_user_rejected = $user->getId();
        $this->revisionUnit->properties->saveCheck();
    }

    public function approved($user) {
        $this->revisionUnit->properties->approve_date = new CDbExpression('NOW()');
        $this->revisionUnit->properties->id_user_approved = $user->getId();
        $this->revisionUnit->properties->saveCheck();
    }

}