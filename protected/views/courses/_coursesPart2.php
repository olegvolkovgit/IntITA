<?php
/**
 * @var $val Course
 */
?>
<td>
    <div id='coursesPart2'>
        <?php
        $j = 0;
        foreach ($courseList as $val) {
            $j++;
            if ($j == 2) $this->renderPartial('_conceptBlock');
            if ($j % 2 == 0) {
                ?>
                <div class='courseBox'>
                    <img src='<?php echo StaticFilesHelper::createPath('image', 'course', $val->course_img); ?>'>

                    <div class='courseName'><a
                            href="<?php echo Yii::app()->createUrl('course/index', array('id' => $val->course_ID)); ?>"><?php
                            echo $val->getTitle(); ?></a>
                    </div>
                    <!--Рівень курсу-->
                    <div class="courseLevelBox">
                        <?php echo Yii::t('courses', '0068'); ?>
                        <span class="courseLevel">
                        <?php echo $val->level(); ?>
			        </span>

                        <div class='courseLevelIndex'>
                            <?php
                            $rate = $val->getRate();
                            for ($i = 0; $i < $rate; $i++) {
                                ?><span class="courseLevelImage">
                                <img
                                    src="<?php echo StaticFilesHelper::createPath('image', 'common', 'ratIco1.png'); ?>">
                                </span><?php
                            }
                            for ($i = $rate; $i < Course::MAX_LEVEL; $i++) {
                                ?><span class="courseLevelImage">
                                <img
                                    src="<?php echo StaticFilesHelper::createPath('image', 'common', 'ratIco0.png'); ?>">
                                </span><?php
                            }
                            ?>
                        </div>
                    </div>
                    <!--Стан курсу-->
                    <div class="courseStatusBox">
                        <?php echo Yii::t('courses', '0094'); ?>
                        <span id="courseStatus<?php echo $val->status; ?>">
                                    <?php if ($val->status == 0) { ?>
                                        <img
                                            src="<?php echo StaticFilesHelper::createPath('image', 'courses', 'disabled.png'); ?>">
                                        <?php
                                        echo Yii::t('courses', '0230');
                                    } else { ?>
                                        <img
                                            src="<?php echo StaticFilesHelper::createPath('image', 'courses', 'enable.png'); ?>">
                                        <?php
                                        echo Yii::t('courses', '0231');
                                    }
                                    ?>
                    </span>
                    </div>
                    <div class="courseLang">
                        <?php echo Yii::t('courses', '0069'); ?>
                        <a id="coursesLangs"
                           href="<?php echo Yii::app()->createUrl('course/index', array('id' => $val->course_ID)); ?>"><?php echo $val->language; ?>
                        </a>
                        <?php if (isset($coursesLangs[$val->course_ID]['ru'])) { ?>
                            <a id="coursesLangs"
                               href="<?php echo Yii::app()->createUrl('course/index', array('id' => $val->course_ID)); ?>">ru
                            </a>
                        <?php }
                        if (isset($coursesLangs[$val->course_ID]['en'])) {
                            ?>
                            <a id="coursesLangs"
                               href="<?php echo Yii::app()->createUrl('course/index', array('id' => $val->course_ID)); ?>">en
                            </a>
                        <?php } ?>
                    </div>

                    <div class="coursePriceBox">
                        <?php echo Yii::t('courses', '0147');
                        $price = $val->getBasePrice();
                        if ($price == 0) { ?>
                            <span class="colorGreen"><?= Yii::t('module', '0421'); ?></span>
                        <?php
                        } else { ?>
                            <span id="coursePriceStatus1"><?= $price . " " . Yii::t('courses', '0322'); ?></span>
                            &nbsp<span id="coursePriceStatus2"><?= PaymentHelper::discountedPrice($price, 30) . " " .
                                Yii::t('courses', '0322'); ?></span>
                            <span id="discount">(<?= Yii::t('courses', '0144'); ?> - 30%)</span>
                        <?php
                        }
                        ?>
                    </div>
                    <div class='starLevelIndex'>
                        <br>
                        <?php echo Yii::t('courses', '0145'); ?>
                        <?php echo CommonHelper::getRating($val->rating); ?>
                    </div>
                </div> <?php
            }
        }
        ?>
    </div>
</td>