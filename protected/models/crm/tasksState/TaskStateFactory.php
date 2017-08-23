<?php

/**
 * Class TaskStateFactory
 * Singleton to keep data in memory to avoid extra database queries
 *
 * @property CrmTasks $taskUnit
 */
class TaskStateFactory {

    private $states = [];
    private static $_instance = null;

    private function __construct() {
        /*
         * Load and cache table data in memory.
         */
        $query = 'SELECT * FROM crm_task_status';
        $states = Yii::app()->db->createCommand($query)->queryAll();
        foreach ($states as $state) {
            $this->states[$state['id']] = $state['name'];
        }
    }

    private function __clone() {
    }

    public static function getInstance() {
        if (self::$_instance === null) {
            self::$_instance = new TaskStateFactory();
        }
        return self::$_instance;
    }

    public function getState($taskUnit) {
        $currentState = $this->getCurrentState($taskUnit);
        $className = get_class($taskUnit) . $currentState . 'State';
        if ($currentState && (class_exists($className, true))) {
            return new $className($taskUnit, $currentState);
        }
        return new CrmTasksErrorState($taskUnit, 'Error');
    }

    private function getCurrentState($taskUnit) {
        $idState = $taskUnit->id_state;
        return ucwords($this->states[$idState]); /* ucword for compatible with camelCase :-) */
    }
}