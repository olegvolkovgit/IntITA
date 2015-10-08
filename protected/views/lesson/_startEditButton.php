<?php
 if(isset($_GET['editPage'])) $page=$_GET['editPage'];
else $page=0;

?>
<div onclick="enableLessonEdit(1, <?php echo (isset($_GET['idCourse']))?$_GET['idCourse']:'0';?>);">
    <div>
        <img style="margin-left: 5px" src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'edt_30px.png'); ?>"
             id="editIco<?php echo $block;?>" class="editButton" title="Список сторінок заняття"/>
    </div>
</div>
<div onclick="enableLessonPreview(<?php echo $_GET['id'];?>, <?php echo(isset($_GET['idCourse']))?$_GET['idCourse']:'0';?>,<?php echo $page;?>);">
    <div>
        <img src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'view.png'); ?>"
             id="viewIco<?php echo $block;?>" class="editButton" title="Перегляд"/>
    </div>
</div>
<br>
