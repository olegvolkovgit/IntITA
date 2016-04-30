<?php
/**
 * Created by PhpStorm.
 * User: Wizlight
 * Date: 12.08.2015
 * Time: 11:36
 */
?>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/lesson_edit/controllers/taskCtrl.js'); ?>"></script>
<div ng-init='idBlock=<?php echo $idBlock; ?>;'>
<div class="editTask" ng-controller="taskCtrl">
    <br>
    <form name="addTaskForm" action="<?php echo Yii::app()->createUrl('interpreter/index', array('id'=>$lecture,'task'=>Task::getTaskId($idBlock))); ?>" method="post" target="_blank">
        <fieldset>
            <legend id="label">Редагувати:</legend>
            Мова програмування:<br>
            <select id="programLang" name="lang" placeholder="(Виберіть мову програмування)" OnChange='langChoose(this)'>
                <option value="c++">С++</option>
                <option value="c#">C#</option>
                <option value="java">Java</option>
                <option value="php">PHP</option>
                <option value="js">JavaScript</option>
            </select>
            <input name="pageId" id="pageId" type="hidden" value="<?php echo $pageId;?>"/>
            <input name="lectureId" id="lectureId" type="hidden" value="<?php echo $lecture;?>"/>
            <input name="author" id="author" type="hidden" value="<?=Yii::app()->user->getId();?>"/>
            <br>
            <br>
            Умова задачі*:
            <textarea ng-cloak ckeditor="editorOptionsTask" name="condition" required ng-model="dataTask.condition">
            </textarea>
            <input name="idTaskBlock" type="hidden" value="{{idBlock}}"/>
            <input type="hidden" ng-init="task=<?php echo Task::getTaskId($idBlock); ?>" ng-model="task" />
            <input type="submit" ng-disabled="addTask.$invalid" value="Створення та редагування юніттестів" />
        </fieldset>
    </form>
    <div class="editTaskButton">
        <button ng-click="editTaskCKE(idBlock)">Зберегти зміни умови задачі</button><br>
        <button onclick='cancelTask()'>Скасувати</button><br>
        <button onclick='unableTask(<?php echo $pageId;?>)'>Видалити задачу</button>
    </div>
</div>
<script>
    var selectLang='<?php echo Task::getTaskLang($idBlock); ?>';
    originLang=selectLang;
    selectedLang=selectLang;
    $("select#programLang option[value="+"'"+ selectLang +"'"+ "]").attr('selected', 'true');
    function langChoose(src)
    {
        selectedLang=src.options[src.selectedIndex].value;
    }
</script>



