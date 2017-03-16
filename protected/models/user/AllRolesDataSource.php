<?php

class AllRolesDataSource implements IRolesDataSource
{
    /**
     * @return array UserRoles
     */
    public static function roles(){
        return array(
            UserRoles::ADMIN,
            UserRoles::ACCOUNTANT,
            UserRoles::AUTHOR,
            UserRoles::CONTENT_MANAGER,
            UserRoles::TEACHER_CONSULTANT,
            UserRoles::TRAINER,
            UserRoles::STUDENT,
            UserRoles::TENANT,
            UserRoles::SUPERVISOR,
            UserRoles::SUPER_ADMIN,
            UserRoles::AUDITOR,
            UserRoles::DIRECTOR,
        );
    }
}