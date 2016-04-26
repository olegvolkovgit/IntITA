<?php
/**
 * Created by PhpStorm.
 * User: Wizlight
 * Date: 04.12.2015
 * Time: 13:44
 */
?>

    <div class="tabsWidget">
        <div class="lessonPart">
            <div class="labelBlock" id="labelBlock">
                <p><?php echo Yii::t('lecture', '0615')." "?>{{currentPage}}. {{lectureData.pages[currentPage-1].title}}</p>
            </div>
            <div id="tooltip"></div>
        </div>
        <img id="arrowCursor" src="<?php echo StaticFilesHelper::createPath('image', 'common', 'arrow.png') ?>">
        <img id="pointer" src="<?php echo StaticFilesHelper::createPath('image', 'common', 'pointer.png') ?>">
        <div class="lectureProgress">
            <a ng-repeat="page in lectureData.pages track by $index" class="pageTitle"
               class="pageDone"
               ng-attr-id="{{$index+1==currentPage && 'pagePressed' || undefined }}"
               ui-sref="page({page: $index+1})"
               title="<?php echo Yii::t('lecture', '0615') ?> {{$index+1}}. {{page.title}}"
               hover-spot="{{$index}}">
                <div class="spotDone"></div>
            </a>
            <div class="editPageIco">
                <img ng-if=lectureData.lecture.canEdit ng-click=editPageRevision(lectureData.pages[currentPage-1].id)
                     src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'edit_revision.png'); ?>"
                     title="<?php echo Yii::t('lecture', '0686') ?>"/>
            </div>
        </div>
        <?php $this->renderPartial('lecturePreview/_page'); ?>
    </div>
<link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'cjuitabs.css'); ?>"/>