<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 13.08.2015
 * Time: 17:06
 */
?>
<div id="divAddVideo">
    <form name="addVideoForm" id="addVideo" action="<?php echo Yii::app()->createUrl('revision/addVideo'); ?>" method="post">
        <input name="idLecture" value="<?php echo $idLecture; ?>" type="hidden">
        <input name="page" value="<?php echo $pageOrder; ?>" type="hidden">
        <input name="type" value="2" type="hidden">
        <input ng-trim="false" type="url" name="newVideoUrl" id="newVideoUrl" required size="80" placeholder="<?php echo Yii::t('lecture', '0709'); ?>" ng-model="videoUrl"/>
        <br> <br>
        <input id="addVideoButton" onclick="trim()" type="submit" value="<?php echo Yii::t('lecture', '0689'); ?>" ng-disabled=addVideoForm.newVideoUrl.$invalid>
    </form>
    <button onclick='cancelAddVideo()'><?php echo Yii::t('lecture', '0707'); ?></button>
</div>