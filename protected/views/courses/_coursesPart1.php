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
    for ($k = 0; $k < $count1; $k++)
    {
        $val = $courseList[$k];
        ?>
        <div class='courseBox'>
            <img src='<?php echo StaticFilesHelper::createPath('image', 'course', $val->course_img);?>'>
            <div class='courseName'> <a href="<?php echo Yii::app()->createUrl('course/index', array('id'=>$val->course_ID)); ?>"><?php
                    echo $val->course_name; ?></a>
            </div>
            <!--Рівень курсу-->
            <div class="courseLevelBox">
                <?php echo Yii::t('courses', '0068'); ?>
                <span class="courseLevel">
			                            <?php
                                        $rate = 0;
                                        switch ($val->level){
                                            case 'intern':
                                                echo Yii::t('courses', '0232');
                                                $rate = 1;
                                                break;
                                            case 'junior':
                                                echo Yii::t('courses', '0233');
                                                $rate = 2;
                                                break;
                                            case 'strong junior':
                                                echo Yii::t('courses', '0234');
                                                $rate = 3;
                                                break;
                                            case 'middle':
                                                echo Yii::t('courses', '0235');
                                                $rate = 4;
                                                break;
                                            case 'senior':
                                                echo Yii::t('courses', '0236');
                                                $rate = 5;
                                                break;
                                        }
                                        ?>
			                          </span>

                <div class='courseLevelIndex'>
                    <?php
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
                <span id="courseStatus<?php echo $val->status;?>">
                                    <?php if($val->status == 0){
                                        echo Yii::t('courses','0230');
                                    } else {
                                        echo Yii::t('courses','0231');
                                    }
                                    ?>
                                </span>
            </div>
            <!--Мови курсу-->
            <div class="courseLang">
                <?php echo Yii::t('courses', '0069'); ?>
                <a id="coursesLangs" href="<?php echo Yii::app()->createUrl('course/index', array('id'=>$val->course_ID)); ?>"><?php echo $val->language;?></a>
            </div>
            <!--Вартість курсу-->
            <div class="coursePriceBox">
                <?php echo Yii::t('courses', '0147'); ?>
                <?php echo CourseHelper::getCoursePrice($val->course_price) ?>
            </div>
            <!--Оцінка курсу-->
            <div class='starLevelIndex'>
                <br>
                <?php echo Yii::t('courses', '0145'); ?>
                <?php
                for ($i = 0; $i < $val->rating; $i++) {
                    ?><span class="courseLevelImage">
                    <img src="<?php echo StaticFilesHelper::createPath('image', 'common', 'starFull.png');?>">
                    </span><?php
                }
                for ($i = $val->rating; $i < 10; $i++) {
                    ?><span class="courseLevelImage">
                    <img src="<?php echo StaticFilesHelper::createPath('image', 'common', 'starEmpty.png');?>">
                    </span><?php
                }
                ?>
            </div>
        </div>
    <?php
    } ?>
</div>
</td>