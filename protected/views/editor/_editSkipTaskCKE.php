<?php
/**
 * @var $pageId integer
 */ ?>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/lesson_edit/controllers/skipTaskCtrl.js'); ?>"></script>
<div ng-init='idBlock=<?php echo $data->id_block; ?>;'>
<div id="editSkipTask">
    <form name="editSkipTask" ng-controller="skipTaskCtrl">
        <fieldset>
            <legend id="label"><?php echo Yii::t('editor','0796'); ?></legend>
            <?php echo Yii::t('editor','0797'); ?>* :
            <br>
<textarea ng-cloak ckeditor="editorOptionsTask" name="condition" required ng-model="dataSkipTask.condition" >
</textarea>
            <br>
            <?php echo Yii::t('editor','0798'); ?>* :
            <br>
            <textarea ng-cloak ckeditor="editorOptionsSkipTask" name="question" class="plainTaskCondition"
                      placeholder="<?php echo Yii::t('lecture', '0773'); ?>"
                      required ng-model="dataSkipTask.source"></textarea>
            <br>
            <input name="pageId" id="pageId" type="hidden" value="<?php echo $pageId; ?>"/>
            <input name="lecture" id="lecture" type="hidden" value="<?php echo $data->id_lecture; ?>"/>
            <input name="testType" id="testType" type="hidden" value="skipTask"/>
            <input name="id_block" id="testType" type="hidden" value="<?php echo $data->id_block ?>"/>
            <input name="author" id="author" type="hidden"
                   value="<?=Yii::app()->user->getId(); ?>"/>
            <br>
        </fieldset>
        <input type="submit" ng-click="editSkipTaskCKE('<?php echo Yii::app()->createUrl('skipTask/editSkipTask'); ?>',
         <?php echo $data->id_block; ?>, <?=Yii::app()->user->getId(); ?>)"
               ng-disabled="addSkipTask.$invalid" value="<?php echo Yii::t('lecture', '0706'); ?>">
    </form>
    <br>
    <button ng-click='unableSkipTask(<?php echo $pageId; ?>)'><?php echo Yii::t('editor','0799'); ?></button>
</div>
