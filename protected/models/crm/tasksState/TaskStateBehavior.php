<?php

class TaskStateBehavior extends CActiveRecordBehavior {

    private $state = null;
    private $taskStateFactory = null;

    public function afterConstruct($event) {
        parent::afterConstruct($event);
        $this->initState($event->sender, true);
    }

    public function afterFind($event) {
        parent::afterFind($event);
        $this->initState($event->sender);
    }

    private function initState($sender) {
        $this->taskStateFactory = TaskStateFactory::getInstance();
        $this->state = $this->taskStateFactory->getState($sender);
    }

    public function getName() {
        return $this->state->getName();
    }

    public function getCode() {
//        todo
        return $this->owner->properties->id_state;
    }

    public function changeTo($state, $user) {
        $this->state->changeTo($state, $user);
        $this->owner->refresh();
        $this->state = $this->taskStateFactory->getState($this->owner);
    }

    public function canChange($state) {
        return method_exists($this->state, $state);
    }

}