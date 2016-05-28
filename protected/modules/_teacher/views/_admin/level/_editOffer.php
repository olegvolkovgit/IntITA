<?php
/**
 * @var $lang string
 */
?>
<div class="panel panel-default">
    <div class="panel-body">
        <div class="col col-md-10">
            <form role="form">
                <div class="form-group">
            <textarea class="form-control"
                      id="offerText" rows="30"
                      cols="100"><?= file_get_contents(Config::getBaseUrl() . '/files/offers/offer_' . $lang . '.html'); ?>
                </textarea>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary" onclick="editOffer(
                        '<?= Yii::app()->createUrl("/_teacher/_admin/level/updateOffer"); ?>',
                        '<?= $lang ?>'); return false;">
                        Зберегти
                    </button>
                    <button type="reset" class="btn btn-default"
                            onclick="loadLevelIndex()">
                        Скасувати
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function editOffer(url, lang) {
        $jq.ajax({
            type: "POST",
            url: url,
            data: {
                lang: lang,
                text: $jq("#offerText").val()
            },
            cache: false,
            success: function (response) {
                bootbox.alert(response, loadLevelIndex);
            },
            error: function () {
                bootbox.alert('Договір не вдалося створити. Спробуйте пізніше або зверніться до адміністратора ' +
                    adminEmail);
            }
        });
    }
    function loadLevelIndex(){
        load(basePath + '/_teacher/_admin/level/index', 'Рівні курсів, модулів, оферта')
    }
</script>


