<?php
/**
 * @var $model StudentReg
 */
?>
<li>
    <a href="#"  onclick="load('<?php echo Yii::app()->createUrl('/_teacher/cabinet/loadPage',
        array('page' => 'consultant'));?>','Консультант')">
        <i class="fa fa-bar-chart-o fa-fw"></i>Консультант<span class="fa arrow"></span></a>
    <ul class="nav nav-second-level">
        <li>
            <a href="#" onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_consultant/consultant/modules',
                array('id' => $model->id)) ?>',
                'Модулі')">
                Модулі
            </a>
        </li>
        <li>
            <a href="#" onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_consultant/consultant/consultations',
                array('id' => $model->id)) ?>',
                'Консультації')">
                Консультації
            </a>
        </li>
    </ul>
</li>