<?php
/**
 * @var $val Course
 * @var $blocks array
 */
?>
<div id='coursesPart1'>
    <div id="miniConcept">
        <?php $this->renderPartial('_conceptBlock'); ?>
    </div>
    <?php
    $j = 0;
    foreach ($blocks as $val) {
        $j++;
        if ($j % 2 <> 0) {
            ?>
            <div class='courseBox'>
                <div class="displayMini">
                    <img class="courseLogo" src='<?php echo StaticFilesHelper::createPath('image', 'course', $val[0]->course_img); ?>'>
                    <div class='courseNameMini'><a
                            href="<?php echo Yii::app()->createUrl('course/index', array('id' => $val[0]->course_ID)); ?>"><?php
                            echo $val[0]->getTitle(); ?></a>
                    </div>
                </div>
                <div class="courseInfo">
                    <div class='courseName'><a
                            href="<?php echo Yii::app()->createUrl('course/index', array('id' => $val[0]->course_ID)); ?>"><?php
                            echo $val[0]->getTitle(); ?></a>
                    </div>
                    <div class="courseLevelBox">
                        <?php echo Yii::t('courses', '0068'); ?>
                        <span class="courseLevel">
                        <?php echo $val[0]->level(); ?>
                        </span>
                        <div class='courseLevelIndex'>
                            <?php
                            $rate = $val[0]->getRate();
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
                        <span id="courseStatus<?php echo $val[0]->status; ?>">
                                <?php if ($val[0]->status == 0) { ?>
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
                    <!--Мови курсу-->
                    <div class="courseLang">
                        <?php echo Yii::t('courses', '0069'); ?>
                        <a id="coursesLangs"
                           href="<?php echo Yii::app()->createUrl('course/index', array('id' => $val[0]->course_ID)); ?>">
                            <?php echo $val[0]->language; ?>
                        </a>
                        <?php if (isset($val[1])) { ?>
                            <a id="coursesLangs"
                               href="<?php echo Yii::app()->createUrl('course/index',
                                   array('id' => $val[1]["course_ID"])); ?>"><?=$val[1]["language"];?>
                            </a>
                        <?php }
                        if (isset($val[2])) {
                            ?>
                            <a id="coursesLangs"
                               href="<?php echo Yii::app()->createUrl('course/index',
                                   array('id' => $val[2]["course_ID"])); ?>"><?=$val[2]["language"];?>
                            </a>
                        <?php } ?>

                    </div>
                    <div class="coursePriceBox">
                        <?php echo Yii::t('courses', '0147');
                        $schema = PaymentScheme::getSchema(PaymentScheme::ADVANCE, EducationForm::ONLINE);
                        $price = round($schema->getSumma($val[0]));
                        if ($price == 0) {?>
                            <span class="colorGreen"><?=Yii::t('module', '0421');?></span>
                            <?php
                        }
                        else {?>
                            <span id="coursePriceStatus1"><?= round($val[0]->getBasePrice()) . Yii::t('courses', '0322');?></span>
                            &nbsp<span id="coursePriceStatus2"><?=$price.
                                Yii::t('courses', '0322');?></span>
                            <span id="discount">(<?=Yii::t('courses', '0144');?> - 30%)</span>
                            <?php
                        }
                        ?>
                    </div>
                    <div class='starLevelIndex'>
                        <br>
                        <?php echo Yii::t('courses', '0145'); ?>
                        <?php echo CommonHelper::getRating($val[0]->rating); ?>
                    </div>
                </div>
            </div>
        <?php
        }
    }
    ?>
</div>