<?php
/* @var $this MessagesController */
/* @var $model Translate */
?>
<ul class="list-inline">
    <li>
        <button type="button" class="btn btn-primary" ng-click="changeView('interfacemessages')">
            Інтерфейсні повідомлення</button>
    </li>
    <li>
        <button type="button" class="btn btn-primary" ng-click="changeView('interfacemessages/view/<?=$model->id_record?>')">
            Переглянути</button>
    </li>
</ul>
<div class="updateTranslateForm">
    <?php $this->renderPartial('_form', array('model' => $model)); ?>
</div>

