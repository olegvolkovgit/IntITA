<?php
/* @var $this MessagesController */
/* @var $model Translate */
?>
<div class="formMargin">
    <div class="col-md-8">
        <form id="translateForm" method="post" name="translate"
              onsubmit="addTranslate('<?php echo Yii::app()->createUrl('/_teacher/_admin/translate/create'); ?>');return false;">
            <div class="form-group">

                <div class="form-group">
                    <label for="id">ID повідомлення *</label>
                    <input type="number" name="id" required min="1" max="2147483647" class="form-control">
                </div>
                <br>
                <br>

                <div class="form-group">
                    <label for="category">Категорія повідомлення *</label>
                    <input type="text" name="category" maxlength="32" required class="form-control">
                </div>
                <br>
                <br>

                <div class="form-group">
                    <label for="translateUa">Переклад українською *</label>
                    <textarea name="translateUa" rows="5" required class="form-control"></textarea>
                </div>
                <br>

                <div class="form-group">
                    <label for="translateRu">Переклад російською *</label>
                    <textarea name="translateRu" rows="5" required class="form-control"></textarea>
                </div>
                <br>

                <div class="form-group">
                    <label for="translateRu">Переклад англійською *</label>
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
</div>

