<?php

/**
 * Class RevisionStateFactory
 * Singleton to keep data in memory to avoid extra database queries
 *
 * @property RevisionLecture|RevisionModule $revisionUnit
 */
class RevisionStateFactory {

    private $states = [];
    private static $_instance = null;

    private function __construct() {
        /*
         * Load and cache table data in memory.
         */
        $query = 'SELECT * FROM vc_revision_status';
        $states = Yii::app()->db->createCommand($query)->queryAll();

        foreach ($states as $state) {
            $this->states[$state['id_status']] = $state['name'];
        }
    }

    private function __clone() {
    }

    public static function getInstance() {
        if (self::$_instance === null) {
            self::$_instance = new RevisionStateFactory();
        }
        return self::$_instance;
    }

    public function getState($revisionUnit) {
        $currentState = $this->getCurrentState($revisionUnit);
        $className = get_class($revisionUnit) . $currentState . 'State';
        if ($currentState && (class_exists($className, true))) {
            return new $className($revisionUnit, $currentState);
        }
        return new RevisionErrorState($revisionUnit);
    }

    private function getCurrentState($revisionUnit) {
        $idState = $revisionUnit->properties ? $revisionUnit->properties->id_state : RevisionState::EditableState;
        return ucwords($this->states[$idState]); /* ucword for compatible with camelCase :-) */
    }
}