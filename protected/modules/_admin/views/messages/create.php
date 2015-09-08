<?php
/* @var $this MessagesController */
/* @var $model Messages */
?>
<a href="<?php echo Yii::app()->createUrl('/_admin');?>">Система управління контентом IntITA - Головна</a>
<br>
<br>
<a href="<?php echo Yii::app()->createUrl('/_admin/messages/index');?>">Інтерфейсні повідомлення</a>

<h1>Додати повідомлення</h1>

<form action="<?php echo Yii::app()->createUrl('/_admin/messages/create');?>" class="formatted-form">
    <label for="category">Категорія повідомлення</label>
    <input type="text" name="category" size="45" required>
    <br>
    <br>
    <label for="translateUa">Переклад українською</label>
    <input type="text" name="translateUa" size="45" required>
    <br>
    <br>
    <label for="translateRu">Переклад російською</label>
    <input type="text" name="translateRu" size="45" required>
    <br>
    <br>
    <label for="translateRu">Переклад англійською</label>
    <input type="text" name="translateRu" size="45" required>
    <br>
    <br>
    <input type="submit" value="Додати повідомлення">
</form>

