<?php
/* @var $course Course*/
?>
<div class="titlesBlock" id="titlesBlock">
    <ul>
    <?php if ($idCourse != 0){
        $course  =Course::model()->findByPk($idCourse);
        ?>
            <li>
                <?php echo Yii::t('lecture','0070'); ?>
<span><?php echo $course->getTitle();?></span>(<?php echo Yii::t('lecture','0071').strtoupper($course->language); ?>)
</li>
            <?php }?>
<li>
    <?php echo Yii::t('lecture','0072'); ?>
    <span><?php echo Module::getModuleName($lecture->idModule); ?></span>
</li>
<li><?php echo Yii::t('lecture','0073')." ".$lecture->order.': ';?>
    <?php
    if (Teacher::isTeacherAuthorModule(Yii::app()->user->getId(),$lecture->idModule)){
        $title = Lecture::getTypeTitleParam();
        $this->widget('editable.EditableField', array(
            'type'      => 'text',
            'model'     => $lecture,
            'attribute' => $title,
            'emptytext' => Yii::t('config','0575'),
            'url'       => $this->createUrl('lesson/updateLectureAttribute'),
            'title'     => Yii::t('lecture','0567'),
            'placement' => 'right',
        ));
    }
    else  {?>
    <span><?php echo Lecture::getLectureTitle($lecture->id); ?></span>
    <?php }
    ?>
</li>
<li><?php echo Yii::t('lecture','0074'); ?>
    <div id="lectionTypeText">
        <?php
        if (Teacher::isTeacherAuthorModule(Yii::app()->user->getId(),$lecture->idModule)){
            $this->widget('editable.EditableField', array(
                'type'      => 'select',
                'model'     => $lecture,
                'attribute' => 'idType',
                'title'     => Yii::t('lecture','0572'),
                'url'       => $this->createUrl('lesson/updateLectureAttribute'),
                'source'    => Editable::source(array('1'=> Yii::t('lecture','0568'), '2' => Yii::t('lecture','0569'),'3' => Yii::t('lecture','0570'), '4' => Yii::t('lecture','0571'))),
                'placement' => 'right',
            ));
        }
        else {
            $titleParam = 'title_'.CommonHelper::getLanguage();
            echo $lecture->idType0->$titleParam;
        }
        ?>
    </div>
</li>
<li><div id="subTitle"><?php echo Yii::t('lecture','0075'); ?></div>
    <div id="lectureTimeText">
        <?php
        if (Teacher::isTeacherAuthorModule(Yii::app()->user->getId(),$lecture->idModule)){
            $this->widget('editable.EditableField', array(
                'type'      => 'text',
                'model'     => $lecture,
                'attribute' => 'durationInMinutes',
                'emptytext' => Yii::t('config','0575'),
                'url'       => $this->createUrl('lesson/updateLectureAttribute'),
                'title'     => Yii::t('lecture','0573'),
                'placement' => 'right',
            ));
            echo ' '.Yii::t('lecture','0076');
        }
        else echo $lecture->durationInMinutes.' '.Yii::t('lecture','0076'); ?>
    </div>
    <div id="lectureTimeImage"><img src="<?php echo StaticFilesHelper::createPath('image', 'lecture', 'timeIco.png'); ?>"></div>
</li>
<br>
<li>
    <?php echo '('.$lecture->order.' / '.Module::getLessonsCount($lecture->idModule).' '.Yii::t('lecture','0574').')'; ?>
</li>
<div id="counter">
    <?php
    for ($i=0; $i<$lecture->order;$i++){ ?>
        <img src="<?php echo StaticFilesHelper::createPath('image', 'common', 'ratIco1.png');?>">
    <?php }
    for ($i=0; $i<Module::getLessonsCount($lecture->idModule)-$lecture->order;$i++){ ?>
        <img src="<?php echo StaticFilesHelper::createPath('image', 'common', 'ratIco0.png');?>">
    <?php } ?>
    <div id="iconImage">
        <img src="<?php
        if ($lecture->isFinished($user))
        {
            echo StaticFilesHelper::createPath('image', 'lecture', 'medalIco.png');
        } else {
            echo StaticFilesHelper::createPath('image', 'lecture', 'medalIcoFalse.png');
        }
        ?> ">
    </div>
</div>
</ul>

</div>