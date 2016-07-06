<?php
/**
 * @var $requests array
 * @var $request IRequest
 */
foreach ($requests as $key=>$request) {
    ?>
    <li>
        <a class='requestList' href="#">
            <div>
                <div href="#" onclick="load('<?= Yii::app()->createUrl("/_teacher/_admin/request/request", array(
                    'message' => $request->getMessageId())) ?>', '<?=$request->title()?>')">
                    <strong><?= $request->sender()->userName()==""?$request->sender()->email:$request->sender()->userName(); ?></strong>
                    <span class="pull-right text-muted"><em><?=$request->title();?></em></span>
                    <?php if ($request->module()){?>
                    <div>Модуль: <em><?= $request->module()->getTitle(); ?></em></div>
                     <?php }?>
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
