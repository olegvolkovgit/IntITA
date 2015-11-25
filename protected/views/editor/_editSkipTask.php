<?php
/**
 * Created by PhpStorm.
 * User: Quicks
 * Date: 25.11.2015
 * Time: 17:27
 */
?>
<a name="taskForm"></a>
<div id="addSkipTask">
    <form name="add-skip-task" method="post" action="<?php echo Yii::app()->createUrl('skipTask/editSkipTask');?>">
        <fieldset>
            <legend id="label">Редагувати задачу з пропусками:</legend>
            Опис* :
            <br>
            <textarea name="condition" id="skipTaskCondition" cols="105" form="add-skip-task" rows="10"></textarea>
            <br>
            <input type="hidden" value=<?php echo $task->id?>>
            Запитання* :
            <br>
            <textarea name="question" id="question" cols="105" form="add-skip-task" rows="5"></textarea>
            <br>
        </fieldset>
    </form>
    <br>

        Редагувати задачу з пропусками
    <button onclick='cancelSkipTask()'>Скасувати</button>
</div>
