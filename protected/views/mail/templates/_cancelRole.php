<?php
/**
 * @var $params array
 * @var $role string
 */
$role = $params[0];
$organization = Organization::model()->findByPk($params[1]);
?>
<h4>Повідомлення</h4>
<span>Тобі скасовано роль <strong><?=$role;?></strong>. <?php if($organization){ echo 'Роль діяла в межах організації <em>"'.$organization->name.'"</em>'; } ?></span>
