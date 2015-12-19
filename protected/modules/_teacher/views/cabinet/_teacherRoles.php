<?php
/*@var $teacher Teacher*/
/* @var $role Roles*/
/* @var $this CabinetController*/

$roles = $model->roles();
foreach ($roles as $role) {
    $this->renderSidebarByRole($role);
}
?>

