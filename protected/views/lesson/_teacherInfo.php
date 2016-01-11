<?php
/**@var $teacher Teacher */
$user = new StudentReg();
$app = Yii::app();
if ($teacher != null) {
    ?>
<div class="teacherBlock">
    <div class="photobg">
        <img class="mask" src="<?php echo StaticFilesHelper::createPath('image', 'common', 'img.png'); ?>">
        <img class="teacherphoto" src="<?php echo StaticFilesHelper::createPath('image', 'teachers', $teacher->foto_url) ?>">
    </div>
    <a href="<?php echo Yii::app()->createUrl('profile/index', array('idTeacher' => $teacher['teacher_id'])); ?>">
    <?php echo Yii::t('teachers', '0059'); ?>&#187;</a>
        <span>
                <ul>
                    <li> <div class="teacherTitle">
                            <?php echo Yii::t('lecture', '0077'); ?></div>
                    </li>
                    <li>
                        <?php echo $teacher->lastName(). " " .$teacher->firstName(). " " .$teacher->middleName(); ?>
                    </li>
                    <li>
                        <?php echo $teacher->email; ?>
                    </li>
                    <li>
                        <?php if ($teacher->skype != '') {
                            echo 'skype: ' ?>
                            <div id="teacherSkype"><?php echo $teacher->skype;
                            ?>
                             </div>
                         <?php
                         }
                         ?>
                    </li>
                </ul>
        </span>
    <!--Link to page with consultations-->

        <?php if ($user->isStudent()) {
        ?>
        <div class="calendar">
            <?php
            echo CHtml::link(Yii::t('lecture', '0079'), Yii::app()->createUrl('/consultationscalendar/index',
                array('lectureId' => $lecture->id, 'idCourse' => $idCourse))); ?>
        </div>
    <?php
    }
    ?>
</div>
<?php } ?>