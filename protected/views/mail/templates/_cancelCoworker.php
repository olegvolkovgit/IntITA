<?php
/**
 * @var $params array
 */
$organization = Organization::model()->findByPk($params[0]);
?>
<h4>Повідомлення</h4>
<span>Тобі скасовано права співробітника. <?php if($organization){ echo 'Права діяли в межах організації <em>"'.$organization->name.'"</em>'; } ?></span>
