<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 12.05.2015
 * Time: 16:26
 */
?>
<div class="border">
    <div class="TeacherProfiletitles">
        <?php echo Yii::t('teacher', '0181'); ?>
        <b>
            <?php echo Teacher::getTeacherLastName($model->teacher_id).' '.
                Teacher::getTeacherFirstName($model->teacher_id)." ".
                Teacher::getTeacherMiddleName($model->teacher_id);?>
        </b>
    </div>
</div>
<div class="TeacherProfiletitles"><?php echo Yii::t('teacher', '0182'); ?></div>
<div class="border">
    <div>
        <?php
        echo Yii::t('teacher', '0183').$model->rate_knowledge.'    ';
        echo Yii::t('teacher', '0184').$model->rate_efficiency.'    ';
        echo Yii::t('teacher', '0185').$model->rate_relations.'    ';
        ?>
    </div>
</div>