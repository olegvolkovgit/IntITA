<div class="editLecture">
    <?php if ($editMode) { ?>
        <a href="<?=Yii::app()->createUrl("revision/editlecture", array("idLecture" => $lecture->id)); ?>">
            <img style="margin-left: 5px"
                 src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'edt_30px.png'); ?>"
                 id="editIco1" class="editButton" title="<?php echo Yii::t('lecture', '0686') ?>"/>
        </a>
    <?php } ?>
</div>
