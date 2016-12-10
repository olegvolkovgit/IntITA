<?php

/**
 * Created by PhpStorm.
 * User: anton
 * Date: 28.11.16
 * Time: 22:13
 */
interface VisitorAccessBehavior extends IBehavior {

    /**
     * Provide access for visitor to service
     * @param $service
     * @return mixed
     */
    function grantVisitorAccess($service);

    /**
     * Revoke access for visitor to service
     * @param $service
     * @return mixed
     */
    function revokeVisitorAccess($service);

    /**
     * Check access for visitor to service
     * @param $service
     * @return mixed
     */
    function checkVisitorAccess($service);

}