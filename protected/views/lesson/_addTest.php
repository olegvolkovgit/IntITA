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
    <form name="add-test">
        <fieldset>
            <legend id="label">Додати новий тест:</legend>
            Назва:
            <input type="text" name="name" id="name" size="80" placeholder="назва  теста"/>
            <br>
            <br>
            Питання теста:
            <textarea name="condition" id="condition" cols="105" required form="add-test" rows="10"></textarea>
            <br>
            <br>
            <fieldset>
                <legend id="label1">Варіанти відповіді:</legend>
                1. <input type="text" name="answer" id="answer1" size="80"/>
            </fieldset>
            <br>
            <fieldset>
                <legend id="label2">Правильні відповіді:</legend>
            Правильна(i) відповідь(i):
                <br>
                <input type="checkbox" name="answer1" value="1"> 1 відповідь
            </fieldset>
            <br>
        </fieldset>
    </form>
    <button onclick='createTest()'>Додати тест</button>
    <button onclick='cancelTest()'>Скасувати</button>
</div>

