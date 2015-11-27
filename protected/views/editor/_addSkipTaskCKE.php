<a name="taskForm"></a>
<div id="addSkipTask">
    <form name="addSkipTask" method="post" action="<?php echo Yii::app()->createUrl('skipTask/addTask'); ?>">
        <fieldset>
            <legend id="label">Додати нову задачу з пропусками:</legend>
            <input name="pageId" type="hidden" value="<?php echo $pageId;?>"/>
            <input name="lecture" type="hidden" value="<?php echo $lecture;?>"/>
            <input name="author" type="hidden" value="<?php echo $author;?>"/>
            Опис* :
            <br>
            <textarea ng-cloak ckeditor="editorOptionsTask" name="condition" id="skipTaskCondition" cols="105" rows="10" required ng-model="addSkipTaskCond"></textarea>
            <br>
            Запитання* :
            <br>
            <textarea ng-cloak ckeditor="editorOptionsSkipTask" name="question" id="questionId" cols="105" rows="5" ng-model="addSkipTaskQuest"></textarea>
            <br>
        </fieldset>
        <input type="submit" ng-disabled="addSkipTask.$invalid" value="Додати задачу з пропусками">
    </form>
    <br>
    <button onclick='cancelSkipTask()'>Скасувати</button>
</div>

