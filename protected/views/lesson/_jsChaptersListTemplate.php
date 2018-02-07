<?php
/**
 * Created by PhpStorm.
 * User: Wizlight
 * Date: 04.12.2015
 * Time: 11:00
 */
?>
<!--<span class="spoilerLinks" onclick="chapterSpoiler(this);"><span class="spoilerClick" ><span class="spoilerTitle" ><?php /*echo Lecture::getLectureTitle($idLecture); */?></span><div class="spoilerTriangle" id="spoilerTriangle">(<span><?php /*echo Yii::t('lecture', '0080') */?></span><span id='trg'>&#9660;</span>)</div></span></span>
<div class="spoilerBody" id="spoilerBody">
    <p ng-repeat="page in pageData">
        <a
            ng-class="{pageAccess: page.isDone || editMode || isAdmin}"
            ui-sref="{{(page.isDone || editMode || isAdmin) ? 'page({page: $index+1})' : '.'}}"
            >
            <?php /*echo Yii::t('lecture', '0615').' '*/?>{{($index+1)+'. '+page.title}}
        </a>
    </p>
</div>
<!-- Spoiler -->
<script src="<?php /*echo StaticFilesHelper::fullPathTo('js', 'chaptersSpoiler.js'); */?>"></script>
<!-- Spoiler -->