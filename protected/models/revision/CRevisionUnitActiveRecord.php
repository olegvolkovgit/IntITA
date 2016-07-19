<?php

/**
 * Class CRevisionUnitActiveRecord
 * @property RevisionStateBehavior $state
 */

abstract class CRevisionUnitActiveRecord extends CActiveRecord {

    public function behaviors(){
        return array(
            'state' => array(
                'class' => 'RevisionStateBehavior'
            ),
        );
    }

    protected function getMessageClasses() {
        return [];
    }

    
    /**
     * Return true if the lecture can be edited
     * @return bool
     */
    public function isEditable() {
        return $this->state->getCode() == RevisionState::EditableState;
    }

    /**
     * Return true if revision can be approv
     * @return bool
     */
    public function isApprovable() {
        return $this->state->canChange('approved');
    }

    /**
     * Return true if revision can be reject
     * @return bool
     */
    public function isRejectable() {
        return $this->state->canChange('rejected');
    }

    /**
     * Return true if revision can be cancel
     * @return bool
     */
    public function isCancellable() {
        return $this->state->canChange('cancel');
    }

    /**
     * Return true if revision can be send
     * @return bool
     */
    public function isSendable() {
        return $this->state->canChange('sendForApproval');
    }

    /**
     * Return true if revision can be cancel send for approve
     * @return bool
     */
    public function isRevokeable() {
        return $this->state->canChange('editable') && $this->state->getCode() == RevisionState::SendForApprovalState;
    }

    /**
     * Return true if revision can be ready
     * @return bool
     */
    public function isReleaseable() {
        return $this->state->canChange('released');
    }

    /**
     * Return true if revision can be clone
     * @return bool
     */
    public function isClonable() {
        return (!$this->isRejected() && !$this->isCancelled());
    }

    /**
     * Return true if revision was rejected
     * @return bool
     */
    public function isRejected() {
        return $this->state->getCode() == RevisionState::RejectedState;
    }

    /**
     * Return true if revision was sended
     * @return bool
     */
    public function isSended() {
        return $this->state->getCode() == RevisionState::SendForApprovalState;
    }

    /**
     * Return true if revision was approved
     * @return bool
     */
    public function isApproved() {
        return $this->state->getCode() == RevisionState::ApprovedState;
    }

    /**
     * Return true if revision is ready
     * @return bool
     */
    public function isReleased() {
        return $this->state->getCode() == RevisionState::ReleasedState;
    }

    /**
     * Return true if revision was cancelled
     * @return bool
     */
    public function isCancelled() {
        return $this->state->getCode() == RevisionState::CancelledState;
    }

    /**
     * Return true if revision was cancelled edit by author
     * @return bool
     */
    public function isCancelledEditor() {
        return $this->state->getCode() == RevisionState::CancelledAuthorState;
    }

    public function canEdit() {
        return ($this->properties->id_user_created == Yii::app()->user->getId() && $this->isEditable());
    }

    public function canCancelSendForApproval() {
        return ($this->properties->id_user_created == Yii::app()->user->getId() && $this->isApprovable());
    }

    public function canSendForApproval() {
        return ($this->properties->id_user_created == Yii::app()->user->getId() && $this->isSendable());
    }

    public function canApprove() {
        return (Yii::app()->user->model->canApprove() && $this->isApprovable());
    }

    public function canCancelReadyRevision() {
        return (Yii::app()->user->model->canApprove() && $this->isCancellable());
    }

    public function canRejectRevision() {
        return (Yii::app()->user->model->canApprove() && $this->isRejectable());
    }

    public function canReleaseRevision() {
        return (Yii::app()->user->model->canApprove() && $this->isReleaseable());
    }

    public function canCancelEdit() {
        return ($this->properties->id_user_created == Yii::app()->user->getId() && $this->isEditable());
    }

    public function canRestoreEdit() {
        return ($this->properties->id_user_created == Yii::app()->user->getId() && $this->isCancelledEditor());
    }

    public function canCancel() {
        return (Yii::app()->user->model->canApprove() && $this->isCancellable());
    }

}