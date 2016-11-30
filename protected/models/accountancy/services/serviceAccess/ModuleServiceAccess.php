<?php

class ModuleServiceAccess extends CActiveRecordBehavior implements ServiceAccessBehavior {

    /**
     * Check access for user to service
     * @param $userId
     * @return boolean
     */
    function checkServiceAccess($userId) {
        $qs = "SELECT count(*) FROM user_service_access
               WHERE userId=:userId AND serviceId=:serviceId AND endDate > NOW()";
        $command = Yii::app()->db->createCommand($qs);
        return $command->queryScalar([
            ':userId' => $userId,
            ':serviceId' => $this->owner->service_id]) == 1;
    }

    /**
     * Provide access for user to service
     * @param $userId
     * @return mixed
     */
    function grantServiceAccess($userId, $endDate, $comment = '') {
        $qs = "INSERT INTO user_service_access (userId, serviceId, endDate, userChanged, comment) 
               VALUES (:userId, :serviceId, :endDate, :userChanged, :comment)
               ON DUPLICATE KEY UPDATE endDate = :endDate, comment = :comment, userChanged = :userChanged";
        $command = Yii::app()->db->createCommand($qs);
        return $command->execute([
            ':userId' => $userId,
            ':serviceId' => $this->owner->service_id,
            ':endDate' => $endDate,
            ':userChanged' => Yii::app()->user->getId(),
            ':comment' => $comment
        ]);
    }

    /**
     * Revoke access for user to service
     * @param $userId
     * @return mixed
     */
    function revokeServiceAccess($userId, $comment) {
        // TODO: Implement revokeServiceAccess() method.
    }
}