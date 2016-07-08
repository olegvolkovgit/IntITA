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

    /**
     * Function to init state.
     * For example setup $stateName.
     * @return mixed
     */
    abstract protected function _init();

    public function getName() {
        return $this->stateName;
    }

    public function changeTo($state, $user) {
        if (method_exists($this, $state)) {
            $this->$state($user);
        } else {
            Yii::log('State ' . $state . ' missed in ' . get_class($this) . ' revision ' . var_export($this->revisionUnit->getAttributes(), true), CLogger::LEVEL_ERROR, 'application.revision');
            throw new Exception('State ' . $state . ' missed in ' . get_class($this));
        }
    }
}