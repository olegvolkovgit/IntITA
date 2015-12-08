<?php
/**
 * Created by PhpStorm.
 * User: Wizlight
 * Date: 04.12.2015
 * Time: 13:44
 */
?>
<div name="lecturePage" ng-controller="lessonPageCtrl">
    <div class="tabsWidget">
        <!--        <div ng-click="getPageData(--><?php //echo $_GET['page']?><!--)">Press</div>-->
        <!--        --><?php //$this->renderPartial('_jsLectureProgress', array('page' => $page, 'finishedLecture' => $finishedLecture, 'passedLecture' => $passedLecture, 'passedPages' => $passedPages, 'user' => $user, 'thisPage' => $thisPage, 'edit' => 0, 'editMode' => $editMode)); ?>

        <!--        --><?php //$lastAccessPage=LectureHelper::lastAccessPage($passedPages) ?>
        <!--        <div-->
        <!--            ng-init='-->
        <!--    finishedLecture="--><?php //echo $finishedLecture; ?><!--";-->
        <!--    lastAccessPage=--><?php //echo $lastAccessPage; ?><!--;'-->
        <!--            >-->
        <!--        </div>-->
        <div class="lessonPart">
            <div class="labelBlock" id="labelBlock">
                <!--                <input ng-model='currentPage' />-->
                <!--                <input ng-model='pageData[currentPage].title' />-->
                <p><?php echo Yii::t('lecture', '0615')." "?>{{pageData[currentPage-1].order}}. {{pageData[currentPage-1].title}}</p>
            </div>
            <div id="tooltip"></div>
        </div>
        <img id="arrowCursor" src="<?php echo StaticFilesHelper::createPath('image', 'common', 'arrow.png') ?>">
        <img id="pointer" src="<?php echo StaticFilesHelper::createPath('image', 'common', 'pointer.png') ?>">

        <div class="lectureProgress">
            <a ng-repeat="page in pageData"
               class="pageTitle"
               ng-class="{pageDone: page.isDone || editMode || isAdmin, pageNoAccess: !(page.isDone || editMode || isAdmin)}"
               ng-attr-id="{{$index+1==(currentPage || lastAccessPage) && 'pagePressed' || undefined }}"
               ui-sref="{{(page.isDone || editMode || isAdmin) ? 'page({page: $index+1})' : '.'}}"
               title="<?php echo Yii::t('lecture', '0615')." {{page.order}}. {{page.title}}" ?>"
               hover-spot="{{$index}}"
                >
                <div ng-class="{spotDone: page.isDone || editMode || isAdmin,
                spotDisabled: !(page.isDone || editMode || isAdmin),
                lastAccessPage: $index==lastAccessPage-1 && !editMode,}">
                </div>
            </a>
            <img ng-if="!editMode" style="margin-left: 10px"
                 ng-src="{{finishedLecture && '<?php echo StaticFilesHelper::createPath('image', 'common', 'medal1.png'); ?>' ||
         '<?php echo StaticFilesHelper::createPath('image', 'common', 'medal0.png'); ?>'}}">
        </div>

        <?php $this->renderPartial('/lesson/_pageTemplate'); ?>
    </div>
</div>
<link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'cjuitabs.css'); ?>"/>