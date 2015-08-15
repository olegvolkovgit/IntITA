<?php

?>
<div onclick="enableLessonEdit(1, <?php echo $_GET['idCourse'];?>);">
    <a>
        <img src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'edt_30px.png'); ?>"
             id="editIco<?php echo $block;?>" class="editButton" title="Список сторінок заняття"/>
    </a>
</div>
<br>