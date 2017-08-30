<?php

/**
 * @property CrmTasks $taskUnit
 */
abstract class TaskState {

    const ExpectsToExecute = 1;
    const Executed = 2;
    const Paused = 3;
    const Completed = 4;

    protected $stateName = null;
    protected $taskUnit = null;

    protected $historyTable = null;
    protected $propertyTable = null;
    protected $idTask = null;
    protected $idTaskField = null;

    function __construct($taskUnit, $stateName) {
        $this->taskUnit = $taskUnit;
        $this->stateName = $stateName;
        $this->historyTable = 'crm_task_state_history';
        $this->propertyTable = 'crm_tasks';
        $this->idTask = $this->taskUnit->id;
        $this->_init();
    }

    /**
     * Function to init state.
     * For example setup $stateName.
     * @return mixed
     */
    abstract protected function _init();

    public function getName() {
        $message = get_class($this);
        return Yii::t('revision', $message);
    }

    public function changeTo($state, $user) {
        if (method_exists($this, $state)) {
            $this->$state($user);
        } else {
            Yii::log('State ' . $state . ' missed in ' . get_class($this) . ' task ' . var_export($this->taskUnit->getAttributes(), true), CLogger::LEVEL_ERROR, 'application.crm');
            throw new Exception('State ' . $state . ' missed in ' . get_class($this));
        }
    }

    protected function _changeState($idTask, $stateId, $userId) {
        $query = "SELECT id_state, change_date INTO @idState, @changeDate FROM $this->propertyTable WHERE id=$this->idTask;
                  INSERT INTO $this->historyTable (`id_task`,`id_state`,`id_user`, `change_date`) VALUES ($this->idTask, $stateId, $userId, @changeDate);
                  UPDATE $this->propertyTable SET `id_state`=$stateId, `change_date`=NOW() WHERE id=$this->idTask;";
        Yii::app()->db->createCommand($query)->execute();
    }

    protected function _expectToExecute($user) {
        $this->_changeState($this->idTask, self::ExpectsToExecute, $user->getId());
    }

    protected function _executed($user) {
        $this->_changeState($this->idTask, self::Executed, $user->getId());
    }

    protected function _paused($user) {;
        $this->_changeState($this->idTask, self::Paused, $user->getId());
    }

    protected function _completed($user) {
        $this->_changeState($this->idTask, self::Completed, $user->getId());
    }
}