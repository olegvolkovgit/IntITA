<?php

class CrmHelper
{
    static function getUsersCrmTasks($user)
    {
        $sql_tasks="SELECT DISTINCT `id_task` FROM crm_roles_tasks WHERE id_user=".$user;
        $tasks=CrmRolesTasks::model()->findAllBySql($sql_tasks);
        $ids=array();
        foreach($tasks as $task):
            $ids[]=$task->id_task;
        endforeach;

        return $ids;
    }
}