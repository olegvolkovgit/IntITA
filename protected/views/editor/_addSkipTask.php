<a name="taskForm"></a>
<br>
<br>
<br>
<div id="addSkipTask">
    <br>
    <form name="add-skip-task">
        <fieldset>
            <legend id="label">Додати нову задачу з пропусками:</legend>
            Опис:
            <br>
            <textarea name="condition" id="condition" cols="105" form="add-skip-task" rows="10"></textarea>
            <br>
            <br>
            Запитання:<textarea name="question" id="question" cols="105" form="add-skip-task" rows="5"></textarea>
            <br>
        </fieldset>
    </form>
    <button onclick="createSkipTask('<?php echo Config::getInterpreterServer(); ?>')">Додати задачу з пропусками</button>
    <button onclick='cancelSkipTask()'>Скасувати</button>
</div>

