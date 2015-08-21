<?php
 if(isset($_GET['editPage'])) $page=$_GET['editPage'];
else $page=0;
?>
<div onclick="enableLessonEdit(1, <?php echo $_GET['idCourse'];?>);">
    <div>
        <img style="margin-left: 5px" src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'edt_30px.png'); ?>"
             id="editIco<?php echo $block;?>" class="editButton" title="Список сторінок заняття"/>
    </div>
</div>
<div onclick="enableLessonPreview(<?php echo $_GET['id'];?>, <?php echo $_GET['idCourse'];?>,<?php echo $page;?>);">
    <div>
        <img src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'view.png'); ?>"
             id="viewIco<?php echo $block;?>" class="editButton" title="Перегляд"/>
    </div>
</div>
<br>