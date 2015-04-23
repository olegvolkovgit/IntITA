<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 14.04.2015
 * Time: 18:44
 */

?>
<div class="lessonInstr">
    <img class="lessonBut" src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/lessButton.png">
    <div class="lessonButName" unselectable = "on"><?php echo Yii::t('lecture', '0085'); ?></div>
    <div class="lessonLine"></div>
    <div class="lessonBG">
        <div class="instrTaskImg">
            <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/instr.png">
        </div>
        <div class="instrTaskText">
            <ol>
                <?php echo $data;?>
            </ol>
        </div>
    </div>
</div>