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
                <form>
                    <div class="form-group">
                        <label>Назва українською</label>
                        <input name="titleUa" class="form-control" required maxlength="50">
                    </div>

                    <div class="form-group">
                        <label>Назва російською</label>
                        <input name="titleRu" class="form-control" required maxlength="50">
                    </div>

                    <div class="form-group">
                        <label>Назва англійською</label>
                        <input name="titleEn" class="form-control" required maxlength="50">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" onclick="addCountry('<?php echo Yii::app()->createUrl('/_teacher/_admin/address/newCountry')?>');
                            return false;">Зберегти</button>
                        <button type="reset" class="btn btn-outline btn-default" onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/address/index'); ?>',
                            'Країни, міста')">Скасувати
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function addCountry(url){
        titleUa = $jq('[name="titleUa"]').val();
        titleRu = $jq('[name="titleRu"]').val();
        titleEn = $jq('[name="titleEn"]').val();
        $jq.ajax({
            type: "POST",
            url: url,
            data: {
                titleUa: titleUa,
                titleRu: titleRu,
                titleEn: titleEn
            },
            async: true,
            success: function (response) {
                bootbox.alert(response, loadAddressIndex);
            },
            error: function () {
                bootbox.alert("Операцію не вдалося виконати.");
            }
        });
    }
    function loadAddressIndex(){
        load(basePath + '/_teacher/_admin/address/index', 'Країни, міста');
    }
</script>