<?php
/**
 * var $teacher Teacher
 */
$user = new StudentReg();
$app = Yii::app();
if($teacher != null){
    ?>
<div class="teacherBlock">
    <div class="photobg">
        <img class="mask" src="<?php echo Config::getBaseUrl(); ?>/images/common/img.png">
        <img class="teacherphoto" src="<?php echo StaticFilesHelper::createPath('image', 'teachers', $teacher->foto_url)?>">
    </div>
    <a href="<?php echo Yii::app()->createUrl('profile/index', array('idTeacher' => $teacher['teacher_id']));?>"><?php echo Yii::t('teachers','0059'); ?>&#187;</a>
        <span>
                <ul>
                    <li> <div class="teacherTitle">
                            <?php echo Yii::t('lecture','0077'); ?></div>
                    </li>
                    <li>
                        <?php echo TeacherHelper::getTeacherLastName($teacher->teacher_id)." ".
        TeacherHelper::getTeacherFirstName($teacher->teacher_id)." ".
        TeacherHelper::getTeacherMiddleName($teacher->teacher_id);?>
                    </li>
                    <li>
                        <?php echo $teacher->email; ?>
                    </li>
                    <li>
                        <?php
                            if($teacher->skype != '') {
                                echo 'skype: ' ?><div id="teacherSkype"><?php echo $teacher->skype;
        ?>
        </div>
    <?php
    }
    ?>
                    </li>
                </ul>
        </span>
    <!--Link to page with consultations-->

        <?php if(AccessHelper::canAddConsultation()){
        ?>
        <div class="calendar">
            <?php
            echo CHtml::link(Yii::t('lecture','0079'),Yii::app()->createUrl('/consultationscalendar/index', array('lectureId'=>$lecture->id, 'idCourse'=>$idCourse))); ?>
        </div>
    <?php
    }
    ?>

    </div>
</div>
<?php }?>