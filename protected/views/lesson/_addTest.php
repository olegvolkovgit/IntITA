<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 16.07.2015
 * Time: 16:59
 */
?>
<a name="testForm"></a>
<script type="text/javascript">
//    document.getElementById("optionsNum").value = 1;
//    document.getElementById("option1").value = '';
</script>
<div id="addTest">
    <br>
    <form name="add-test" method="post" action="<?php echo Yii::app()->createUrl('/tests/addTest');?>">
        <fieldset>
            Питання теста:
            <br>
            <input type="text" name="condition" id="conditionTest" size="80" placeholder="умова теста" required/>
            <br>
            <br>
            <fieldset>
                <legend id="label1">Варіанти відповіді:</legend>
                <ol  id="optionsList" class="inputs">
                    <li>
                        <input class="testVariant" type="text" name="option1" id="option1" size="80" required/>
                    </li>
                </ol>
                <div class="addTest" id="addOption">Додати відповідь</div>
                <div class="removeTest">Видалити</div>
            </fieldset>
            <br>
            <fieldset onclick="buttonEnabled();">
                <legend id="label2">Правильні відповіді:</legend>
                <div id="answersList" class="answersCheckbox">
                <div><input type="checkbox" name="answer1" value="1"><span>1 відповідь</span></div>
                </div>
            </fieldset>
            <br>
            <input type="text" name="optionsNum" id="optionsNum" hidden="hidden" value="1"/>
            <input type="text" name="lectureId" id="lectureId" hidden="hidden" value="<?php echo $lecture;?>"/>
            <input type="text" name="testType" id="testType" hidden="hidden" value="plain"/>
            <input type="text" name="author" id="author" hidden="hidden" value="<?php echo TeacherHelper::getTeacherId(Yii::app()->user->getId());?>"/>
        </fieldset>
        <input type="submit" value="Додати тест" id='addtests' onclick="checkAnswers($('#answersList input:checkbox:checked'));">
    </form>
    <button onclick='cancelTest()'>Скасувати</button>
</div>



