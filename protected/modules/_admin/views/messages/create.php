<?php
/* @var $this MessagesController */
/* @var $model Translate */
?>
<link rel="stylesheet" type="text/css" href="<?= StaticFilesHelper::fullPathTo('css', 'formattedFormSimple.css'); ?>"/>
<br>
<br>
<button type="button" class="btn btn-link">
    <a href="<?php echo Yii::app()->createUrl('/_admin/messages/index'); ?>">Інтерфейсні повідомлення</a>
</button>

<div class="page-header">
    <h1>Додати повідомлення</h1>
</div>
<div class="col-md-4">
    <form method="post" action="<?php echo Yii::app()->createUrl('/_admin/messages/create'); ?>" class="formatted-form">
        <div class="form-group">

            <div class="form-group">
                <label for="id">ID повідомлення</label>
                <input type="text" name="id" required class="form-control">
            </div>
            <br>
            <br>

            <div class="form-group">
                <label for="category">Категорія повідомлення</label>
                <input type="text" name="category" required class="form-control">
            </div>
            <br>
            <br>

            <div class="form-group">
                <label for="translateUa">Переклад українською</label>
                <textarea name="translateUa" rows="5" required class="form-control"></textarea>
            </div>

            <br>

            <div class="form-group">
                <label for="translateRu">Переклад російською</label>
                <textarea name="translateRu" rows="5" required class="form-control"></textarea>
            </div>
            <br>

            <div class="form-group">
                <label for="translateRu">Переклад англійською</label>
                <textarea name="translateEn" rows="5" required class="form-control"></textarea>
            </div>

            <br>

            <div class="form-group">
                <label for="comment">Коментар</label>
                <textarea name="comment" rows="5" class="form-control"></textarea>
            </div>

            <div class="form-group">
                <br>
                <input class="btn btn-default" type="submit" value="Додати повідомлення">
            </div>
        </div>
    </form>

</div>