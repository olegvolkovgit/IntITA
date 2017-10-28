<?php
/**
 * @var $params array
 * @var $agreement UserAgreements
 */
$agreement = $params[0];
?>
Переглянь будь-ласка <strong><a target="_blank" href="<?= Yii::app()->createAbsoluteUrl('cabinet').'#/student/agreement/'.$agreement->id ?>">паперовий договір</a></strong>, який був завтверджений бухгалтером, та підтвердь його якщо ти з ним погоджуєшся.