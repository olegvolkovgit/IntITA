<?php
/*
 * @var $pageId integer
 */
?>
<a name="testForm"></a>
<div id="addTest">
    <br>
    <form onSubmit="return checkAnswers($('#answersList input:checkbox:checked'));" name="addTestForm" method="post" action="<?php echo Yii::app()->createUrl('tests/addTest');?>" novalidate>
        <fieldset>
            <?php echo Yii::t('lecture', '0713'); ?>
            <br>
            <input type="text" name="condition" id="conditionTest" size="80" placeholder="<?php echo Yii::t('lecture', '0714'); ?>" required ng-model="testCondition"/>
            <br>
            <br>
            <fieldset>
                <legend id="label1"><?php echo Yii::t('lecture', '0701'); ?></legend>
                <ol  style="display: inline-block" id="optionsList" class="inputs">
                    <li>
                        <input class="testVariant" type="text" name="option1" id="option1" size="80" required/>
                    </li>
                </ol>
                <div style="display: inline-block">
                    <legend id="label2"><?php echo Yii::t('lecture', '0704'); ?>:</legend>
                    <div id="answersList" class="answersCheckbox">
                        <div><input type="checkbox" name="answer1" value="1"></div>
                    </div>
                </div>
                <div class="addTest" id="addOption"><?php echo Yii::t('lecture', '0702'); ?></div>
                <div class="removeTest"><?php echo Yii::t('lecture', '0703'); ?></div>
            </fieldset>
            <br>
            <br>
            <input name="optionsNum" id="optionsNum" type="hidden" value="1"/>
            <input name="pageId" id="pageId" type="hidden" value="<?php echo $pageId;?>"/>
            <input name="lectureId" id="lectureId" type="hidden" value="<?php echo $lecture;?>"/>
            <input name="testType" id="testType" type="hidden" value="plain"/>
            <input name="author" id="author" type="hidden" value="<?=Yii::app()->user->getId();?>"/>
        </fieldset>
        <input type="submit" value="<?php echo Yii::t('lecture', '0697'); ?>" id='addtests' ng-disabled=addTestForm.$invalid>
    </form>
    <button onclick='cancelTest()'><?php echo Yii::t('lecture', '0707'); ?></button>
</div>



