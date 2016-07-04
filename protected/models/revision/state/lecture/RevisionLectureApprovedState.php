<?php

class RevisionLectureApprovedState extends RevisionState {

    protected function _init() {
        $this->stateName = "Затверджена";
    }

    public function readyForRelease($user) {
        $this->revisionUnit->properties->proposed_to_release_date = new CDbExpression('NOW()');
        $this->revisionUnit->properties->id_user_proposed_to_release = $user->getId();
        $this->revisionUnit->properties->saveCheck();
    }

    public function cancel($user) {
        if($this->revisionUnit->moduleOrder!=null) {
            echo 'Скасувати ревізію не можна оскільки вона входить принаймні в одну з ревізій модулів';
            return false;
        }

        $this->revisionUnit->properties->end_date = new CDbExpression('NOW()');
        $this->revisionUnit->properties->id_user_cancelled = $user->getId();
        $this->revisionUnit->properties->saveCheck();
    }

}