<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 12.05.2015
 * Time: 15:55
 */
?>
<td>
    <div id='coursesPart2'>
        <?php $this->renderPartial('_conceptBlock');?>

        <?php
        for ($j = $count1; $j < $count1+$count2; $j++)
        {
            $val = $courseList[$j];
            ?>
            <div class='courseBox'>
                <img src='<?php echo StaticFilesHelper::createPath('image', 'course', $val->course_img);?>'>
                <div class='courseName'> <a href="<?php echo Yii::app()->createUrl('course/index', array('id' => $val->course_ID)); ?>"><?php
                        echo $val->course_name; ?></a>
                </div>
                <!--Рівень курсу-->
                <div class="courseLevelBox">
                    <?php echo Yii::t('courses', '0068');  ?>
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
                    <div id="coursesLangs" class="down">
                        <a href="<?php echo Yii::app()->createUrl('course/index', array('id'=>$val->course_ID)); ?>">ua</a>
                    </div>
                </div>
                <!--Вартість курсу-->
                <div class="coursePriceBox">
                    <?php echo Yii::t('courses', '0147'); ?>
                    <span id="coursePriceStatus1"> <?php echo "21600.00 грн. "; ?> </span>
                    <span id="coursePriceStatus2"> <?php echo " 16500.00 грн. "; ?> </span>
                    <?php echo " (".Yii::t('courses', '0144')." - 25%)"; ?>
                </div>
                <br>
                <div class='starLevelIndex'>
                    <br>
                    <?php echo Yii::t('courses', '0145'); ?>
                    <?php
                    for ($i = 0; $i < 9; $i++) {
                        ?><span class="courseLevelImage">
                        <img src="<?php echo StaticFilesHelper::createPath('image', 'common', 'starFull.png');?>">
                        </span><?php
                    }
                    for ($i = 0; $i < 1; $i++) {
                        ?><span class="courseLevelImage">
                        <img src="<?php echo StaticFilesHelper::createPath('image', 'common', 'starEmpty.png');?>">
                        </span><?php
                    }
                    ?>
                </div>
            </div> <?php
        }
        ?>
    </div>
</td>