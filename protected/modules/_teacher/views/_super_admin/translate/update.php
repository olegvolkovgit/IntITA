<?php
/* @var $this MessagesController */
/* @var $model Translate */
?>
<ul class="list-inline">
    <li>
        <a type="button" class="btn btn-primary" ng-href="#/interfacemessages">
            Інтерфейсні повідомлення</a>
    </li>
    <li>
        <a type="button" class="btn btn-primary" ng-href="#/interfacemessages/view/<?=$model->id_record?>">
            Переглянути</a>
    </li>
</ul>
<div class="updateTranslateForm">
    <?php $this->renderPartial('_form', array('model' => $model)); ?>
</div>

