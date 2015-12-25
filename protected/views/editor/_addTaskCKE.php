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
    <form name="addTaskForm" action="<?php echo Yii::app()->createUrl('interpreter/index', array('id'=>$lecture)); ?>" method="post" target="_blank">
        <fieldset>
            <legend id="label">Додати нову задачу:</legend>
            Мова програмування:<br>
            <select id="programLang" name="lang" placeholder="(Виберіть мову програмування)" >
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
            Умова задачі*:<textarea ng-cloak ckeditor="editorOptionsTask" name="condition" id="condition" cols="105" form="add-task" rows="10" required ng-model="addTask"></textarea>
            <br>
            <br>
            Header*:<textarea name="header" id="header" cols="105" rows="5" required></textarea>
            <br>
            Etalon*:<textarea name="etalon" id="etalon" cols="105" placeholder="Еталонна відповідь" rows="15" required></textarea>
            <br>
            Footer*:<textarea name="taskFooter" id="taskFooter" cols="105" rows="5" required ng-model="footer"></textarea>
            <br>
        </fieldset>
        <input type="submit" ng-disabled="addTaskForm.$invalid" value="Додати задачу" />
    </form>
    <button onclick='cancelTask()'>Скасувати</button>
</div>

