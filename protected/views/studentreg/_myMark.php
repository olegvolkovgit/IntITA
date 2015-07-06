<?php
$teacher=Teacher::model()->find('user_id=:ID', array(':ID'=>$data['about']));
?>
<div class="mymark">
    <a class="teachername" href="<?php echo Yii::app()->createUrl('profile/index', array('idTeacher' => $teacher->teacher_id));?>"><?php echo $teacher->first_name.' '.$teacher->last_name;?></a>
    <div class="stars">
    <?php
    $rate = $data['rate'];
    for ($i = 0; $i < $rate; $i++) {
        ?><span class="courseLevelImage">
        <img src="<?php echo StaticFilesHelper::createPath('image', 'common', 'starFull.png');?>">
        </span><?php
    }
    for ($i = $rate; $i < 10; $i++) {
        ?><span class="courseLevelImage">
        <img src="<?php echo StaticFilesHelper::createPath('image', 'common', 'starEmpty.png');?>">
        </span><?php
    }
    ?>
    </div>
</div>