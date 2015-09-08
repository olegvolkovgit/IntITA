<?php
/* @var $this MessagesController */
/* @var $model Messages */
?>
<link rel="stylesheet" type="text/css" href="<?php Config::getBaseUrl();?>/css/formattedFormSimple.css"/>
<a href="<?php echo Yii::app()->createUrl('/_admin');?>">Система управління контентом IntITA - Головна</a>
<br>
<br>
<a href="<?php echo Yii::app()->createUrl('/_admin/messages/index');?>">Інтерфейсні повідомлення</a>

<h1>Додати повідомлення</h1>

<form method="post" action="<?php echo Yii::app()->createUrl('/_admin/messages/create');?>" class="formatted-form">
    <label for="category">Категорія повідомлення</label>
    <input type="text" name="category" required>
    <br>
    <br>
    <label for="translateUa">Переклад українською</label>
    <textarea name="translateUa" rows="5" required></textarea>
    <br>
    <label for="translateRu">Переклад російською</label>
    <textarea name="translateRu" rows="5" required></textarea>
    <br>
    <label for="translateRu">Переклад англійською</label>
    <textarea name="translateEn" rows="5" required></textarea>
    <br>
    <label for="comment">Коментар</label>
    <textarea name="comment" rows="5"></textarea>
    <br>
    <input type="submit" value="Додати повідомлення">
</form>

