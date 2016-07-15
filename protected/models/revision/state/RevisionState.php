<?php

/**
 * @property RevisionLecture|RevisionModule $revisionUnit
 */
abstract class RevisionState {

    const EditableState = 1;
    const CancelledAuthorState = 2;
    const SendForApprovalState = 3;
    const RejectedState = 4;
    const ApprovedState = 5;
    const ReadyForRelease = 6;
    const ReleasedState = 7;
    const CancelledState = 8;

    protected $stateName = null;
    protected $revisionUnit = null;

    protected $historyTable = null;
    protected $propertyTable = null;
    protected $idRevision = null;
    protected $idRevisionField = null;

    function __construct($revisionUnit, $stateName) {
        $this->revisionUnit = $revisionUnit;
        $this->stateName = $stateName;
        // todo
        switch (get_class($this->revisionUnit)) {
            case 'RevisionLecture' :
                $this->historyTable = 'vc_lecture_state_history';
                $this->propertyTable = 'vc_lecture_properties';
                $this->idRevision = $this->revisionUnit->id_revision;
                break;
            case 'RevisionModule' :
                $this->historyTable = 'vc_module_state_history';
                $this->propertyTable = 'vc_module_properties';
                $this->idRevision = $this->revisionUnit->id_module_revision;
                break;
            default;
                break;
        }
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
            Yii::log('State ' . $state . ' missed in ' . get_class($this) . ' revision ' . var_export($this->revisionUnit->getAttributes(), true), CLogger::LEVEL_ERROR, 'application.revision');
            throw new Exception('State ' . $state . ' missed in ' . get_class($this));
        }
    }

    public function saveToHistoryAfterConstruct() {
        $userId = $this->revisionUnit->properties->id_user;
        $date = $this->revisionUnit->properties->change_date;
        $query = "INSERT INTO $this->historyTable (`id_revision`,`id_state`,`id_user`, `change_date`) VALUES ($this->idRevision, 1, $userId, $date)";
        Yii::app()->db->createCommand($query)->execute();
    }

    protected function _changeState($idRevision, $stateId, $userId) {
        $idProperties = $this->revisionUnit->properties->id;
        $query = "SELECT id_user, id_state, change_date INTO @idUser, @idState, @changeDate FROM $this->propertyTable WHERE id=$idProperties; 
                  INSERT INTO $this->historyTable (`id_revision`,`id_state`,`id_user`, `change_date`) VALUES ($this->idRevision, @idState, @idUser, @changeDate);
                  UPDATE $this->propertyTable SET `id_state`=$stateId, `id_user`=$userId, `change_date`=NOW() WHERE id=$idProperties;";
        Yii::app()->db->createCommand($query)->execute();
    }

    protected function _editable($user) {
        $this->_changeState($this->idRevision, self::EditableState, $user->getId());
    }

    protected function _cancelledAuthor($user) {
        $this->_changeState($this->idRevision, self::CancelledAuthorState, $user->getId());
    }

    protected function _sendForApproval($user) {
        $this->_changeState($this->idRevision, self::SendForApprovalState, $user->getId());
    }

    protected function _rejected($user) {
        $this->_changeState($this->idRevision, self::RejectedState, $user->getId());
    }

    protected function _approved($user) {
        $this->_changeState($this->idRevision, self::ApprovedState, $user->getId());
    }

    protected function _readyForRelease($user) {
        $this->_changeState($this->idRevision, self::ReadyForRelease, $user->getId());
    }

    protected function _released($user) {
        $this->_changeState($this->idRevision, self::ReleasedState, $user->getId());
    }

    protected function _cancel($user) {
        $this->_changeState($this->idRevision, self::CancelledState, $user->getId());
    }
}