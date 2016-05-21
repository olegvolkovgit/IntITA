<?php
/**
 * @var $model StudentReg
 */
?>
<li>
    <a href="#"  onclick="load('<?php echo Yii::app()->createUrl('/_teacher/cabinet/loadPage',
        array('page' => 'author'));?>','Автор')">
        <i class="fa fa-bar-chart-o fa-fw"></i>Автор<span class="fa arrow"></span></a>
    <ul class="nav nav-second-level">
        <li>
            <a href="#" onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_author/author/modules',
                array('id' => $model->id)) ?>', 'Модулі')">
                Модулі
            </a>
        </li>
    </ul>
</li>