<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 13.08.2015
 * Time: 17:06
 */
?>
<div id="divAddVideo">
    <form id="addVideo" action="<?php echo Yii::app()->createUrl('lesson/addVideo'); ?>" method="post">
        <input name="idLecture" value="<?php echo $idLecture; ?>" type="hidden">
        <input name="page" value="<?php echo $pageOrder; ?>" type="hidden">
        <input name="type" value="2" type="hidden">
        <input name="newVideoUrl" id="newVideoUrl" required size="80" placeholder="<?php echo Yii::t('lecture', '0709'); ?>" oninvalid="validateRequired(this,'<?php echo Yii::t('validation', '0773'); ?>')"/>
        <br> <br>
        <input id="addVideoButton" type="submit" value="<?php echo Yii::t('lecture', '0689'); ?>">
    </form>
    <button onclick='cancelAddVideo()'><?php echo Yii::t('lecture', '0707'); ?></button>
</div>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'titleValidation.js'); ?>"></script>