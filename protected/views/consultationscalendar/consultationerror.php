<?php
$this->breadcrumbs=array(Yii::t("consultation", "0507"));
?>
<div class='infoblock'>
    <?php echo Yii::t("consultation", "0503").' '.CHtml::link(Yii::t("consultation", "0504"),
            Yii::app()->createUrl('/consultationscalendar/index', array('lectureId'=>$lecture, 'idCourse'=>$idCourse))).
        ' '.Yii::t("consultation", "0505")?>
</div>
