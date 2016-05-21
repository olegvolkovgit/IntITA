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
    <form name="addTaskForm" action="<?php echo Yii::app()->createUrl('task/addTask');?>" method="post">
        <fieldset>
            <legend id="label">Додати нову задачу:</legend>
            Мова програмування:<br>
            <select id="programLang" name="lang" placeholder="(Виберіть мову програмування)" >
                <option value="c++">С++</option>
                <option value="c#">C#</option>
                <option value="java">Java</option>
                <option value="php">PHP</option>
                <option value="js">JavaScript</option>
            </select>
<!--            Назва:-->
<!--            <input type="text" name="name" id="name" placeholder="назва задачі"/>-->
            <input name="pageId" id="pageId" type="hidden" value="<?php echo $pageId;?>"/>
            <input name="lectureId" id="lectureId" type="hidden" value="<?php echo $lecture;?>"/>
            <input name="author" id="author" type="hidden" value="<?=Yii::app()->user->getId();?>"/>
            <br>
            <br>
            Умова задачі*:<textarea ng-cloak ckeditor="editorOptionsTask" name="condition" id="condition" cols="105" rows="10" required ng-model="addTask"></textarea>
        </fieldset>
        <input type="submit" ng-disabled="addTaskForm.$invalid" value="Додати задачу" />
    </form>
    <button onclick='cancelTask()'><?php echo Yii::t('lecture', '0707'); ?></button>
</div>

