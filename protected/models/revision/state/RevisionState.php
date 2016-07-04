<?php

/**
 * @property RevisionLecture $revisionUnit
 */
abstract class RevisionState {

    protected $stateName = null;
    protected $revisionUnit = null;

    function __construct($revisionUnit) {
        $this->revisionUnit = $revisionUnit;
        $this->_init();
    }
    
    abstract protected function _init();

    public function getName() {
        return $this->stateName;
    }

    public function changeTo($state, $user) {
        if (method_exists($this, $state)) {
            $this->$state($user);
        } else {
            throw new Exception('State ' . $state . ' missed in ' . get_class($this));
        }
    }
}