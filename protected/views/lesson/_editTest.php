<?php
if ($editMode) {
$answers=TestsHelper::getTestAnswers($idBlock);
$valid=TestsHelper::getTestValid($idBlock);
?>
<div class="editTest">
    <br>
    <form name="add-test" method="post" action="<?php echo Yii::app()->createUrl('/tests/editTest');?>">
        <fieldset>
            Питання теста:
            <br>
            <input type="text" name="condition" id="conditionTest" size="80" placeholder="умова теста" value="<?php echo TestsHelper::getTestCondition($idBlock);?>" required/>
            <br>
            <br>
            <fieldset id="optionsField<?php echo $idBlock?>">
                <legend id="label1">Варіанти відповіді:</legend>
                <ol  id="optionsList" class="inputs">
                    <?php for($i=0;$i<count(TestsHelper::getTestAnswers($idBlock));$i++){?>
                        <li><input class="testVariant" type="text" name="option<?php echo $i+1?>" id="option<?php echo $i+1?>" value="<?php echo $answers[$i]?>" size="80" required></li>
                    <?php } ?>
                </ol>
                <div class="editAddTest">Додати відповідь</div>
                <div class="editRemoveTest">Видалити</div>
            </fieldset>
            <fieldset id="answersField<?php echo $idBlock?>" onclick="editButtonEnabled('<?php echo $idBlock?>');">
                <legend id="label2">Правильні відповіді:</legend>
                <div id="answersList<?php echo $idBlock?>" class="answersCheckbox">
                    <?php for($j=0;$j<count(TestsHelper::getTestAnswers($idBlock));$j++){?>
                        <div><input type="checkbox" name="answer<?php echo $j+1?>" value="<?php echo $j+1?>" <?php echo $valid[$j] ?>><span><?php echo $j+1?> відповідь</span></div>
                    <?php } ?>
                </div>
            </fieldset>
            <br>
            <input type="text" name="optionsNum" class="optionsNum" hidden="hidden" value="<?php echo count(TestsHelper::getTestAnswers($idBlock))?>"/>
            <input type="text" name="idBlock" hidden="hidden" value="<?php echo $idBlock;?>"/>
            <input type="text" name="author" id="author" hidden="hidden" value="<?php echo TeacherHelper::getTeacherId(Yii::app()->user->getId());?>"/>
        </fieldset>
        <input type="submit" value="Зберегти зміни" id='addtests<?php echo $idBlock;?>' onclick="editCheckAnswers($('#answersList<?php echo $idBlock?> input:checkbox:checked'),'<?php echo $idBlock?>');">
    </form>
    <button onclick='cancelTest()'>Скасувати</button>
</div>
<?php }?>



