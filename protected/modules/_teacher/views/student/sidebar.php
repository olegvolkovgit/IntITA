<?php
/**
 * @var $model StudentReg
 */
?>
<li>
    <a href="#"  onclick="load('<?php echo Yii::app()->createUrl('/_teacher/cabinet/loadPage',
        array('page' => 'student'));?>','Студент')">
        <i class="fa fa-bar-chart-o fa-fw"></i>Студент<span class="fa arrow"></span></a>
    <ul class="nav nav-second-level">
        <li>
            <a href="#" onclick="load('<?=Yii::app()->createUrl("/_teacher/_student/student/index",
                array("id" => $model->id) );?>', 'Курси, модулі');">
                Курси / модулі
            </a>
        </li>
        <li>
            <a href="#" onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_student/student/consultations',
                array('id' => $model->id)) ?>',
                'Консультації')">
                Консультації
            </a>
        </li>
        <li id="nav">
            <a href="#"
               onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_student/student/finances',
                   array('id' => $model->id)) ?>',
                   'Фінанси')">
                Фінанси
            </a>
        </li>
    </ul>
</li>