<?php
/**
 * @var $lang string
 */
?>
<div class="panel panel-default">
    <div class="panel-body">
        <div class="row" style="padding:5px">
            <ul class="list-inline">
                <li>
                    <a type="button" class="btn btn-primary" ng-href="#/auditor/updateOfferTemplate/<?php echo $lang ?>">
                        Редагувати текст оферти
                    </a>
                </li>
            </ul>
            <pre class="offer">
            <?= file_get_contents(Config::getBaseUrl() . '/files/offers/offer_' . $lang . '.html'); ?>
            </pre>
        </div>
    </div>
</div>


