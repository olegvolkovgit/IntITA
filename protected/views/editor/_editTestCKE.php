<?php
/**
 * Created by PhpStorm.
 * User: Wizlight
 * Date: 20.11.2015
 * Time: 13:57
 */
?>
<?php
$answers=TestsHelper::getTestAnswers($idBlock);
$valid=TestsHelper::getTestValid($idBlock);
?>
<div class="editTest">
    <br>
    <form name="editTestForm" onSubmit="return checkAnswers($('.answersCheckbox input:checkbox:checked'));" method="post" action="<?php echo Yii::app()->createUrl('/tests/editTest');?>" novalidate>
        <fieldset>
            <legend><?php echo Yii::t('lecture', '0700'); ?></legend>
            <?php echo Yii::t('lecture', '0710'); ?>
            <br>
            <textarea ng-cloak ckeditor="editorOptionsTask" name="condition" id="conditionTest" placeholder="умова теста" size="80" required ng-init="testConditionEdit='<?php echo htmlentities(TestsHelper::getTestCondition($idBlock));?>'" ng-model="testConditionEdit"></textarea>
            <br>
            <br>
            <fieldset id="optionsField<?php echo $idBlock?>">
                <legend id="label1"><?php echo Yii::t('lecture', '0701'); ?></legend>
                <ol  style="display: inline-block" id="optionsList" class="inputs">
                    <?php for($i=0;$i<count(TestsHelper::getTestAnswers($idBlock));$i++){?>
                        <li><input class="testVariant" type="text" name="option<?php echo $i+1?>" id="option<?php echo $i+1?>" value="<?php echo $answers[$i]?>" size="80" required></li>
                    <?php } ?>
                </ol>
                <div style="display: inline-block" id="answersField<?php echo $idBlock?>" >
                    <legend id="label2"><?php echo Yii::t('lecture', '0704'); ?></legend>
                    <div id="answersList<?php echo $idBlock?>" class="answersCheckbox">
                        <?php for($j=0;$j<count(TestsHelper::getTestAnswers($idBlock));$j++){?>
                            <div><input type="checkbox" name="answer<?php echo $j+1?>" value="<?php echo $j+1?>" <?php echo $valid[$j] ?>></div>
                        <?php } ?>
                    </div>
                </div>
                <div class="editAddTest"><?php echo Yii::t('lecture', '0702'); ?></div>
                <div class="editRemoveTest"><?php echo Yii::t('lecture', '0703'); ?></div>
            </fieldset>
            <br>
            <input name="optionsNum" class="optionsNum" type="hidden" value="<?php echo count(TestsHelper::getTestAnswers($idBlock))?>"/>
            <input name="idBlock" type="hidden" value="<?php echo $idBlock;?>"/>
            <input name="author" id="author" type="hidden" value="<?php echo TeacherHelper::getTeacherId(Yii::app()->user->getId());?>"/>
        </fieldset>
        <br>
        <input class='buttonForm' type="submit" value="<?php echo Yii::t('lecture', '0706'); ?>" id='addtests<?php echo $idBlock;?>'  ng-disabled=editTestForm.$invalid>
    </form>
    <br>
    <button onclick='cancelTest()'><?php echo Yii::t('lecture', '0707'); ?></button>
    <button onclick='unableTest(<?php echo $pageId;?>)'><?php echo Yii::t('lecture', '0708'); ?></button>
</div>

