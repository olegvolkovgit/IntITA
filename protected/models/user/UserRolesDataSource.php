<?php

class UserRolesDataSource
{
    public static function allUserRoles(){
        return array(UserRoles::ADMIN, UserRoles::ACCOUNTANT, UserRoles::AUTHOR, UserRoles::CONSULTANT,
            UserRoles::CONTENT_MANAGER,  UserRoles::TEACHER_CONSULTANT, UserRoles::TRAINER, UserRoles::STUDENT,
            UserRoles::TENANT);
    }

    public static function allColleaguesRoles(){
        return array(UserRoles::ADMIN, UserRoles::ACCOUNTANT, UserRoles::AUTHOR, UserRoles::CONSULTANT,
            UserRoles::CONTENT_MANAGER, UserRoles::TEACHER_CONSULTANT, UserRoles::TRAINER, UserRoles::TENANT);
    }

}