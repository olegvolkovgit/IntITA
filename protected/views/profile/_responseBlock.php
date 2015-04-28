<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 24.04.2015
 * Time: 23:47
 */
$user=StudentReg::model()->findByPk($model['who']);
?>
<div class="TeacherProfiletitles">
    <?php echo $user->firstName." ".$user->secondName; ?>
</div>
<div class="sm">
    <?php
    $num = $model['who_ip'];
    echo $model['date']." Всего ".$count = Response::model()->count('who_ip = :num', array(':num'=>$num))." отзывов с IP:".Teacher::getHideIp($model['who_ip']);
    ?>
</div>
<div class="txtMsg">
    <?php
    $text=$model['text'];
    $text = str_replace('[b]', '<b>', $text);
    $text = str_replace('[/b]', '</b>', $text);
    $text = str_replace('[u]', '<u>', $text);
    $text = str_replace('[/u]', '</u>', $text);
    $text = str_replace('[i]', '<i>', $text);
    $text = str_replace('[/i]', '</i>', $text);
    $text = str_replace('[code]', '<code>', $text);
    $text = str_replace('[/code]', '</code>', $text);
    echo $text;
//    echo $model['text'];
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