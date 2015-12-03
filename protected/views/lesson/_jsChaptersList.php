<?php
/**
 * Created by PhpStorm.
 * User: Wizlight
 * Date: 06.09.2015
 * Time: 18:12
 */
?>
<?php if(!isset($editMode)) $editMode=1; ?>
<span class="spoilerLinks" onclick="chapterSpoiler(this);"><span class="spoilerClick" ><span class="spoilerTitle" ><?php echo LectureHelper::getLectureTitle($idLecture); ?></span><div class="spoilerTriangle" id="spoilerTriangle">(<span><?php echo Yii::t('lecture', '0080') ?></span><span id='trg'>&#9660;</span>)</div></span></span>
<div class="spoilerBody" id="spoilerBody">
    <span ng-bind="{{chapters}}"></span>
    <div
        ng-init='
        chapters=<?php echo json_encode($passedPages); ?>;
        editMode="<?php echo $editMode; ?>";
        isAdmin="<?php echo StudentReg::isAdmin(); ?>";'
        >
    </div>
    <p ng-repeat="chapter in chapters">
        <a
            ng-class="{pageAccess: chapter.isDone || editMode || isAdmin}"
            ng-attr-href="{{(chapter.isDone || editMode || isAdmin) && '#/page'+($index+1) || undefined }}"
            >
            <?php echo Yii::t('lecture', '0615').' '?>{{($index+1)+'. '+chapter.title}}
        </a>
    </p>
</div>
<!-- Spoiler -->
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'chaptersSpoiler.js'); ?>"></script>
<!-- Spoiler -->