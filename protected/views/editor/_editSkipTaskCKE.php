<?php
/**
 * Created by PhpStorm.
 * User: Quicks
 * Date: 26.11.2015
 * Time: 15:24
 */?>
<div id="editSkipTask">
    <form name="editSkipTask" method="post" action="<?php echo Yii::app()->createUrl('skipTask/editSkipTask');?>">
        <fieldset>
            <legend id="label">Редагувати задачу з пропусками:</legend>
Опис* :
            <br>
<textarea ng-cloak ckeditor="editorOptionsTask" name="condition" id="skipTaskCondition" cols="105" rows="10"
          required ng-model="editSkipTaskCond" ng-init="editSkipTaskCond='<?php echo htmlentities($data->getSkipTaskCondition())?>'"></textarea>
<br>
Запитання* :
<br>
            <textarea ng-cloak ckeditor="editorOptionsSkipTask" name="question" class="plainTaskCondition"
                      placeholder="<?php echo Yii::t('lecture','0773');  ?>"
                      required ng-init="editSkipTask='<?php echo htmlentities($data->getSkipTaskSource()); ?>'"
                      ng-model="editSkipTask"></textarea>

<br>
<input name="pageId" id="pageId" type="hidden" value="<?php echo $pageId;?>"/>
<input name="lecture" id="lecture" type="hidden" value="<?php echo $data->id_lecture;?>"/>
<input name="testType" id="testType" type="hidden" value="skipTask"/>
<input name="id_block" id="testType" type="hidden" value="<?php echo $data->id_block ?>"/>
<input name="author" id="author" type="hidden" value="<?php echo TeacherHelper::getTeacherId(Yii::app()->user->getId());?>"/>
<br>
</fieldset>

<br>
<input type="submit" value=<?php echo Yii::t('lecture','0720'); ?>>
</form>
<button onclick='cancelSkipTask()'>Скасувати</button>
<!--    <button onclick=""-->
</div>
