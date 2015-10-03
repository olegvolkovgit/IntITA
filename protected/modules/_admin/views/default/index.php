<?php
/* @var $this DefaultController */
?>
<h1>Система управління контентом IntITA</h1>

<h2>Дизайн</h2>
<ul>
    <li><a href="<?php echo Yii::app()->createUrl('/_admin/messages/index');?>">Інтерфейсні повідомлення</a></li>
    <li><a href="<?php echo Yii::app()->createUrl('/_admin/carousel/index');?>">Слайдер на головній сторінці</a></li>
    <li><a href="<?php echo Yii::app()->createUrl('/_admin/aboutusSlider/index');?>">Слайдер на сторінці <i>Про нас</i></a></li>
</ul>

<h2>Контент</h2>
<ul>
    <li><a href="<?php echo Yii::app()->createUrl('/_admin/graduate/index');?>">Випускники</a></li>
    <li><a href="<?php echo Yii::app()->createUrl('/_admin/tmanage/index');?>">Викладачі</a></li>
    <li><a href="<?php echo Yii::app()->createUrl('/_admin/response/index');?>">Відгуки про викладачів</a></li>
    <li><a href="<?php echo Yii::app()->createUrl('/_admin/coursemanage/index');?>">Курси</a></li>
    <li><a href="<?php echo Yii::app()->createUrl('/_admin/module/index');?>">Модулі</a></li>
    <li><a href="<?php echo Yii::app()->createUrl('/_admin/sharelink/index');?>">Ресурси для викладачів</a></li>
</ul>

<h2>Доступ</h2>
<ul>
    <li><a href="<?php echo Yii::app()->createUrl('/_admin/permissions/index');?>">Права доступа</a></li>
    <li><a href="<?php echo Yii::app()->createUrl('/_admin/pay/index');?>">Сплатити курс/модуль</a></li>
</ul>

<h2>Налаштування сайта</h2>
<ul>
    <li><a href="<?php echo Yii::app()->createUrl('/_admin/config/index');?>">Налаштування</a></li>
</ul>