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
                        '<?= Yii::app()->createUrl("/_teacher/_accountant/template/updateOffer"); ?>',
                        '<?= $lang ?>'); return false;">
                        Зберегти
                    </button>
                    <button type="reset" class="btn btn-default"
                            onclick="loadTemplateIndex()">
                        Скасувати
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


