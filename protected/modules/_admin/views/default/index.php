<?php
/* @var $this DefaultController */
echo Yii::app()->config->get('baseUrl');
?>
<h1>Система управління контентом IntITA</h1>

<h2><a href="<?php echo Yii::app()->config->get('baseUrl').'/_admin/graduate/index';?>">Випускники</a></h2>
<h2><a href="<?php echo Yii::app()->config->get('baseUrl').'/_admin/tmanage/index';?>">Викладачі</a></h2>
<h2><a href="<?php echo Yii::app()->config->get('baseUrl').'/_admin/coursemanage/index';?>">Курси</a></h2>
<h2><a href="<?php echo Yii::app()->config->get('baseUrl').'/_admin/permissions/index';?>">Права доступу</a></h2>

<h2><a href="<?php echo Yii::app()->createUrl('/_admin/config/index');?>">Налаштування сайта</a></h2>