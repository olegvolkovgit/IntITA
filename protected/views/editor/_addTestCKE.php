<?php
/**
 * @var $pageId integer
 */
?>
<a name="testForm"></a>
<div id="addTest">
    <br>
    <form onSubmit="return checkAnswersCKE($('#optionsList input:checkbox:checked'));" name="addTestForm" method="post" action="<?php echo Yii::app()->createUrl('tests/addTest');?>" novalidate>
        <fieldset>
            <?php echo Yii::t('lecture', '0713'); ?>
            <br>
            <textarea ng-cloak ckeditor="editorOptionsTask" name="condition" id="conditionTest" size="80" placeholder="<?php echo Yii::t('lecture', '0714'); ?>" required ng-model="testCondition"></textarea>
            <fieldset>
                <legend id="label1"><?php echo Yii::t('lecture', '0701'); ?></legend>
                <legend style="margin-left: 920px" id="label2"><?php echo Yii::t('lecture', '0704'); ?></legend>
                <ol  class='answerList' id="optionsList" class="inputs">
                    <li ng-repeat="answer in answers track by $index">
                        <textarea ng-cloak class="testVariant" type="text" ckeditor="editorOptionsAnswer" name="option{{$index+1}}" id="option{{$index+1}}" size="80" required ng-model="option" ></textarea>
                        <div class="answerCheck">
                            <div id="answersList" class="answersCheckbox">
                                <div><input type="checkbox" name="answer{{$index+1}}" value="{{$index+1}}"></div>
                            </div>
                        </div>
                    </li>
                </ol>
                <div class="answerAddRemove" ng-click="addAnswer();" id="addOption"><?php echo Yii::t('lecture', '0702'); ?></div>
                <div class="answerAddRemove" ng-click="deleteAnswer();" ><?php echo Yii::t('lecture', '0703'); ?></div>
            </fieldset>
            <br>
            <input name="optionsNum" id="optionsNum" type="hidden" value="1"/>
            <input name="pageId" id="pageId" type="hidden" value="<?php echo $pageId;?>"/>
            <input name="lectureId" id="lectureId" type="hidden" value="<?php echo $lecture;?>"/>
            <input name="testType" id="testType" type="hidden" value="plain"/>
            <input name="author" id="author" type="hidden" value="<?=Yii::app()->user->getId();?>"/>
        </fieldset>
        <br>
        <input type="submit" value="<?php echo Yii::t('lecture', '0697'); ?>" id='addtests' ng-disabled=addTestForm.$invalid>
    </form>
    <button onclick='cancelTest()'><?php echo Yii::t('lecture', '0707'); ?></button>
</div>

