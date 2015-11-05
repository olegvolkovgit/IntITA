<?php
/**
 * Created by PhpStorm.
 * User: Wizlight
 * Date: 03.11.2015
 * Time: 14:15
 */
?>
<?php $lastAccessPage=LectureHelper::lastAccessPage($passedPages) ?>
<div class="lessonPart">
    <div class="labelBlock" id="labelBlock">
        <p><?php echo Yii::t('lecture', '0615')." ".$page->page_order . '. ' . $page->page_title; ?></p>
    </div>
    <div id="tooltip"></div>
</div>
<img id="arrowCursor" src="<?php echo StaticFilesHelper::createPath('image', 'common', 'arrow.png') ?>">
<img id="pointer" src="<?php echo StaticFilesHelper::createPath('image', 'common', 'pointer.png') ?>">

<div
    ng-model="spots"
    ng-init='edit=<?php echo $edit; ?>;
spots=<?php echo json_encode($passedPages); ?>;
thisPage=<?php echo $thisPage-1; ?>;
editMode="<?php echo $editMode; ?>";
isAdmin="<?php echo AccessHelper::isAdmin(); ?>";
finishedLecture="<?php echo $finishedLecture; ?>";
lastAccessPage=<?php echo $lastAccessPage; ?>;'
    >
</div>

<div ng-if="edit==0" class="lectureProgress">

    <a ng-repeat="spot in spots"
       class="pageTitle"
       ng-class="{pageDone: spot.isDone || editMode || isAdmin, pageNoAccess: !(spot.isDone || editMode || isAdmin)}"
       ng-attr-id="{{$index==thisPage && 'pagePressed' || undefined }}"
       ng-attr-href="{{(spot.isDone || editMode || isAdmin) && '#/page'+($index+1) || undefined }}"
       title="<?php echo Yii::t('lecture', '0615')." {{spot.order}}. {{spot.title}}" ?>"
       hover-spot
        >
        <div ng-class="{
            spotDone: spot.isDone || editMode || isAdmin,
            spotDisabled: !(spot.isDone || editMode || isAdmin),
            lastAccessPage: $index==lastAccessPage && !editMode,
            }">
        </div>
    </a>
    <img ng-if="!editMode" style="margin-left: 10px"
         ng-src="{{finishedLecture && '<?php echo StaticFilesHelper::createPath('image', 'common', 'medal1.png'); ?>' ||
         '<?php echo StaticFilesHelper::createPath('image', 'common', 'medal0.png'); ?>'}}">
</div>
