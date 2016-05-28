<div ng-init='idPage=<?php echo $pageId; ?>;
idBlock=<?php echo $idElement; ?>;'>
<div id="editPlainTask" ng-controller="plainTaskCtrl">
    <br>
    <form  name="plainTaskEdit" method="post" action="<?php echo Yii::app()->createUrl('/revision/editTest');?>">
        <fieldset>
            <label><?php echo Yii::t('lecture','0774'); ?></label>
            <br>
            <textarea ng-cloak ckeditor="editorOptionsTask" name="condition" class="plainTaskCondition"
                      placeholder="<?php echo Yii::t('lecture','0773');  ?>" required ng-model="dataSkipTask.condition">
            </textarea>
            <input name="idBlock" type="hidden" value="<?php echo $idElement;?>"/>
            <input name="revisionId" type="hidden" value="<?php echo $revisionId;?>"/>
            <input name="pageId" id="pageId" type="hidden" value="<?php echo $pageId;?>"/>
            <input name="idType" type="hidden" value="<?php echo $quizType;?>"/>
            <br>
            <input class="btn btn-default" type="submit" value="<?php echo Yii::t('lecture','0720'); ?>" id='addtests' ng-disabled=plainTaskEdit.$invalid>
            <input class="btn btn-default" type="button" value="<?php echo Yii::t('lecture', '0708'); ?>" ng-click='deleteTest(<?php echo $revisionId;?>,<?php echo $pageId;?>,<?php echo $idElement;?>)'>
        </fieldset>
    </form>
</div>
