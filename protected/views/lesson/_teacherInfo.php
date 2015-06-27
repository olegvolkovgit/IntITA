<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 09.04.2015
 * Time: 15:34
 */
$user = new StudentReg();
$app = Yii::app();
?>
<div class="teacherBlock">
    <div
        style=" background: url(<?php echo StaticFilesHelper::createPath('image', 'teachers', $teacher->foto_url); ?>) no-repeat; background-size: 90px;">
        <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/common/img.png">
    </div>
    <a href="<?php echo Yii::app()->createUrl('profile/index', array('idTeacher' => $teacher->teacher_id));?>"><?php echo Yii::t('teachers','0059'); ?>&#187;</a>
        <span>
                <ul>
                    <li> <div class="teacherTitle">
                            <?php echo Yii::t('lecture','0077'); ?></div>
                    </li>
                    <li>
                        <?php echo $teacher->last_name." ".$teacher->first_name." ".$teacher->middle_name;?>
                    </li>
                    <li>
                        <?php echo $teacher->email; ?>
                    </li>
                    <li>
                        <?php echo $teacher->tel; ?>
                    </li>
                    <li>
                        <?php echo 'skype: '?><div id="teacherSkype"><?php echo $teacher->skype; ?>
                        </div>
                    </li>
                    <!--Календарь консультацій з календарем, часом консультацій і інформаційною формою-->
                    <?php if(AccessHelper::canAddConsultation()){
                        ?>
                    <div class="calendar">
                        <?php
                        echo CHtml::link(Yii::t('lecture','0079'),Yii::app()->createUrl('/consultationscalendar/index', array('lectureId'=>$lecture->id))); ?>
                    </div>
                    <?php
                    }
                    ?>
                </ul>
        </span>
    </div>
</div>



