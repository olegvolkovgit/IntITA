<?php
/**
 * @var $params array
 * @var $role string
 */

?>
<h4>Вітаємо!</h4>
<span>Вам створена корпоративна адреса електронної пошти <strong><?=$mail;?></strong>.</span>
<br>
<span>Активувати її за адресою</span>
<a href="<?=Yii::app()->createAbsoluteUrl('/profile/activateMail');?>">Активувати</a>
