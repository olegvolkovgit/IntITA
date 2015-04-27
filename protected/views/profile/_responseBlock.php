<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 24.04.2015
 * Time: 23:47
 */

?>
<div class="TeacherProfiletitles">
    <?php echo "Бевз Сергей"; ?>
</div>
<div class="sm">
    <?php
    echo $model['date']." Всего 1 отзывов с IP:37.19.246.39";
    ?>
</div>
<div class="txtMsg">
    <?php
    echo $model['text'];
    ?>
</div>
<div class="border">
    <div class="TeacherProfiletitles">
        <?php
        echo Yii::t('teacher', '0186');

        for ($k = 1; $k <= $model['rate']; $k++) {
            ?>
            <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/starFull.png"/>
        <?php
        }
        for($j = $model['rate']+1; $j <= 10; $j++){?>
            <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/starEmpty.png"/>
        <?php
        }
        ?>
    </div>
</div>