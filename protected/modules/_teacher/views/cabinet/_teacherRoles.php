<?php
/* @var $user RegisteredUser */
/* @var $this CabinetController*/
$roles = Yii::app()->user->roles;
foreach ($roles as $role) {
    $this->renderSidebarByRole($role);
    }
?>
