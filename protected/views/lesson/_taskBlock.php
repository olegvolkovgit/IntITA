<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 14.04.2015
 * Time: 18:43
 */
?>
<div class="lessonTask">
    <img class="lessonBut" src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/lessButton.png">
    <div class="lessonButName" unselectable = "on"><?php echo Yii::t('lecture','0086'); ?> 1</div>
    <div class="lessonLine"></div>
    <div class="lessonBG">
        <div class="instrTaskImg">
            <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/task.png">
        </div>
        <div class="instrTaskText">
            <ol>
                <?php echo $data;?>
            </ol>
            <div class="BBCode">
                <form action="" method="post">
                    <textarea class="editor"></textarea>
                    <input onclick="$(&quot;#mydialog&quot;).dialog(&quot;open&quot;); return false;" href="#" id="lessonTask2" type="submit" value="<?php echo Yii::t('lecture','0089'); ?>">
                </form>
            </div>
        </div>
    </div>
</div>
