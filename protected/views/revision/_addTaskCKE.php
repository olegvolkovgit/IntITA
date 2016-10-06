<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 11.07.2015
 * Time: 10:37
 */
?>
<a name="taskForm"></a>
<div id="addTask">
    <br>
    <form name="addTaskForm" action="<?php echo Yii::app()->createUrl('revision/addTest');?>" method="post">
        <fieldset>
            <legend id="label">Додати нову задачу:</legend>
            Мова програмування:<br>
            <select class="form-control" style="width:auto;" id="programLang" name="lang" placeholder="(Виберіть мову програмування)" >
                <option value="c++">С++</option>
                <option value="c#">C#</option>
                <option value="java">Java</option>
                <option value="php">PHP</option>
                <option value="js">JavaScript</option>
            </select>
            <input name="revisionId" type="hidden" value="<?php echo $revisionId;?>"/>
            <input name="pageId" id="pageId" type="hidden" value="<?php echo $pageId;?>"/>
            <input name="idType" type="hidden" value="<?php echo $quizType;?>"/>
            Умова задачі*:<textarea ng-cloak ckeditor="editorOptionsTask" name="condition" id="condition" cols="105" rows="10" required ng-model="addTask"></textarea>
        </fieldset>
        <br>
        <input class="btn btn-default" type="submit" value="Додати задачу" id='addtests' ng-click="quizCheckSaved()" ng-disabled="addTaskForm.$invalid">
        <input class="btn btn-default" type="button" value="<?php echo Yii::t('lecture', '0707'); ?>" ng-click='cancelQuiz()'>
    </form>
</div>

