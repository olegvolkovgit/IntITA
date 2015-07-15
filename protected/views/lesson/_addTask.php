<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 11.07.2015
 * Time: 10:37
 */
?>
<a name="taskForm"></a>
<br>
<br>
<br>
<div id="addTask">
    <br>
    <form name="add-task">
        <fieldset>
            <legend id="label">Додати нову задачу:</legend>
            Мова програмування:<br>
            <select id="programLang" name="lang" placeholder="(Виберіть мову програмування)" form="add-task">
                <option value="c++">С++</option>
                <option value="java">Java</option>
                <option value="js">JavaScript</option>
            </select>
            <br>
            <br>
            Назва:
            <input type="text" name="name" id="name" placeholder="назва задачі"/>
            <br>
            <br>
            Умова задачі:
            <textarea name="condition" id="condition" cols="105" required form="add-task" rows="10">
            </textarea>
            <br>
            <br>
            Header:
            <textarea name="header" id="header" cols="105" required form="add-task" rows="5">
            </textarea>
            <br>
            Etalon:
            <textarea name="etalon" id="etalon" cols="105"
                      placeholder="Еталонна відповідь" required form="add-task" rows="15">
            </textarea>
            <br>
            Footer:
            <textarea name="taskFooter" id="taskFooter" cols="105"
                      placeholder="}}" required form="add-task" rows="5">
            </textarea>
            <br>
        </fieldset>
    </form>
    <button onclick='createTask()'>Додати задачу</button>
</div>

