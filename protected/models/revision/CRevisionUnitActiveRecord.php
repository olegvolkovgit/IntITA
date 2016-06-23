<?php

abstract class CRevisionUnitActiveRecord extends CActiveRecord {

    protected function getMessageClasses() {
        return [];
    }


    /**
     * Sends current revision to approve
     */

    protected function beforeSendForApproval($user) {
        return true;
    }

    public function sendForApproval($user) {
        if ($this->isSendable()) {
            if ($this->beforeSendForApproval($user)) {
                $this->properties->send_approval_date = new CDbExpression('NOW()');
                $this->properties->id_user_sended_approval = $user->getId();
                $this->properties->saveCheck();
                $this->afterSendForApproval();
            } else {
                //todo inform user
            }

        } else {
            //todo inform user
        }
    }

    protected function afterSendForApproval() {
    }


    /**
     * Cancel sends current revision to approve
     */

    protected function beforeRevoke() {
        return true;
    }

    public function revoke() {
        if ($this->isApprovable()) {
            if ($this->beforeRevoke()) {
                $this->properties->send_approval_date = new CDbExpression('NULL');
                $this->properties->id_user_sended_approval = null;
                $this->properties->saveCheck();
                $this->afterRevoke();
            }
        } else {
            //todo inform user
        }
    }

    protected function afterRevoke() {
    }


    /**
     * Rejects lecture revision
     */

    protected function beforeReject($user) {
        return true;
    }

    public function reject($user) {
        if ($this->isRejectable()) {
            if ($this->beforeReject($user)) {
                $this->properties->reject_date = new CDbExpression('NOW()');
                $this->properties->id_user_rejected = $user->getId();
                $this->properties->saveCheck();
                $this->afterReject();
            }
        } else {
            //sending inform message to revision author
            $transaction = Yii::app()->db->beginTransaction();
            try {
                $message = new $this->messageClasses['reject']();
                $comment = '';
                $message->build(Yii::app()->user->model->registrationData, $this, $comment);
                $message->create();
                $sender = new MailTransport();

                $message->send($sender);
                $transaction->commit();
            } catch (Exception $e) {
                $transaction->rollback();
                throw new \application\components\Exceptions\IntItaException(500, "Повідомлення не вдалося надіслати.");
            }
        }
    }

    protected function afterReject() { }


    /**
     * Freeze revision status, pre-release state.
     */

    protected function beforeApprove($user) {
        return true;
    }

    public function approve($user) {
        if ($this->beforeApprove($user)) {
            $this->properties->approve_date = new CDbExpression('NOW()');
            $this->properties->id_user_approved = $user->getId();
            $this->properties->saveCheck();
            $this->afterApprove();
        }
    }

    protected function afterApprove() { }


    /**
     * Approves lecture revision
     */

    protected function beforeRelease($user) {
        return true;
    }

    public function release($user) {
        if ($this->isReleaseable()) {
            if ($this->beforeRelease($user)) {
                $this->properties->release_date = new CDbExpression('NOW()');
                $this->properties->id_user_released = $user->getId();
                $this->properties->saveCheck();
                $this->afterRelease();
            }
        } else {
            //todo inform user
        }
    }

    protected function afterRelease() { }


    /**
     * Cancels lecture revision
     */

    protected function beforeCancel($user) {
        return true;
    }

    public function cancel($user) {
        if ($this->isCancellable()) {
            if ($this->beforeCancel($user)) {
                $this->properties->end_date = new CDbExpression('NOW()');
                $this->properties->id_user_cancelled = $user->getId();
                $this->properties->saveCheck();
                $this->afterCancel();
            }
        } else {
            //todo inform user
        }
    }

    protected function afterCancel() { }

    
    /**
     * Cancel edit current revision by editor
     * @param $user
     */
    public function cancelEditRevisionByEditor($user) {
        if ($this->isEditable()) {
            if ($this->beforeCancelEditRevisionByEditor()) {
                $this->properties->cancel_edit_date = new CDbExpression('NOW()');
                $this->properties->id_user_cancelled_edit = $user->getId();
                $this->properties->saveCheck();
                $this->afterCancelEditRevisionByEditor();
            }
        } else {
            //todo inform user
        }
    }

    protected function beforeCancelEditRevisionByEditor() {
        return true;
    }

    protected function afterCancelEditRevisionByEditor() {
    }


    /**
     * Restore edit current revision by editor
     */
    protected function beforeRestoreEditRevisionByEditor() {
        return true;
    }

    public function restoreEditRevisionByEditor() {
        if ($this->isCancelledEditor()) {
            if ($this->beforeRestoreEditRevisionByEditor()) {
                $this->properties->cancel_edit_date = new CDbExpression('NULL');
                $this->properties->id_user_cancelled_edit = null;
                $this->properties->saveCheck();
                $this->afterRestoreEditRevisionByEditor();
            }
        } else {
            //todo inform user
        }
    }

    protected function afterRestoreEditRevisionByEditor() { }

    
    /**
     * Return true if the lecture can be edited
     * @return bool
     */
    public function isEditable() {
        if (!$this->isSended() &&
            !$this->isApproved() &&
            !$this->isCancelled() &&
            !$this->isCancelledEditor() &&
            !$this->isRejected()
        ) {
            return true;
        }
        return false;
    }

    /**
     * Return true if revision can be approv
     * @return bool
     */
    public function isApprovable() {
        if ($this->isSended() &&
            !$this->isRejected() &&
            !$this->isCancelled() &&
            !$this->isApproved() &&
            $this->id_module != null
        ) {
            return true;
        }
        return false;
    }

    /**
     * Return true if revision can be reject
     * @return bool
     */
    public function isRejectable() {
        if ($this->isSended() &&
            !$this->isApproved() &&
            !$this->isRejected()
        ) {
            return true;
        }
        return false;
    }

    /**
     * Return true if revision can be cancel
     * @return bool
     */
    public function isCancellable() {
        if ($this->isReleased() && !$this->isCancelled()) {
            return true;
        }
        return false;
    }

    /**
     * Return true if revision can be send
     * @return bool
     */
    public function isSendable() {
        if (!$this->isSended() &&
            !$this->isRejected() &&
            !$this->isApproved() &&
            !$this->isCancelled() &&
            !$this->isCancelledEditor()
        ) {
            return true;
        }
        return false;
    }

    /**
     * Return true if revision can be cancel send for approve
     * @return bool
     */
    public function isRevokeable() {
        if ($this->isSended() &&
            !$this->isRejected() &&
            !$this->isApproved() &&
            !$this->isCancelled() &&
            !$this->isCancelledEditor()
        ) {
            return true;
        }
        return false;
    }

    /**
     * Return true if revision can be ready
     * @return bool
     */
    public function isReleaseable() {
        if ($this->isApproved() &&
            !$this->isReleased() &&
            !$this->isCancelled() &&
            !$this->isCancelledEditor()
        ) {
            return true;
        }
        return false;
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
        return $this->properties->id_user_rejected != null;
    }

    /**
     * Return true if revision was sended
     * @return bool
     */
    public function isSended() {
        return $this->properties->id_user_sended_approval != null;
    }

    /**
     * Return true if revision was approved
     * @return bool
     */
    public function isApproved() {
        return $this->properties->id_user_approved != null;
    }

    /**
     * Return true if revision is ready
     * @return bool
     */
    public function isReleased() {
        return $this->properties->id_user_released != null;
    }

    /**
     * Return true if revision was cancelled
     * @return bool
     */
    public function isCancelled() {
        return $this->properties->id_user_cancelled != null;
    }

    /**
     * Return true if revision was cancelled edit by author
     * @return bool
     */
    public function isCancelledEditor() {
        return $this->properties->id_user_cancelled_edit != null;
    }

    /**
     * Returns lecture revision status
     * @return string
     */
    public function getStatus() {
        if ($this->isCancelledEditor()) {
            return "Скасована автором";
        }
        if ($this->isCancelled()) {
            return "Скасована";
        }
        if ($this->isReleased()) {
            return "Реліз";
        }
        if ($this->isApproved()) {
            return "Затверджена";
        }
        if ($this->isRejected()) {
            return "Відхилена";
        }
        if ($this->isSended()) {
            return "Відправлена на розгляд";
        }
        return 'Доступна для редагування';
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