<?php

/**
 *
 * @property StudentReg $owner
 */
class StudentRegAccess extends CActiveRecordBehavior implements VisitorAccessBehavior {

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
     * @param CourseService|ModuleService $service
     * @return mixed
     */
    function checkVisitorAccess($service) {
        if ($service) {
            return $service->access->checkServiceAccess($this->owner->id);
        }
        return false;
    }
}