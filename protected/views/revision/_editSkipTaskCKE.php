<?php
/**
 * @var $pageId integer
 */ ?>
<div ng-init='idPage=<?php echo $pageId; ?>;
idBlock=<?php echo $idElement; ?>;'>
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
            <input name="idBlock" type="hidden" value="<?php echo $idElement;?>"/>
            <input name="revisionId" type="hidden" value="<?php echo $revisionId;?>"/>
            <input name="pageId" id="pageId" type="hidden" value="<?php echo $pageId;?>"/>
            <input name="idType" type="hidden" value="<?php echo $quizType;?>"/>
        </fieldset>
        <input class="btn btn-default" type="submit" value="<?php echo Yii::t('lecture','0706'); ?>" ng-click="editSkipTaskCKE('<?php echo Yii::app()->createUrl('/revision/editTest'); ?>',
         <?php echo $pageId; ?>,<?php echo $revisionId;?>,<?php echo $quizType;?>)"
               ng-disabled="editSkipTask.$invalid">
        <input class="btn btn-default" type="button" value="<?php echo Yii::t('lecture', '0708'); ?>" ng-click='deleteTest(<?php echo $revisionId;?>,<?php echo $pageId;?>,<?php echo $idElement;?>)'>
    </form>
    <br>
</div>
