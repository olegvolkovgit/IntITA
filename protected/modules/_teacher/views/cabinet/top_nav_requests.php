<?php
/**
 * @var $requests array
 * @var $request IRequest
 */
foreach ($requests as $key=>$request) {
    ?>
    <li>
        <a class='requestList' href="#/requests/message/<?=$request->getMessageId()?>"">
            <div>
                <div href="#/requests/message/<?=$request->getMessageId()?>">
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
        <strong><a href="#/requests" >
                Всі запити</a></strong>
        <i class="fa fa-angle-right"></i>
    </a>
</li>