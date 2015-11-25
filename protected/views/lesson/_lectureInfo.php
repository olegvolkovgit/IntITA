<!--<div class="lectureImageMain">-->
<!--    <img src="--><?php //echo StaticFilesHelper::createPath('image', 'lecture', $lecture->image); ?><!--">-->
<!--    --><?php //if (TeacherHelper::isTeacherAuthorModule(Yii::app()->user->getId(),$lecture->idModule)){ ?>
<!--<!--    <div class="imageUpdateForm">-->-->
<!--<!--        -->--><?php ////$form=$this->beginWidget('CActiveForm', array(
////            'id'=>'moduleImage-form',
////            'action'=> Yii::app()->createUrl('lesson/updateLectureImage', array('id'=>$lecture->id)),
////            'htmlOptions'=>array(
////                'class'=>'formatted-form',
////                'enctype'=>'multipart/form-data',
////            ),
////            'enableAjaxValidation'=>false,
////        )); ?>
<!--<!--        <div class="hideInput">-->-->
<!--<!--<!--            -->-->--><?php //////echo $form->fileField($lecture, 'image',array('id'=>'logoLecture', 'onChange'=>'js:getImgName(this.value)')); ?>
<!--<!--<!--            -->-->--><?php //////echo $form->error($lecture,'image'); ?>
<!--<!--        </div>-->-->
<!--        <div>-->
<!--            <a onclick="selectLogo()">-->
<!--                --><?php //echo 'Вибрати';?>
<!--            </a>-->
<!--        </div>-->
<!--        <div id="avatarInfo">--><?php //echo 'Не вибрано';?><!--</div>-->
<!--        <div class="row buttons">-->
<!--            --><?php //echo CHtml::submitButton($lecture->isNewRecord ? Yii::t('coursemanage', '0398') : Yii::t('coursemanage', '0399')); ?>
<!--        </div>-->
<!--        --><?php //$this->endWidget(); ?>
<!--    </div><!-- form -->-->
<!--    --><?php //}?>
<!--</div>-->

<div class="titlesBlock" id="titlesBlock">
    <ul>
    <?php if ($idCourse != 0){?>
            <li>
                <?php echo Yii::t('lecture','0070'); ?>
<span><?php echo $lecture->getCourseInfoById($idCourse)['courseTitle'];?></span>(<?php echo Yii::t('lecture','0071').strtoupper($lecture->getCourseInfoById($idCourse)['courseLang']); ?>)
</li>
            <?php }?>
<li>
    <?php echo Yii::t('lecture','0072'); ?>
    <span><?php echo ModuleHelper::getModuleName($lecture->idModule); ?></span>
</li>
<li><?php echo Yii::t('lecture','0073')." ".$lecture->order.': ';?>
    <?php
    if (TeacherHelper::isTeacherAuthorModule(Yii::app()->user->getId(),$lecture->idModule)){
        $title = LectureHelper::getTypeTitleParam();
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
    <span><?php echo LectureHelper::getLectureTitle($lecture->id); ?></span>
    <?php }
    ?>
</li>
<li><?php echo Yii::t('lecture','0074'); ?>
    <div id="lectionTypeText">
        <?php
        if (TeacherHelper::isTeacherAuthorModule(Yii::app()->user->getId(),$lecture->idModule)){
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
        else echo $lecture-> getTypeInfo()['text'];
        ?>
    </div>
<!--    <div id="lectionTypeImage"><img src="--><?php //echo StaticFilesHelper::createPath('image', 'lecture', $lecture-> getTypeInfo()['image']); ?><!--"></div>-->
</li>
<li><div id="subTitle"><?php echo Yii::t('lecture','0075'); ?></div>
    <div id="lectureTimeText">
        <?php
        if (TeacherHelper::isTeacherAuthorModule(Yii::app()->user->getId(),$lecture->idModule)){
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
    <?php echo '('.$lecture->order.' / '.LectureHelper::getLessonsCount($lecture->idModule).' '.Yii::t('lecture','0574').')'; ?>
</li>
<div id="counter">
    <?php
    for ($i=0; $i<$lecture->order;$i++){ ?>
        <img src="<?php echo StaticFilesHelper::createPath('image', 'common', 'ratIco1.png');?>">
    <?php }
    for ($i=0; $i<LectureHelper::getLessonsCount($lecture->idModule)-$lecture->order;$i++){ ?>
        <img src="<?php echo StaticFilesHelper::createPath('image', 'common', 'ratIco0.png');?>">
    <?php } ?>
    <div id="iconImage">
        <img src="<?php
        if (LectureHelper::isLectureFinished($user, $lecture->id, false))
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