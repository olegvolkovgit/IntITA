<?php
/* @var $course Course */
$enabledLessonOrder = Lecture::getLastEnabledLessonOrder($lecture->idModule);
$lecturesCount = $lecture->module->lecturesCount();
?>
<div class="titlesBlock" id="titlesBlock">
    <ul><?php if ($idCourse != 0) {
            $course = Course::model()->findByPk($idCourse); ?>
            <li>
                <?php echo Yii::t('lecture', '0070'); ?>
                <a href="<?php echo Yii::app()->createUrl('course/index', array('id' => $idCourse)) ?>">
                    <?php echo $course->getTitle(); ?>
                </a>(<?php echo Yii::t('lecture', '0071') . strtoupper($course->language); ?>
                )
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
        <li style="margin-bottom: 0"><?php echo Yii::t('lecture', '0074'); ?>
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
        <li ng-if=lecturesData.currentOrder class="lecturesSpots">
            ({{lecturesData.currentOrder}} / {{lecturesData.lectures.length}} <?php echo Yii::t('lecture', '0616'); ?>)
        </li>
        <div id="counter">
            <span ng-repeat="lecture in lecturesData.lectures track by $index">
                <a ng-if=lecture.access
                   ng-attr-href="{{ lecture.order!='<?php echo $lecture->order; ?>' && lecture.link || undefined }}"
                   tooltip-html-unsafe="{{lecture.title}}">
                    <div class="lectureAccess" ng-class="{thisLecture: lecture.order=='<?php echo $lecture->order; ?>'}"></div>
                </a>
                <a ng-if=!lecture.access
                   tooltip-html-unsafe="<span class='titleNoAccessMin'>{{lecture.title}}</span><span class='noAccessMin'> (Заняття недоступне)</span>">
                    <div class="lectureDisabled"></div>
                </a>
            </span>
            <div ng-if=lecturesData.currentOrder id="iconImage">
                <img ng-src="{{moduleFinished}}">
            </div>
        </div>
    </ul>
</div>