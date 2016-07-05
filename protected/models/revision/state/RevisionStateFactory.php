<?php

class RevisionStateFactory {

    private $revisionUnit = null;

    private $stateAttributes = [
//        'start_date' => 'Editable',
        'send_approval_date' => 'SendForApproval',
        'reject_date' => 'Rejected',
        'approve_date' => 'Approved',
        'end_date' => 'Cancelled',
        'release_date' => 'Released',
        'cancel_edit_date' => 'CancelledAuthor',
        'proposed_to_release_date' => 'ReadyForRelease',
    ];

    function __construct(CRevisionUnitActiveRecord $rU) {
        $this->revisionUnit = $rU;
    }
    

    public function getState() {
        $currentState = $this->getCurrentState();
        $className = get_class($this->revisionUnit) . $currentState . 'State';
         if ($currentState && (class_exists($className, true))) {
            return new $className($this->revisionUnit);
        }
        return new RevisionErrorState($this->revisionUnit);
    }

    private function getCurrentState() {
        $states = [];
        if ($this->revisionUnit->properties) {
            $states = $this->revisionUnit->properties->getAttributes(array_keys($this->stateAttributes));
            $states = array_filter($states);
        }
        $currentState = null;
        foreach ($states as $state=>$date) {
            if (!$currentState || date($date) >= date($states[$currentState])) {
                $currentState = $state;
            }
        }
        return $currentState ? $this->stateAttributes[$currentState] : 'Editable';
    }
}