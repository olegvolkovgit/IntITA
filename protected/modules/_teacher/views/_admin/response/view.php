<?php
/* @var $this ResponseController */
/* @var $model Response */
?>
<link href="<?php echo StaticFilesHelper::fullPathTo('css', '_teacher/graduate.css'); ?>" rel="stylesheet">

<div class="col-md-9">
<ul class="list-inline">
    <li>
        <button type="button" class="btn btn-primary"
                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/response/index'); ?>')">
            Відгуки про викладачів</button>
    </li>
</ul>
<div class="page-header">
<h4>Відгук про викладача #<?php echo $model->id; ?></h4>
</div>
<div class="list-group">
    <ul class="list-group">
        <li class="list-group-item list-group-item-info"><h4 class="list-group-item-heading">Від кого: </h4>
            <?php echo $model->user->getNameOrEmail();?></li>
        <li class="list-group-item"><span class="view-label">Дата :</span> <?php echo $model->date ?></li>
        <li class="list-group-item"><span class="view-label">Відгук :</span> <?php echo $model->text ?></li>
        <li class="list-group-item"><span class="view-label">Оцінка : </span><?php echo $model->rate ?></li>
        <li class="list-group-item"><span class="view-label">Знання : </span><?php echo $model->knowledge ?></li>
        <li class="list-group-item"><span class="view-label">Поведінка : </span><?php echo $model->behavior ?></li>
        <li class="list-group-item"><span class="view-label">Мотивація : </span><?php echo $model->motivation ?></li>
        <li class="list-group-item"><span class="view-label">Перевірено модератором : </span><?php echo $model->is_checked ?></li>
    </ul>
</div>
</div>