<?php
if(Teacher::model()->exists('user_id=:ID', array(':ID'=>ResponseHelper::getTeacherId($data['id']))))
    $teacher = Teacher::model()->find('user_id=:ID', array(':ID'=>ResponseHelper::getTeacherId($data['id'])));
else return;
?>
<div class="mymark">
    <a class="teachername" href="<?php echo Yii::app()->createUrl('profile/index', array('idTeacher' => $teacher->teacher_id));?>"><?php echo $teacher->first_name.' '.$teacher->last_name;?></a>
    <div class="stars">
    <?php echo RatingHelper::getRating($data['rate']); ?>
    </div>
</div>