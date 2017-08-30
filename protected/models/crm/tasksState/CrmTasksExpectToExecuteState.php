<?php

class CrmTasksExpectToExecuteState extends TaskState {

    protected function _init() {
        $this->stateName = "Очікує на виконання";
    }

    public function executed($user) {
        parent::_executed($user);
    }

    public function paused($user) {
        parent::_paused($user);
    }
    
    public function completed($user) {
        parent::_completed($user);
    }

}