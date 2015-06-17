<?php
$this->pageTitle = 'INTITA';
?>
<?php
$this->breadcrumbs=array('Консультація зайнята');
?>
<div class='infoblock' ">
    Вибачте, час даної консультації уже зайнятий. Перейдіть на <?php echo CHtml::link('сторінку',Yii::app()->createUrl('/consultationscalendar/index', array('lectureId'=>$lecture))); ?> консультацій та виберіть інший час.
</div>
