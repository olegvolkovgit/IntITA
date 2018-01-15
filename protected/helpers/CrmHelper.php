<?php

class CrmHelper
{
    static function getUsersCrmTasks($user, $active=false, $role=false)
    {
        $active_user_sql='';
        $role_sql='';
        if($active) $active_user_sql=' and cancelled_date is null';
        if($role) $role_sql=' and role=' . $role;
        $sql_tasks="SELECT DISTINCT `id_task` FROM crm_roles_tasks WHERE id_user=".$user.$active_user_sql.$role_sql;
        $tasks=CrmRolesTasks::model()->findAllBySql($sql_tasks);
        $ids=array();
        foreach($tasks as $task):
            $ids[]=$task->id_task;
        endforeach;

        return $ids;
    }
}