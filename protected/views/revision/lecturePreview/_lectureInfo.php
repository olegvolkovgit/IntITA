<?php if($lectureRevision->canEdit()){ ?>
<a href="<?=Yii::app()->createUrl("revision/editLectureRevision", array("idRevision" => $lectureRevision->id_revision)); ?>">
    <img style="margin: 5px"
         src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'edt_30px.png'); ?>"
         id="editIco1" class="editButton" title="<?php echo Yii::t('lecture', '0686') ?>"/>
</a>
<?php } ?>
<label>Властивоті лекції: </label>
<table class="table">
    <tr>
        <td>Модуль:</td>
        <td><?= Module::getModuleName($lectureRevision->id_module).' (id='.$lectureRevision->id_module.')'?></td>
    </tr>
    <tr>
        <td>Номер ревізії:</td>
        <td><?=$lectureRevision->id_revision?></td>
    </tr>
    <tr>
        <td>Назва (укр):</td>
        <td><?=$lectureRevision->properties->title_ua?></td>
    </tr>
    <tr>
        <td>Назва (рос):</td>
        <td><?=$lectureRevision->properties->title_ru?></td>
    </tr>
    <tr>
        <td>Назва (англ):</td>
        <td><?=$lectureRevision->properties->title_en?></td>
    </tr>
    <tr>
        <td>Автор:</td>
        <td><?=StudentReg::getUserNamePayment($lectureRevision->properties->id_user_created).' (id='.$lectureRevision->properties->id_user_created.')'?></td>
    </tr>
    <tr>
        <td>Поточний статус:</td>
        <td><?=$lectureRevision->getStatus()?></td>
    </tr>
</table>
