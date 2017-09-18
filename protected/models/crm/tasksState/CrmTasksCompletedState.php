<?php

class CrmTasksCompletedState extends TaskState {

    protected function _init() {
        $this->stateName = "Завершено";
    }

    public function executed($user) {
        parent::_executed($user);
    }

    public function paused($user) {
        parent::_paused($user);
    }

    public function expectToExecute($user) {
        parent::_expectToExecute($user);
    }

}