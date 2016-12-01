<?php

/**
 * Created by PhpStorm.
 * User: anton
 * Date: 28.11.16
 * Time: 22:19
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
     * @param $service
     * @return mixed
     */
    function checkVisitorAccess($service) {
        // TODO: Implement checkVisitorAccess() method.
    }
}