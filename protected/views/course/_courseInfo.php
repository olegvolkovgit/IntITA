<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 12.05.2015
 * Time: 15:13
 */
?>
<div class="courseInfo">
    <ul>
        <p class="subCourseInfo"><b><?php echo Yii::t('course', '0204'); ?></b></p>
        <?php
        $forWhomArray=explode(";", $model->for_whom);
        for ($k = 0; $k < count($forWhomArray)-1; $k++)
        {
            ?>
            <li><?php echo $forWhomArray[$k].";";?></li>
        <?php
        }
        ?>
    </ul>
    <ul>
        <p class="subCourseInfo"><b><?php echo Yii::t('course', '0205'); ?></b></p>
        <?php
        $whatYouLearnArray=explode(";", $model->what_you_learn);
        for ($l = 0; $l < count($whatYouLearnArray)-1; $l++)
        {
            ?>
            <li><?php echo $whatYouLearnArray[$l].";";?></li>
        <?php
        }
        ?>
    </ul>
    <ul>
        <p class="subCourseInfo"><b><?php echo Yii::t('course', '0206'); ?></b></p>
        <?php
        $whatYouLearnArray=explode(";", $model->what_you_get);
        for ($r = 0; $r < count($whatYouLearnArray)-1; $r++)
        {
            ?>
            <li><?php echo $whatYouLearnArray[$r].";";?></li>
        <?php
        }
        ?>
    </ul>
</div>