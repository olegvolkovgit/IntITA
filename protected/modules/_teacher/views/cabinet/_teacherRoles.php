<?php
/* @var $teacher Teacher*/
/* @var $role Roles*/
/* @var $this CabinetController*/
?>
    <?php $roles = $teacher->roles();
foreach ($roles as $role) {
    $this->renderSidebarByRole($role);
    }
?>
