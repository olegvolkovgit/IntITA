<?php
/* @var $this ResponseController */
/* @var $model Response */
?>

<link href="<?php echo StaticFilesHelper::fullPathTo('css', '_teacher/graduate.css'); ?>" rel="stylesheet">

<div class="col-md-9" ng-controller="responseCtrl" id="responseView">
<ul class="list-inline">
    <li>
        <button type="button" class="btn btn-primary" ng-click="changeView('response')">
            Відгуки про викладачів</button>
    </li>
    <li>
        <button type="button" class="btn btn-primary" ng-click="changeView('response/edit/<?= $model->id?>')">
            Редагувати</button>
    </li>
    <li>
        <button type="button" class="btn btn-primary" ng-click="deleteResponse('<?= $model->id ?>')">
            Видалити</button>
    </li>
    <li>
        <button type="button" class="btn btn-success" ng-click="changeResponseStatus('<?= $model->id ?>','<?=($model->isChecked())?"hide":"publish";?>')">
            <?=($model->isChecked())?"Приховати":"Опублікувати";?></button>
    </li>
</ul>
<div class="list-group">
    <ul class="list-group">
        <li class="list-group-item list-group-item-info"><h4 class="list-group-item-heading">Від кого: </h4>
            <?php echo $model->user->getNameOrEmail();?></li>
        <li class="list-group-item"><span class="view-label">Дата :</span> <?php echo $model->date ?></li>
        <li class="list-group-item"><span class="view-label">Відгук :</span> <?php echo $model->text; ?></li>
        <li class="list-group-item"><span class="view-label">Оцінка : </span><?php echo $model->rate ?></li>
        <li class="list-group-item"><span class="view-label">Знання : </span><?php echo $model->knowledge ?></li>
        <li class="list-group-item"><span class="view-label">Поведінка : </span><?php echo $model->behavior ?></li>
        <li class="list-group-item"><span class="view-label">Мотивація : </span><?php echo $model->motivation ?></li>
        <li class="list-group-item"><span class="view-label">Статус : </span><?php echo $model->publishLabel() ?></li>
    </ul>
</div>
</div>