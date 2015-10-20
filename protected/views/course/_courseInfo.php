<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 12.05.2015
 * Time: 15:13
 */
$langParam = CourseHelper::getLangParam();
$forWhom = 'for_whom_' . $langParam;
$whatYouLearn = 'what_you_learn_' . $langParam;
$whatYouGet = 'what_you_get_' . $langParam;
?>
<div class="courseInfo">
    <ul>

        <?php if ($model->$forWhom != '') { ?>
            <p class="subCourseInfo"><b><?php echo Yii::t('course', '0204'); ?></b></p>
            <?php
            $forWhomArray = explode(";", $model->$forWhom);
            for ($k = 0; $k < count($forWhomArray); $k++) {
                ?>
                <li><?php echo $forWhomArray[$k] . ";"; ?></li>
                <?php
            }
        }
        ?>
    </ul>
    <ul>
        <?php if ($model->$whatYouLearn != '') { ?>
            <p class="subCourseInfo"><b><?php echo Yii::t('course', '0205'); ?></b></p>
            <?php
            $whatYouLearnArray = explode(";", $model->$whatYouLearn);
            for ($l = 0; $l < count($whatYouLearnArray); $l++) {
                ?>
                <li><?php echo $whatYouLearnArray[$l] . ";"; ?></li>
                <?php
            }
        }
        ?>
    </ul>
    <ul>
        <?php if ($model->$whatYouGet != '') { ?>
            <p class="subCourseInfo"><b><?php echo Yii::t('course', '0206'); ?></b></p>
            <?php
            $whatYouLearnArray = explode(";", $model->$whatYouGet);
            for ($r = 0; $r < count($whatYouLearnArray); $r++) {
                ?>
                <li><?php echo $whatYouLearnArray[$r] . ";"; ?></li>
                <?php
            }
        }
        ?>
    </ul>
</div>