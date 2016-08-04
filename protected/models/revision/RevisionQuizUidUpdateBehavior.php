<?php

class RevisionQuizUidUpdateBehavior extends CActiveRecordBehavior{

    const QUIZ_NOT_UPDATED = 0;
    const QUIZ_UPDATED = 1;
    const QUIZ_APPROVED = 2;

    public function events()
    {
        return array_merge(parent::events(), array(
            'onAfterApprove'=>'afterApprove'
        ));
    }

    /**
     * Check if model updated
     * @return bool
     */
    private function isUpdated(){
        return $this->owner->updated == self::QUIZ_UPDATED;
    }

    /**
     * Sets model updated
     */
    private function setUpdated() {
        $this->owner->updated = self::QUIZ_UPDATED;
        $oldUid=$this->owner->uid;
        $this->owner->uid = RevisionQuizFactory::cloneQuizUID($this->owner->uid);
        if($this->owner->lectureElement->id_type==LectureElement::TASK){
            $this->owner->cloneInterpreterJson($oldUid);
        }
    }

    private function setApproved() {
        $this->owner->updated = self::QUIZ_APPROVED;
        $this->owner->save();
    }

    /**
     * If model not new and wasn't update before set update flag in model.
     * @return bool
     */
    public function beforeSave($event) {
        if (!$this->owner->isNewRecord && !$this->isUpdated() && $this->owner->updated != self::QUIZ_APPROVED) {
            $this->setUpdated();
        }
        return true;
    }

    public function afterApprove() {
        $this->setApproved();
        return true;
    }

}