<?php

?>
<br>
<div onclick="enableLessonEdit(<?php echo $block;?>);">
    <a>
        <img src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'edt_30px.png'); ?>"
             id="editIco<?php echo $block;?>" class="editButton" title="Редагувати заняття"/>
    </a>
</div>
<div onclick="showForm();">
    <a href="#newBlockForm">
        <img src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'add_lesson.png');?>" class="addTextBlock"
             id="addTextBlock<?php echo $block;?>" title="Додати новий блок" onclick="showBlockForm()"/>
    </a>
</div>
<br>