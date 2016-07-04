<?php

class RevisionLectureEditableState extends RevisionState {

    protected function _init() {
        $this->stateName = "Доступна до редагування";
    }

    public function sendForApproval($user) {
        if (empty($this->revisionUnit->checkConflicts())) {
            $this->revisionUnit->properties->send_approval_date = new CDbExpression('NOW()');
            $this->revisionUnit->properties->id_user_sended_approval = $user->getId();
            $this->revisionUnit->properties->saveCheck();
        }
    }

    public function cancelledAuthor($user) {
        $this->revisionUnit->properties->cancel_edit_date = new CDbExpression('NOW()');
        $this->revisionUnit->properties->id_user_cancelled_edit = $user->getId();
        $this->revisionUnit->properties->saveCheck();
    }
}