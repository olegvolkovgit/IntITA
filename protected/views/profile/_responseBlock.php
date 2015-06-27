<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 24.04.2015
 * Time: 23:47
 */
$teacherRat=Response::model()->find('who=:whoID and about=:aboutID', array(':whoID'=>$data['who'],':aboutID'=>$teacher->user_id));
$user=StudentReg::model()->findByPk($data['who']);
if($teacherRat){
    $rat= $teacherRat->rate;
} else{
    $rat= Null;
}
?>
<div class="TeacherProfiletitles">
    <?php echo $user->firstName." ".$user->secondName; ?>
</div>
<div class="sm">
    <?php
    $num = $data['who_ip'];
    echo $data['date']." IP:".Teacher::getHideIp($data['who_ip']);
?>
</div>

<div class="txtMsg"><?php echo $data['text'];?></div>
<div class="border">
    <div class="TeacherProfiletitles">
        <?php
        if ($rat!==Null){
        echo Yii::t('teacher', '0186');

        for ($k = 1; $k <= $rat; $k++) {
            ?>
            <img src="<?php echo StaticFilesHelper::createPath('image', 'common', 'starFull.png');?>"/>
        <?php
        }
        for($j = $rat+1; $j <= 10; $j++){?>
            <img src="<?php echo StaticFilesHelper::createPath('image', 'common', 'starEmpty.png');?>"/>
        <?php
        }
        }
        ?>
    </div>
</div>