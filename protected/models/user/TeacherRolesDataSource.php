<?php

class TeacherRolesDataSource implements IRolesDataSource
{
    /**
     * Returns all coworkers (colleagues) roles
     * @return array UserRoles
     */
    public static function roles(){
        return array(
            UserRoles::ADMIN,
            UserRoles::ACCOUNTANT,
            UserRoles::AUTHOR,
//            UserRoles::CONSULTANT,
            UserRoles::CONTENT_MANAGER,
            UserRoles::TEACHER_CONSULTANT,
            UserRoles::TRAINER,
            UserRoles::TENANT
        );
    }
}