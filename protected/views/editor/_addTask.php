<?php
/**
 * @var $pageId integer
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
            <input name="pageId" id="pageId" type="hidden" value="<?php echo $pageId;?>"/>
            <br>
            <br>
            <label for="condition">Умова задачі*:</label><textarea name="condition" id="condition" cols="105" form="add-task" rows="10"></textarea>
            <br>
<!--            <br>-->
<!--            Header*:<textarea name="header" id="header" cols="105" form="add-task" rows="5"></textarea>-->
<!--            <br>-->
            <label for="etalon">Etalon*:</label><textarea name="etalon" id="etalon" cols="105" placeholder="Еталонна відповідь" form="add-task" rows="15"></textarea>
<!--            <br>-->
<!--            Footer*:<textarea name="taskFooter" id="taskFooter" cols="105" form="add-task" rows="5"></textarea>-->
            <br>
        </fieldset>
    </form>
    <br>
    <button onclick="createTask('<?php echo Config::getInterpreterServer(); ?>')">Додати задачу</button>
    <button onclick='cancelTask()'><?php echo Yii::t('lecture', '0707'); ?></button>
</div>

