<?php
/* @var $this MessagesController */
/* @var $model Translate */
?>
<link rel="stylesheet" type="text/css" href="<?= StaticFilesHelper::fullPathTo('css', 'formattedFormSimple.css'); ?>"/>
<h3>Додати повідомлення</h3>
<br>
<div class="col-md-4">
    <form method="post" class="formatted-form" name="translate"
          onsubmit="addTranslate('<?php echo Yii::app()->createUrl('/_teacher/_admin/translate/create'); ?>');return false;">
        <div class="form-group">

            <div class="form-group">
                <label for="id">ID повідомлення</label>
                <input type="number" name="id" required  class="form-control">
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
                <input class="btn btn-primary" type="submit" value="Додати повідомлення">
            </div>
        </div>
    </form>

</div>

<script src="<?php echo StaticFilesHelper::fullPathTo('css', '/bower_components/bootstrap/dist/js/bootstrap.min.js');?>"></script>
