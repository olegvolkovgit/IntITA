<?php

class RevisionStateBehavior extends CActiveRecordBehavior {

    private $state = null;
    private $revisionStateFactory = null;

    public function afterConstruct($event) {
        parent::afterConstruct($event);
        $this->initState($event->sender, true);
    }

    public function afterFind($event) {
        parent::afterFind($event);
        $this->initState($event->sender);
    }

    private function initState($sender) {
        $this->revisionStateFactory = RevisionStateFactory::getInstance();
        $this->state = $this->revisionStateFactory->getState($sender);

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
        $this->state = $this->revisionStateFactory->getState($this->owner);
    }

    public function canChange($state) {
        // todo
        return (method_exists($this->state, $state) && $this->owner->properties->id_state != RevisionState::ReleasedState);
    }

}