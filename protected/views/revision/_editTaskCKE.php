<?php
/**
 * Created by PhpStorm.
 * User: Wizlight
 * Date: 12.08.2015
 * Time: 11:36
 */
$revisionTask=RevisionTask::model()->findByAttributes(array('id_lecture_element' => $idElement));
?>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/lesson_edit/controllers/taskCtrl.js'); ?>"></script>
<div ng-init='idPage=<?php echo $pageId; ?>;
idBlock=<?php echo $idElement; ?>;'>
<div class="editTask" ng-controller="taskCtrl">
    <br>
    <form name="addTaskForm" action="<?php echo Yii::app()->createUrl('interpreter/index', array('id'=>$revisionId,'task'=>$revisionTask->id)); ?>" method="post" target="_blank">
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
            <input name="idBlock" type="hidden" value="<?php echo $idElement ?>"/>
            <input name="revisionId" type="hidden" value="<?php echo $revisionId;?>"/>
            <input name="pageId" id="pageId" type="hidden" value="<?php echo $pageId;?>"/>
            <input name="idType" type="hidden" value="<?php echo $quizType;?>"/>
            <br>
            <br>
            Умова задачі*:
            <textarea ng-cloak ckeditor="editorOptionsTask" name="condition" required ng-model="dataTask.condition">
            </textarea>
            <input name="idTaskBlock" type="hidden" value="{{idBlock}}"/>
            <input type="hidden" ng-init="task=<?php echo $revisionTask->id; ?>" ng-model="task" />
            <input type="submit" ng-disabled="addTask.$invalid" value="Створення та редагування юніттестів" />
        </fieldset>
    </form>
    <div class="editTaskButton">
        <button ng-click="editTaskCKE(idBlock,<?php echo $pageId; ?>,<?php echo $revisionId;?>,<?php echo $quizType;?>)">Зберегти зміни умови задачі</button><br>
        <button onclick='cancelTask()'>Скасувати</button><br>
        <button ng-click='deleteTest(<?php echo $revisionId;?>,<?php echo $pageId;?>,<?php echo $idElement;?>)'><?php echo Yii::t('lecture', '0708'); ?></button>
    </div>
</div>
<script>
    var selectLang='<?php echo $revisionTask->language; ?>';
    originLang=selectLang;
    selectedLang=selectLang;
    $("select#programLang option[value="+"'"+ selectLang +"'"+ "]").attr('selected', 'true');
    function langChoose(src)
    {
        selectedLang=src.options[src.selectedIndex].value;
    }
</script>



