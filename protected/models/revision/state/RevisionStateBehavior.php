<?php

class RevisionStateBehavior extends CActiveRecordBehavior {

    private $state = null;

    public function afterConstruct($event) {
        parent::afterConstruct($event);
        $this->initState($event->sender);
    }

    public function afterFind($event) {
        parent::afterFind($event);
        $this->initState($event->sender);
    }

    private function initState($sender) {
        $revisionStateFactory = new RevisionStateFactory($sender);
        $this->state = $revisionStateFactory->getState();
    }

    public function getName() {
        return $this->state->getName();
    }
    
    public function changeTo($state, $user) {
        $this->state->changeTo($state, $user);
        $this->owner->refresh();
        $revisionStateFactory = new RevisionStateFactory($this->owner);
        $this->state = $revisionStateFactory->getState();
    }

    public function canChange($state) {
        return method_exists($this->state, $state);
    }

}