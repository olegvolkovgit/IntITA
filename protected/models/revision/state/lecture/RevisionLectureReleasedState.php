<?php

class RevisionLectureReleasedState extends RevisionState {

    protected function _init() {
    }

    public function approved($user) {
        parent::_approved($user);
    }

    public function cancel($user) {
        if($this->revisionUnit->moduleOrder!=null) {
            echo 'Скасувати ревізію не можна оскільки вона входить принаймні в одну з ревізій модулів';
            return false;
        }

        parent::_cancel($user);
    }

}