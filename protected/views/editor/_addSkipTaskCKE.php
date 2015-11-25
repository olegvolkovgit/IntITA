<a name="taskForm"></a>
<div id="addSkipTask">
    <form name="addSkipTask">
        <fieldset>
            <legend id="label">Додати нову задачу з пропусками:</legend>
            Опис* :
            <br>
            <textarea ng-cloak ckeditor="editorOptionsTask" name="condition" id="skipTaskCondition" cols="105" form="add-skip-task" rows="10" required ng-model="addSkipTaskCond"></textarea>
            <br>
            Запитання* :
            <br>
            <textarea ng-cloak ckeditor="editorOptionsSkipTask" name="question" id="question" cols="105" form="add-skip-task" rows="5" ng-model="addSkipTaskQuest"></textarea>
            <br>
        </fieldset>
        <button onclick="createSkipTaskCKE('<?php echo Yii::app()->createUrl('skipTask/addTask'); ?>', <?php echo $pageId;?>)" ng-disabled="addSkipTask.$invalid">
            Додати задачу з пропусками</button>
    </form>
    <br>
    <button onclick='cancelSkipTask()'>Скасувати</button>
</div>

