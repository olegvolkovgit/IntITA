<?php
/**
 * @var $data Response
 */
$id = $data->getTeacherId();
if(Teacher::model()->exists('user_id=:ID', array(':ID'=>$id)))
    $teacher = Teacher::model()->find('user_id=:ID', array(':ID'=>$id));
else return;
?>
<div class="mymark">
    <a class="teachername" href="<?php echo Yii::app()->createUrl('profile/index', array('idTeacher' => $teacher->user_id));?>"><?php echo $teacher->firstName().' '.$teacher->lastName();?></a>
    <div class="stars">
    <?php echo CommonHelper::getRating($data['rate']); ?>
    </div>
</div>