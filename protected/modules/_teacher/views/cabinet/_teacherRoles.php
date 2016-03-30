<?php
/* @var $user RegisteredUser */
/* @var $this CabinetController*/
$roles = Yii::app()->user->model->getRoles();

if(Yii::app()->user->model->isAuthor()){
    array_push($roles, new UserRoles("author"));
}

foreach ($roles as $role) {
    $this->renderSidebarByRole($role);
    }
?>
