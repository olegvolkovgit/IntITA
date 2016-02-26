<?php

class UserRoles extends Enum
{
    const ADMIN = 'admin';
    const STUDENT = 'student';
    const TRAINER = 'trainer';
    const CONSULTANT = 'consultant';
    const ACCOUNTANT = 'accountant';
    const AUTHOR = 'author';

    public static function teachersRolesList(){
        return array(
            UserRoles::TRAINER,
            UserRoles::CONSULTANT,
            UserRoles::AUTHOR
        );
    }
}