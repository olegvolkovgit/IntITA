<?php
/**
 * @var $model Teacher
 */
?>
<div class="border">
    <div class="TeacherProfiletitles">
        <?php echo Yii::t('teacher', '0181'); ?>
        <b>
            <?php echo $model->lastName().' '.$model->firstName()." ".$model->middleName();?>
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