<?php

class RevisionQuizUidUpdateBehavior extends CActiveRecordBehavior{

    const QUIZ_UPDATED = 1;

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
        $this->owner->uid = RevisionQuizFactory::cloneQuizUID($this->owner->uid);
    }

    /**
     * If model not new and wasn't update before set update flag in model.
     * @return bool
     */
    public function beforeSave() {
        if (!$this->owner->isNewRecord && !$this->isUpdated()) {
            $this->setUpdated();
        }
        return true;
    }
}