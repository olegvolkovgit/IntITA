<?php
/**
 * @var $lang string
 */
?>
<div class="panel panel-default" ng-controller="updateOfferTemplate">
    <div class="panel-body">
        <div class="col col-md-10">
            <form role="form">
                <div class="form-group">
                    <textarea class="form-control" id="offerText" rows="30" cols="100" style="resize: none"><?= file_get_contents(Config::getBaseUrl() . '/files/offers/offer_' . $lang . '.html'); ?>
                    </textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" ng-click="editOffer('<?= $lang ?>')">
                        Зберегти
                    </button>
                    <a type="reset" class="btn btn-default" ng-href="#/auditor/offerTemplate">
                        Скасувати
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>


