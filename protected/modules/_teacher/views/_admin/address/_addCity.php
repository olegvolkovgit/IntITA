<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 20.04.2016
 * Time: 19:24
 */?>
<ul class="list-inline">
    <li>
        <button type="button" class="btn btn-primary"
                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/address/index'); ?>',
                    'Країни, міста')">
            Країни, міста
        </button>
    </li>
</ul>
<div class="panel-body">
    <div class="row">
        <div class="formMargin">
            <div class="col-lg-8">
                <form role="form">
                    <div class="form-group">
                        <label>Країна</label>
                        <input id="typeahead" type="text" class="typeahead form-control" name="country"
                               placeholder="виберіть країну"
                               size="90" required>
                        <input type="number" hidden="hidden" id="country" value="0"/>
                    </div>

                    <div class="form-group">
                        <label>Назва українською</label>
                        <input name="titleUa" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Назва російською</label>
                        <input name="titleRu" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Назва англійською</label>
                        <input name="titleEn" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Зберегти</button>
                        <button type="reset" class="btn btn-outline btn-default"
                                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/address/index'); ?>',
                                    'Країни, міста')">Скасувати
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
