<?php

/**
 * Class CTaskUnitActiveRecord
 * @property TaskStateBehavior $state
 */

abstract class CTaskUnitActiveRecord extends CActiveRecord {

    public function behaviors(){
        return array(
            'state' => array(
                'class' => 'TaskStateBehavior'
            ),
        );
    }

    protected function getMessageClasses() {
        return [];
    }

    /**
     * Return true if task can be expects to execute
     * @return bool
     */
    public function isExpectsToExecutable() {
        return $this->state->canChange('expectsToExecute');
    }

    /**
     * Return true if task can be executed
     * @return bool
     */
    public function isExecutable() {
        return $this->state->canChange('executed');
    }

    /**
     * Return true if task can be paused
     * @return bool
     */
    public function isPausable() {
        return $this->state->canChange('paused');
    }

    /**
     * Return true if task can be completed
     * @return bool
     */
    public function isCompletable() {
        return $this->state->canChange('completed');
    }

    /**
     * Return true if task was expects to execute
     * @return bool
     */
    public function isExpectsToExecute() {
        return $this->state->getCode() == TaskState::ExpectsToExecute;
    }

    /**
     * Return true if revision was executed
     * @return bool
     */
    public function isExecuted() {
        return $this->state->getCode() == TaskState::Executed;
    }

    /**
     * Return true if revision was paused
     * @return bool
     */
    public function isPaused() {
        return $this->state->getCode() == TaskState::Paused;
    }

    /**
     * Return true if revision is completed
     * @return bool
     */
    public function isCompleted() {
        return $this->state->getCode() == TaskState::Completed;
    }
}