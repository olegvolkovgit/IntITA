<a name="taskForm"></a>
<div id="addSkipTask">
    <form name="addSkipTask">
        <fieldset>
            <legend id="label">Додати нову задачу з пропусками:</legend>
            Опис* :
            <br>
            <textarea ng-cloak ckeditor="editorOptionsTask" name="condition" id="skipTaskCondition" cols="105" rows="10"
                      required ng-model="addSkipTaskCond"></textarea>
            <br>
            Запитання* :
            <br>
            <textarea ng-cloak ckeditor="editorOptionsSkipTask" name="question" id="questionId" cols="105" rows="5"
                      ng-model="addSkipTaskQuest"></textarea>
            <br>
        </fieldset>
        <input type="submit" ng-click="createSkipTaskCKE('<?php echo Yii::app()->createUrl('skipTask/addTask'); ?>',
         <?php echo $pageId;?>, <?php echo Teacher::getTeacherId(Yii::app()->user->getId());?>)"
               ng-disabled="addSkipTask.$invalid" value="Додати задачу з пропусками">
    </form>
    <br>
    <button onclick='cancelSkipTask()'>Скасувати</button>
</div>

