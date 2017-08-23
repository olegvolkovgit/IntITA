<?php

class CrmTasksPausedState extends TaskState {

    protected function _init() {
        $this->stateName = "Призупинено";
    }

    public function executed($user) {
        parent::_executed($user);
    }
    
    public function completed($user) {
        parent::_completed($user);
    }

    public function expectToExecute($user) {
        parent::_expectToExecute($user);
    }

}