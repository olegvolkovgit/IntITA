<?php
/**
 * Created by PhpStorm.
 * User: Wizlight
 * Date: 12.08.2015
 * Time: 11:36
 */
?>
<div class="editTask">
    <br>
    <form name="addTaskForm" action="<?php echo Yii::app()->createUrl('interpreter/index', array('id'=>$lecture)); ?>" method="post" target="_blank">
        <fieldset>
            <legend id="label">Редагувати:</legend>
            Мова програмування:<br>
            <select id="programLang" name="lang" placeholder="(Виберіть мову програмування)" OnChange='langChoose(this)'>
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
            Умова задачі*:<textarea ng-cloak ckeditor="editorOptionsTask" name="condition" id="condition" cols="105" rows="10" ng-init="editTask='<?php echo htmlentities(Task::getTaskCondition($idBlock));?>'" required ng-model="editTask"></textarea>
            <input name="idTaskBlock" type="hidden" value="<?php echo $idBlock;?>"/>
            <input type="submit" ng-disabled="addTask.$invalid" value="Створення та редагування юніттестів" />
        </fieldset>
    </form>
    <div class="editTaskButton">
        <button ng-click="editTaskCKE('<?php echo $idBlock; ?>')">Зберегти зміни умови задачі</button><br>
        <button onclick='cancelTask()'>Скасувати</button><br>
        <button onclick='unableTask(<?php echo $pageId;?>)'>Видалити задачу</button>
    </div>
</div>
<script>
    var selectLang='<?php echo Task::getTaskLang($idBlock); ?>';
    selectedLang=selectLang;
    $("select#programLang option[value="+"'"+ selectLang +"'"+ "]").attr('selected', 'true');
    function langChoose(src)
    {
        selectedLang=src.options[src.selectedIndex].value;
    }
</script>



