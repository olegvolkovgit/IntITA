<?php

interface ServiceAccessBehavior extends IBehavior {

    /**
     * Provide access for user to service
     * @param $userId
     * @return mixed
     */
    function grantServiceAccess($userId, $endDate, $comment = '');

    /**
     * Revoke access for user to service
     * @param $userId
     * @return mixed
     */
    function revokeServiceAccess($userId, $comment);


    /**
     * Check access for user to service
     * @param $userId
     * @return boolean
     */
    function checkServiceAccess($userId);
}