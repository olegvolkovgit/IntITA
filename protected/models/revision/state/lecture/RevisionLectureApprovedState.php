<?php

class RevisionLectureApprovedState extends RevisionState {

    protected function _init() {
    }

    public function readyForRelease($user) {
        $this->revisionUnit->cancelProposedToReleaseInTree($user);
        parent::_readyForRelease($user);
        
        return true;
    }

    public function cancel($user) {
        if($this->revisionUnit->moduleOrder!=null) {
            echo 'Скасувати ревізію не можна оскільки вона входить принаймні в одну з ревізій модулів';
            return false;
        }

        parent::_cancel($user);
    }

}