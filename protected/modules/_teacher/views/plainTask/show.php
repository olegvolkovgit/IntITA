<?php
/**
 * Created by PhpStorm.
 * User: Quicks
 * Date: 27.11.2015
 * Time: 15:32
 */

?>
<link rel="stylesheet" href="<?php echo Config::getBaseUrl(); ?>/css/_teacher/showPlainTask.css"/>
<div class="fieldsetFormat">
    <br>
    <br>
    <br>
    <form name="plainTaskRate" action="<?php echo Yii::app()->createUrl('_teacher/rate/ratePlainTask');?>" method="post">
        <fieldset >
        <div>
        Відповідь : <?php echo $plainTask->getDescription();?>aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
            aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
            aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
            aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
            aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
            aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
        </div>
            <br>

        Коментар :<br> <textarea name="comment" class="textareaSettings" required="true"></textarea><br>
        Ваша оцінка :<br> <input  name="rate" type="number" required="true" min="1" max="100"><br>
            <br>
        <input type="submit" value="Оцінити">
        </fieldset>
    </form>


</div>

