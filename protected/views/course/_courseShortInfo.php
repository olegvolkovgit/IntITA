<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 12.05.2015
 * Time: 15:20
 */
?>
<img class="courseImg" style="display: inline-block" src="<?php echo StaticFilesHelper::createPath('image', 'course', $model->course_img);?>" />
<div class="courseShortInfoTable">
    <table>
        <tr>
            <td>
                <span class="colorP"><b><?php echo Yii::t('course', '0193'); ?></b></span>&nbsp;
                <span class="courseLevel">
                    <?php echo CourseHelper::translateLevel($model->level);?>
                </span>
            </td>
            <td class="courseLevel">
                <div>
                <?php
                $rate = CourseHelper::getCourseRate($model->level);
                for ($i=0; $i<$rate; $i++)
                {
                    ?>
                    <img src="<?php echo StaticFilesHelper::createPath('image', 'common', 'ratIco1.png');?>" >
                <?php
                }
                for ($j=$rate; $j<5; $j++)
                {
                    ?>
                    <img src="<?php echo  StaticFilesHelper::createPath('image', 'common', 'ratIco0.png');?>" >
                <?php
                }
                ?>
                </div>
            </td>
        </tr>
    </table>
    <div class="courseDetail">
        <div class="colorP"><?php echo Yii::t('course', '0194'); ?></div>
        <div><b><?php echo $model->course_duration_hours;?> <?php echo Yii::t('module', '0216'); ?></b>, <?php echo Yii::t('course', '0209'); ?> - <b><?php echo ceil($model->course_duration_hours/36);?> <?php echo Yii::t('module', '0218'); ?></b> (3 <?php echo Yii::t('module', '0219'); ?>, 3 <?php echo Yii::t('module', '0220'); ?>)</div>
        <span class="spoilerLinks" onclick="paymentSpoiler('<?php echo Yii::t('course', '0414'); ?>', '<?php echo Yii::t('course', '0415'); ?>')"><span id="spoilerClick"><?php echo Yii::t('course', '0414'); ?></span><span id="spoilerTriangle"> &#9660;</span></span>
        <div><?php echo Yii::t('course', '0197'); ?></div>
        <div class="numbers"><?php echo CourseHelper::getCoursePrice($model->course_price,25) ?></div>
        <div class="spoilerBody">
            <?php echo CourseHelper::getCoursePricePayments($model->course_price,2,9) ?>
            <?php echo CourseHelper::getCoursePricePayments($model->course_price,4,8) ?>
            <?php echo CourseHelper::getCoursePriceMonths(round($model->course_price/12),12) ?>
            <div class="italic">
                <?php echo CourseHelper::getCoursePriceCredit(round($model->course_price/24)*1.1,2) ?>
                <?php echo CourseHelper::getCoursePriceCredit(round($model->course_price/36)*1.3,3) ?>
                <?php echo CourseHelper::getCoursePriceCredit(round($model->course_price/48)*1.5,4) ?>
                <?php echo CourseHelper::getCoursePriceCredit(round($model->course_price/60)*1.7,5) ?>
            </div>
        </div>
        <div class="markAndButton">
            <div class="markCourse">
                <span class="colorP"><?php echo Yii::t('course', '0203'); ?> </span>
                <span>
                    <?php
                    for ($i=0; $i<$model->rating; $i++) {?>
                        <img src="<?php echo StaticFilesHelper::createPath('image', 'common', 'starFull.png');?>"/><?php
                    }
                    for ($i=$model->rating; $i<10; $i++) {?>
                        <img src="<?php echo StaticFilesHelper::createPath('image', 'common', 'starEmpty.png');?>"/><?php
                    }
                    ?>
                </span>
            </div>
            <div class="startCourse">
                <?php echo CHtml::link(Yii::t('course', '0328'), '#'); ?>
            </div>
        </div>
    </div>
</div>
