<?php
/**
 * Created by PhpStorm.
 * User: Wizlight
 * Date: 20.11.2015
 * Time: 13:57
 */
?>
<div ng-init='idPage=<?php echo $pageId; ?>;
idBlock=<?php echo $idElement; ?>;'>
</div>
<div class="editTest" ng-controller="testCtrl">
    <br>
    <form name="editTestForm" onSubmit="return checkAnswersCKE($('.answersCheckbox input:checkbox:checked'));" method="post" action="<?php echo Yii::app()->createUrl('/revision/editTest');?>" novalidate>
        <fieldset>
            <legend><?php echo Yii::t('lecture', '0700'); ?></legend>
            <?php echo Yii::t('lecture', '0710'); ?>
            <br>
            <textarea ng-cloak ckeditor="editorOptionsTask" name="condition" placeholder="умова теста" required ng-model="dataTest.condition">
            </textarea>
            <fieldset id="optionsField{{idBlock}}">
                <legend id="label1"><?php echo Yii::t('lecture', '0701').' (поставте галочку навпроти правильної відповіді):'; ?></legend>
                <ol  class='answerList' id="optionsList" class="inputs">
                    <li ng-repeat="answer in dataTest.answers track by $index">
                        <textarea ng-cloak class="testVariant" type="text" ckeditor="editorOptionsAnswer" name="answer{{$index+1}}" id="option{{$index+1}}" size="80" required ng-model="dataTest.answers[$index]" ></textarea>
                        <div class="answerCheck">
                            <div id="answersList" class="answersCheckbox">
                                <div><input type="checkbox" name="is_valid{{$index+1}}" value="1"  ng-checked="{{dataTest.valid[$index]}}" ></div>
                            </div>
                        </div>
                    </li>
                </ol>
                <div class="answerAddRemove" ng-click="editAddAnswer();"><?php echo Yii::t('lecture', '0702'); ?></div>
                <div class="answerAddRemove" ng-click="editDeleteAnswer();"><?php echo Yii::t('lecture', '0703'); ?></div>
            </fieldset>
            <br>
            <input name="optionsNum" id="optionsNum" type="hidden" value="{{dataTest.answers.length}}"/>
            <input name="idBlock" type="hidden" value="{{idBlock}}"/>
            <input name="revisionId" type="hidden" value="<?php echo $revisionId;?>"/>
            <input name="pageId" id="pageId" type="hidden" value="<?php echo $pageId;?>"/>
            <input name="idType" type="hidden" value="<?php echo $quizType;?>"/>
        </fieldset>
        <input class="btn btn-default" type="submit" value="<?php echo Yii::t('lecture', '0706'); ?>" id='addtests{{idBlock}}'  ng-disabled=editTestForm.$invalid>
        <input class="btn btn-default" type="button" value="<?php echo Yii::t('lecture', '0708'); ?>" ng-click='deleteTest(<?php echo $revisionId;?>,<?php echo $pageId;?>,<?php echo $idElement;?>)'>
    </form>
    <br>
</div>

