<?php

/**
 * @property OfflineGroups $owner
 */
class GroupAccessBehavior extends CActiveRecordBehavior implements VisitorAccessBehavior {

    /**
     * Provide access for visitor to service
     * @param $service
     * @return mixed
     */
    function grantVisitorAccess($service) {
        // TODO: Implement grantVisitorAccess() method.
    }

    /**
     * Revoke access for visitor to service
     * @param $service
     * @return mixed
     */
    function revokeVisitorAccess($service) {
        // TODO: Implement revokeVisitorAccess() method.
    }

    /**
     * Check access for visitor to service
     * @param $service
     * @return mixed
     */
    function checkVisitorAccess($service) {
        if ($service) {
            $qs = "SELECT count(*) FROM group_access_to_content
               WHERE group_id=:groupId AND service_id=:serviceId AND NOW() BETWEEN start_date and end_date";
            $command = Yii::app()->db->createCommand($qs);
            return $command->queryScalar([
                ':groupId' => $this->owner->id,
                ':serviceId' => $service->service_id]) == 1;
        }
        return false;
    }
}