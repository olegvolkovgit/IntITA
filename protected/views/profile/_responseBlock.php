<?php
/* @var $data Response*/
$user=StudentReg::model()->findByPk($data['who']);
?>
<div class="TeacherProfiletitles">
    <?php echo $user->firstName." ".$user->secondName; ?>
</div>
<div class="sm">
    <?php
    $num = $data['who_ip'];
    echo $data['date']." IP:".CommonHelper::getHideIp($data['who_ip']);
?>
</div>

<div class="txtMsg"><?php echo $data['text'];?></div>
<div class="border">
    <div class="TeacherProfiletitles">
        <?php
        if ($data['rate']!==Null){
            echo Yii::t('teacher', '0186');
            echo CommonHelper::getRating($data['rate']);
        }
        ?>
    </div>
</div>