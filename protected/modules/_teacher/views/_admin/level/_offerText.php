<?php
/**
 * @var $lang string
 */
?>
<div class="panel panel-default">
    <div class="panel-body">
        <div class="col col-md-9">
            <div class="row">
                <ul class="list-inline">
                    <li>
                        <button type="button" class="btn btn-primary"
                                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/level/editOffer', array(
                                    'lang' => $lang
                                )); ?>',
                                    '<?= "Редагувати текст оферти (" . $lang . ")" ?>')">
                            Редагувати текст оферти
                        </button>
                    </li>
                </ul>
                <pre>
                <?= file_get_contents(Config::getBaseUrl() . '/files/offers/offer_' . $lang . '.html'); ?>
                    </pre>
            </div>
        </div>
    </div>
</div>


