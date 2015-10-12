<div>
    <div>
        <a href="<?php echo Yii::app()->createURL('lesson/editPage', array('pageId' => $pageId, 'idCourse' => $idCourse));?>">
        <img style="margin-left: 5px" src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'edt_30px.png'); ?>"
             id="editIco1" class="editButton" title="Список сторінок заняття"/>
            </a>
    </div>
</div>
<!--<div>-->
<!--    onclick="enableLessonPreview(--><?php //echo $_GET['id'];?><!--, --><?php //echo(isset($_GET['idCourse']))?$_GET['idCourse']:'0';?><!--,--><?php //echo $page;?><!--);">-->
<!--    <div>-->
<!---->
<!--        <img src="--><?php //echo StaticFilesHelper::createPath('image', 'editor', 'view.png'); ?><!--"-->
<!--             id="viewIco1" class="editButton" title="Перегляд"/>-->
<!---->
<!--    </div>-->
<!--</div>-->
<br>
