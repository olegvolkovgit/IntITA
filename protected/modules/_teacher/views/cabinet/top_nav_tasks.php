<?php
/**
 * @var $authorRequests array
 * @var $request MessagesAuthorRequest
 */
foreach ($authorRequests as $key=>$request) {
    ?>
    <li>
        <a href="#">
            <div>
                <div href="#" onclick="load('<?= Yii::app()->createUrl("/_teacher/_admin/request/request", array(
                    'message' => $request->id_message, 'module' => $request->id_module)) ?>', 'Запит на редагування модуля')">
                    <strong><?= $request->message0->sender0->userName(); ?></strong>
                    <span class="pull-right text-muted"><em>Запит</em></span>
                    <div>Модуль: <em><?= $request->idModule->getTitle(); ?></em></div>
                </div>
            </div>
        </a>
    </li>
    <li class="divider"></li>
    <?php
    if ($key >= 4) break;
} ?>
<li>
    <a class="text-center" href="#">
        <strong><a href="#" onclick="load('<?=Yii::app()->createUrl("/_teacher/_admin/request/index")?>', 'Запити')">
                Всі запити</a></strong>
        <i class="fa fa-angle-right"></i>
    </a>
</li>
