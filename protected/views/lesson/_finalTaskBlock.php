<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 14.04.2015
 * Time: 19:04
 */?>
<img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/borderLesson.png">

<div class="lessonTask">
    <img class="lessonButFinal" src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/lessButtonFinale.png">
    <div class="lessonButFinal" unselectable = "on"><?php echo Yii::t('lecture','0090'); ?></div>
    <div class="lessonLine"></div>
    <div class="lessonBG">
        <div class="instrTaskImg">
            <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/task.png">
        </div>
        <div class="content">
            <div class="instrTaskText" id="<?php echo "t" . $order;?>">
                <ol>
                    <?php echo $data;?>
                </ol>
            </div>
            <div class="BBCode">
                <form action="" method="post">
                    <textarea class="editor"></textarea>
                    <input  href="#" id="lessonTask3" type="submit" value="<?php echo Yii::t('lecture','0089'); ?>">
                </form>
            </div>
        </div>
    </div>
</div>

