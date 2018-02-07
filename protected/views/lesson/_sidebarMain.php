<?php
/* @var $course Course */
?>
<div class="titlesBlock" id="titlesBlock">
    <ul><?php if ($idCourse != 0) {
            $course = Course::model()->findByPk($idCourse); ?>
            <li>
                <?php echo Yii::t('lecture', '0070'); ?>
                <a href="<?php echo Yii::app()->createUrl('course/index', array('id' => $idCourse)) ?>">
                    <?php echo $course->getTitle(); ?>
                </a> (<?php echo Yii::t('lecture', '0071') . strtoupper($course->language); ?>)
                <?php $this->renderPartial('_editLecture', array('lecture' => $lecture, 'editMode' => $editMode)); ?>
            </li>
            <li>
                <?php echo Yii::t('lecture', '0072'); ?>
                <a href="<?php echo Yii::app()->createUrl('module/index', array('idModule' => $lecture['idModule'], 'idCourse' => $idCourse)) ?>"><?php echo $lecture->module->getTitle(); ?></a>
            </li>
        <?php } else { ?>
            <li>
                <?php echo Yii::t('lecture', '0072'); ?>
                <a href="<?php echo Yii::app()->createUrl('module/index', array('idModule' => $lecture['idModule'])) ?>"><?php echo $lecture->module->getTitle(); ?></a>
            </li>
        <?php } ?>
        <li ng-if=lecturesData.currentOrder ><?php echo Yii::t('lecture', '0073') ?> {{lecturesData.currentOrder}}:
            <?php
            $this->renderPartial('_jsChaptersListTemplate', array('idLecture' => $lecture->id, 'isFree' => $lecture->isFree, 'passedPages' => $passedPages, 'editMode' => $editMode, 'idCourse' => $idCourse));
            ?>
        </li>
        <li class="lectureType"><?php echo Yii::t('lecture', '0074'); ?>
            <div id="lectionTypeText"><?php
                $titleParam = 'title_'.CommonHelper::getLanguage();
                echo $lecture->type->$titleParam; ?></div>
            <div id="lectionTypeImage"><img
                    src="<?php echo StaticFilesHelper::createPath('image', 'lecture', $lecture->type->image); ?>">
            </div>
        </li>
        <li>
            <div id="subTitle"><?php echo Yii::t('lecture', '0075'); ?></div>
            <div id="lectureTimeText"><?php echo $lecture->durationInMinutes . Yii::t('lecture', '0076'); ?></div>
            <div id="lectureTimeImage">
                <img src="<?php echo StaticFilesHelper::createPath('image', 'lecture', 'timeIco.png'); ?>">
            </div>
        </li>
    </ul>
</div>