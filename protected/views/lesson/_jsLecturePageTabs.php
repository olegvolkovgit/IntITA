<?php
/**
 * Created by PhpStorm.
 * User: Wizlight
 * Date: 04.12.2015
 * Time: 13:44
 */
?>
<div name="lecturePage" >
    <div class="tabsWidget">
        <div class="lessonPart">
            <div class="labelBlock" id="labelBlock">
                <p><?php echo Yii::t('lecture', '0615')." "?>{{currentPage || lastAccessPage}}. {{pageData[(currentPage || lastAccessPage)-1].title}}</p>
            </div>
            <div id="tooltip"></div>
        </div>
        <img id="arrowCursor" src="<?php echo StaticFilesHelper::createPath('image', 'common', 'arrow.png') ?>">
        <img id="pointer" src="<?php echo StaticFilesHelper::createPath('image', 'common', 'pointer.png') ?>">
        <div class="lectureProgress">
            <a ng-repeat="page in pageData track by $index"
               class="pageTitle"
               ng-class="{pageDone: page.isDone || editMode || isAdmin, pageNoAccess: !(page.isDone || editMode || isAdmin)}"
               ng-attr-id="{{$index+1==(currentPage || lastAccessPage) && 'pagePressed' || undefined }}"
               ui-sref="page({page: $index+1})"
               title="<?php echo Yii::t('lecture', '0615') ?> {{$index+1}}. {{page.title}}"
               hover-spot="{{$index}}"
                >
                <div ng-class="{spotDone: page.isDone || editMode || isAdmin,
                spotDisabled: !(page.isDone || editMode || isAdmin),
                lastAccessPage: $index==lastAccessPage-1 && !(isAdmin || editMode)}">
                </div>
            </a>
            <img ng-if="!editMode" style="margin-left: 10px"
                 ng-src="{{finishedLecture && '<?php echo StaticFilesHelper::createPath('image', 'common', 'medal1.png'); ?>' ||
         '<?php echo StaticFilesHelper::createPath('image', 'common', 'medal0.png'); ?>'}}">
        </div>

        <?php $this->renderPartial('/lesson/_page'); ?>
    </div>
</div>
<link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'cjuitabs.css'); ?>"/>