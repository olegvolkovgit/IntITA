<?php
/**
 * @var $params array
 */
$userId = $params[0];
?>
<h4>Вітаємо!</h4>
<span>Ти став випускником.
<br>
<span>Будь-ласка заповни профіль випускника в своєму профілі у вкладці "Твій відгук"</span>
<a href="<?php echo Yii::app()->createUrl('/studentreg/profile', array('idUser' => $userId)); ?>">Профіль</a>