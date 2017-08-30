<?php

class CrmTasksExecutedState extends TaskState {

    protected function _init() {
        $this->stateName = "Виконується";
    }

    public function paused($user) {
        parent::_paused($user);
    }
    
    public function completed($user) {
        parent::_completed($user);
    }

    public function expectToExecute($user) {
        parent::_expectToExecute($user);
    }

}