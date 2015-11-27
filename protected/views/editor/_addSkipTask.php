<a name="taskForm"></a>
<div id="addSkipTask">
    <form name="add-skip-task">
        <fieldset>
            <legend id="label">Додати нову задачу з пропусками:</legend>
            Опис* :
            <br>
            <textarea name="condition" id="skipTaskCondition" cols="105" form="add-skip-task" rows="10"></textarea>
            <br>
            Запитання* :
            <br>
            <textarea name="question" id="question" cols="105" form="add-skip-task" rows="5"></textarea>
            <br>
        </fieldset>
    </form>
    <br>
    <button onclick="createSkipTask('<?php echo Yii::app()->createUrl('skipTask/addTask'); ?>', <?php echo $pageId;?>)">
        Додати задачу з пропусками</button>
    <button onclick='cancelSkipTask()'>Скасувати</button>
</div>

