<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 16.07.2015
 * Time: 16:59
 */
?>
<a name="testForm"></a>
<div id="addTest">
    <br>
    <form name="add-test" method="post" action="<?php echo Yii::app()->createUrl('/tests/addTest');?>">
        <fieldset>
            <legend id="label">Додати новий тест:</legend>
            Назва:
            <input type="text" name="testTitle" id="testTitle" size="80" placeholder="назва теста"/>
            <br>
            <br>
            Питання теста:
            <input type="text" name="condition" id="condition" size="80" placeholder="умова теста"/>
            <br>
            <br>
            <fieldset>
                <legend id="label1">Варіанти відповіді:</legend>
                <div  id="optionsList">
                1. <input type="text" name="option1" id="option1" size="80"/><br>
                </div>
                <a href="javascript:addOption()" id="addOption">Додати відповідь</a>
            </fieldset>
            <br>
            <fieldset>
                <legend id="label2">Правильні відповіді:</legend>
                <div id="answersList">
                <input type="checkbox" name="answer1" value="1">1 відповідь</div>
            </fieldset>
            <br>
            <input type="text" name="optionsNum" id="optionsNum" hidden="hidden" value="1"/>
            <input type="text" name="lectureId" id="lectureId" hidden="hidden" value="<?php echo $lecture;?>"/>
            <input type="text" name="author" id="author" hidden="hidden" value="<?php echo $lecture;?>"/>
        </fieldset>
        <input type="submit" value="Додати тест" onclick="clearFields()">
    </form>
    <button onclick='cancelTest()'>Скасувати</button>
</div>

