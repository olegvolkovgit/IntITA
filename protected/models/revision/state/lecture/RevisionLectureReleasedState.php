<?php

class RevisionLectureReleasedState extends RevisionState {

    protected function _init() {
        $this->stateName = "Реліз";
    }

    public function approved($user) {
        $this->revisionUnit->properties->proposed_to_release_date = new CDbExpression('NULL');
        $this->revisionUnit->properties->id_user_proposed_to_release = null;
        $this->revisionUnit->properties->release_date = new CDbExpression('NULL');
        $this->revisionUnit->properties->id_user_released = null;
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