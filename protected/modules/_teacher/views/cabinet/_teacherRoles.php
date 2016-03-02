<?php
/* @var $user RegisteredUser */
/* @var $this CabinetController*/
$roles = Yii::app()->user->model->getRoles();
foreach ($roles as $role) {
    $this->renderSidebarByRole($role);
    }
?>
