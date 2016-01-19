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
    <form name="addTaskForm" action="<?php echo Yii::app()->createUrl('task/addTask');?>" method="post" target="_blank">
<!--    <form name="addTaskForm" action="--><?php //echo Yii::app()->createUrl('interpreter/index', array('id'=>$lecture)); ?><!--" method="post" target="_blank">-->
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
            <input name="lectureId" id="lectureId" type="hidden" value="<?php echo $lecture;?>"/>
            <input name="author" id="author" type="hidden" value="<?php echo Teacher::getTeacherId(Yii::app()->user->getId());?>"/>
            <br>
            <br>
            Умова задачі*:<textarea ng-cloak ckeditor="editorOptionsTask" name="condition" id="condition" cols="105" rows="10" required ng-model="addTask"></textarea>
        </fieldset>
        <input type="submit" ng-disabled="addTaskForm.$invalid" value="Додати задачу та перейти до юніттестів" />
    </form>
    <button onclick='cancelTask()'><?php echo Yii::t('lecture', '0707'); ?></button>
</div>

