<?php
/**
 * Created by PhpStorm.
 * User: Quicks
 * Date: 25.11.2015
 * Time: 17:27
 */
?>



<div id="editSkipTask">
    <form name="editSkipTask" method="post" action="<?php echo Yii::app()->createUrl('skipTask/editSkipTask');?>">
        <fieldset>
            <legend id="label">Редагувати задачу з пропусками:</legend>
            Опис* :
            <br>

            <textarea name="condition" class="plainTaskCondition"  required><?php echo $data->getSkipTaskCondition()?></textarea>
            <br>
            Запитання* :
            <br>
            <textarea name="question" class="plainTaskCondition"  required><?php echo $data->getSkipTaskQuestion()?></textarea>
            <br>
            <input name="pageId" id="pageId" type="hidden" value="<?php echo $pageId;?>"/>
            <input name="lecture" id="lecture" type="hidden" value="<?php echo $data->id_lecture;?>"/>
            <input name="testType" id="testType" type="hidden" value="skipTask"/>
            <input name="id_block" id="testType" type="hidden" value="<?php echo $data->id_block ?>"/>
            <input name="author" id="author" type="hidden" value="<?php echo Teacher::getTeacherId(Yii::app()->user->getId());?>"/>
            <br>
        </fieldset>

    <br>
    <input type="submit" value=<?php echo Yii::t('lecture','0720'); ?>>
    </form>
    <button onclick='cancelSkipTask()'>Скасувати</button>
</div>
