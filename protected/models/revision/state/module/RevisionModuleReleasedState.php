<?php

class RevisionModuleReleasedState extends RevisionState {

    protected function _init() {
        $this->stateName = "Реліз";
    }

    public function cancel($user) {

        $transaction = Yii::app()->db->beginTransaction();
        try {
            foreach ($this->revisionUnit->moduleLecturesModels as $key=>$moduleLecture){
                $moduleLecture->lecture->cancelReleasedInTree($user);
            }
            $this->revisionUnit->properties->end_date = new CDbExpression('NOW()');
            $this->revisionUnit->properties->id_user_cancelled = $user->getId();
            $this->revisionUnit->properties->saveCheck();

            $transaction->commit();
        } catch (Exception $e) {
            $transaction->rollback();
            throw $e;
        }

        return true;
    }

}