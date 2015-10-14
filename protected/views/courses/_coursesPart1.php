<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 12.05.2015
 * Time: 15:51
 */
?>
<td  valign="top">
<div id='coursesPart1'>
    <?php
    $j=0;
    foreach ($courseList as $val) {
        $j++;
        if ($j % 2 <> 0) {
            ?>
            <div class='courseBox'>
                <img src='<?php echo StaticFilesHelper::createPath('image', 'course', $val->course_img); ?>'>

                <div class='courseName'><a
                        href="<?php echo Yii::app()->createUrl('course/index', array('id' => $val->course_ID)); ?>"><?php
                        echo CourseHelper::getCourseName($val->course_ID);?></a>
                </div>
                <!--Рівень курсу-->
                <div class="courseLevelBox">
                    <?php echo Yii::t('courses', '0068'); ?>
                    <span class="courseLevel">
                        <?php echo CourseHelper::translateLevel($val->level);?>
			        </span>

                    <div class='courseLevelIndex'>
                        <?php
                        $rate = CourseHelper::getCourseRate($val->level);
                        for ($i = 0; $i < $rate; $i++) {
                            ?><span class="courseLevelImage">
                            <img src="<?php echo StaticFilesHelper::createPath('image', 'common', 'ratIco1.png'); ?>">
                            </span><?php
                        }
                        for ($i = $rate; $i < Course::MAX_LEVEL; $i++) {
                            ?><span class="courseLevelImage">
                            <img src="<?php echo StaticFilesHelper::createPath('image', 'common', 'ratIco0.png'); ?>">
                            </span><?php
                        }
                        ?>
                    </div>
                </div>
                <!--Стан курсу-->
                <div class="courseStatusBox">
                    <?php echo Yii::t('courses', '0094'); ?>
                    <span id="courseStatus<?php echo $val->status; ?>">
                                    <?php if ($val->status == 0) {?>
                                         <img src="<?php echo StaticFilesHelper::createPath('image', 'courses', 'disabled.png');?>">
                                    <?php
                                        echo Yii::t('courses', '0230');
                                    } else {?>
                                        <img src="<?php echo StaticFilesHelper::createPath('image', 'courses', 'enable.png');?>">
                                    <?php
                                        echo Yii::t('courses', '0231');
                                    }
                                    ?>
                    </span>
                </div>
                <!--Мови курсу-->
                <div class="courseLang">
                    <?php echo Yii::t('courses', '0069'); ?>
                    <a id="coursesLangs"
                       href="<?php echo Yii::app()->createUrl('course/index', array('id' => $val->course_ID)); ?>"><?php echo $val->language; ?>
                    </a>
                    <?php if(isset($coursesLangs[$val->course_ID]['ru'])){?>
                        <a id="coursesLangs"
                           href="<?php echo Yii::app()->createUrl('course/index', array('id' => $coursesLangs[$val->course_ID]['ru'])); ?>">ru
                        </a>
                    <?php }
                    if(isset($coursesLangs[$val->course_ID]['en'])){?>
                        <a id="coursesLangs"
                           href="<?php echo Yii::app()->createUrl('course/index', array('id' => $coursesLangs[$val->course_ID]['en'])); ?>">en
                        </a>
                    <?php }?>

                </div>
                <!--Вартість курсу-->
                <div class="coursePriceBox">
                    <?php echo Yii::t('courses', '0147'); ?>
                    <?php echo CourseHelper::getMainCoursePrice(Course::getCoursePrice($val->course_ID),30) ?>
                </div>
                <!--Оцінка курсу-->
                <div class='starLevelIndex'>
                    <br>
                    <?php echo Yii::t('courses', '0145'); ?>
                    <?php echo RatingHelper::getRating($val->rating); ?>
                </div>
            </div>
        <?php
        }
    }?>
</div>
</td>