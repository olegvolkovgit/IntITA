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
        <input name="newVideoUrl" id="newVideoUrl" required onclick='buttonFormulaEnabled()' size="80" placeholder="Посилання youtube"/>
        <br> <br>
        <input id="addVideoButton" type="submit" value="Додати відео">
    </form>
    <button onclick='cancelAddVideo()'>Скасувати</button>
</div>