<?php
/* @var $this ResponseController */
/* @var $model Response */
?>
<link href="<?php echo StaticFilesHelper::fullPathTo('css', '_teacher/graduate.css'); ?>" rel="stylesheet">

<div class="col-md-9">
<ul class="list-inline">
    <li>
        <button type="button" class="btn btn-primary"
                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/response/index'); ?>', 'Відгуки про викладачів')">
            Відгуки про викладачів</button>
    </li>
    <li>
        <button type="button" class="btn btn-primary"
                onclick="load('<?=Yii::app()->createUrl("/_teacher/_admin/response/update", array("id"=>$model->id))?>', 'Редагувати')">
            Редагувати</button>
    </li>
    <li>
        <button type="button" class="btn btn-primary"
                onclick="deleteResponse('<?php echo Yii::app()->createUrl('/_teacher/_admin/response/delete', array('id'=>$model->id)) ?>')">
            Видалити</button>
    </li>
    <li>
        <button type="button" class="btn btn-success"
                onclick="setResponseStatus('<?php echo ($model->isChecked())?Yii::app()->createUrl('/_teacher/_admin/response/unsetPublish', array('id'=>$model->id)):
                    Yii::app()->createUrl('/_teacher/_admin/response/setPublish', array('id'=>$model->id));?>', 'Видалити')">
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