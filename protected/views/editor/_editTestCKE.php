<?php
/**
 * Created by PhpStorm.
 * User: Wizlight
 * Date: 20.11.2015
 * Time: 13:57
 */
?>
<?php
$answers=TestsAnswers::getTestAnswers($idBlock);
$valid=TestsAnswers::getTestValidCKE($idBlock);
?>
<div ng-init='editAnswers=<?php echo htmlspecialchars(json_encode($answers)); ?>;
     valid=<?php echo json_encode($valid); ?>;'>
</div>
<div class="editTest">
    <br>
    <form name="editTestForm" onSubmit="return checkAnswersCKE($('.answersCheckbox input:checkbox:checked'));" method="post" action="<?php echo Yii::app()->createUrl('/tests/editTest');?>" novalidate>
        <fieldset>
            <legend><?php echo Yii::t('lecture', '0700'); ?></legend>
            <?php echo Yii::t('lecture', '0710'); ?>
            <br>
            <textarea ng-cloak ckeditor="editorOptionsTask" name="condition" id="conditionTest" placeholder="умова теста"
                      size="80" required ng-init="testConditionEdit='<?php echo htmlentities(Tests::getTestCondition($idBlock));?>'" ng-model="testConditionEdit"></textarea>
            <fieldset id="optionsField<?php echo $idBlock?>">
                <legend id="label1"><?php echo Yii::t('lecture', '0701'); ?></legend>
                <legend style="margin-left: 920px" id="label2"><?php echo Yii::t('lecture', '0704'); ?></legend>
                <ol  class='answerList' id="optionsList" class="inputs">
                    <li ng-repeat="editAnswer in editAnswers track by $index">
                        <textarea ng-cloak class="testVariant" type="text" ckeditor="editorOptionsAnswer" name="option{{$index+1}}" id="option{{$index+1}}" size="80" required ng-model="editAnswers[$index]" ></textarea>
                        <div class="answerCheck">
                            <div id="answersList" class="answersCheckbox">
                                <div><input type="checkbox" name="answer{{$index+1}}" value="{{$index+1}}"  ng-checked="{{valid[$index]}}" ></div>
                            </div>
                        </div>
                    </li>
                </ol>
                <div class="answerAddRemove" ng-click="editAddAnswer();"><?php echo Yii::t('lecture', '0702'); ?></div>
                <div class="answerAddRemove" ng-click="editDeleteAnswer();"><?php echo Yii::t('lecture', '0703'); ?></div>
            </fieldset>
            <br>
            <input name="optionsNum" id="optionsNum" type="hidden" value="<?php echo count(TestsAnswers::getTestAnswers($idBlock))?>"/>
            <input name="idBlock" type="hidden" value="<?php echo $idBlock;?>"/>
            <input name="author" id="author" type="hidden" value="<?php echo Teacher::getTeacherId(Yii::app()->user->getId());?>"/>
        </fieldset>
        <br>
        <input class='buttonForm' type="submit" value="<?php echo Yii::t('lecture', '0706'); ?>" id='addtests<?php echo $idBlock;?>'  ng-disabled=editTestForm.$invalid>
    </form>
    <br>
    <button onclick='cancelTest()'><?php echo Yii::t('lecture', '0707'); ?></button>
    <button onclick='unableTest(<?php echo $pageId;?>)'><?php echo Yii::t('lecture', '0708'); ?></button>
</div>

