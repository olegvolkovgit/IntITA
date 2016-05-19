<?php
/* @var $model Course */
$lessonsCount = Course::getLessonsCount($model->course_ID); ?>
<script>
    course = "<?php echo $model->course_ID;?>";
</script>
<img class="courseImg" style="display: inline-block;margin-bottom:30px; "
     src="<?php echo StaticFilesHelper::createPath('image', 'course', $model->course_img); ?>"/>
<div class="courseShortInfoTable">
    <table class="courseLevelInfo">
        <tr>
            <td>
                <span class="colorP"><b><?php echo Yii::t('course', '0193'); ?></b></span>&nbsp;
                <span class="courseLevel">
                    <a href="#" data-toggle="tooltip" title="<?php echo $model->level(); ?>" id="tooltip">
                     <?php
                     $rate = $model->getRate();
                     for ($i = 0; $i < $rate; $i++) {
                         ?>
                         <img src="<?php echo StaticFilesHelper::createPath('image', 'common', 'ratIco1.png'); ?>">
                         <?php
                     }
                     for ($j = $rate; $j < 5; $j++) {
                         ?>
                         <img src="<?php echo StaticFilesHelper::createPath('image', 'common', 'ratIco0.png'); ?>">
                         <?php
                     }
                     ?>
                        </a>
                </span>
            </td>
            <td class="courseLevel">
                <div>
                    <?php if ($lessonsCount > 0) { ?>
                        <span id="demo">
                        <?php if (isset($_SESSION['lg']) ? $lg = $_SESSION['lg'] : $lg = 'ua') ; ?>
                            <a href='<?php echo Yii::app()->createUrl('course/schema', ['id' => $model->course_ID]);
                            ?>' target="_blank"><?php echo Yii::t('course', '0662'); ?></a>
                        </span>
                        <br>
                    <?php } ?>
                </div>
            </td>
        </tr>
    </table>
    <div class="courseDetail">
        <div>
            <span class="colorP"><?php echo Yii::t('course', '0194'); ?></span>
            <b><?php echo $lessonsCount . ' ' . Yii::t('module', '0216'); ?></b>
            <?php if ($lessonsCount != 0) {
                echo ', ' . Yii::t('course', '0209'); ?>
                -<b>
                    <?php echo ceil($lessonsCount / (36/Config::getLectureDurationInHours())); ?><?php echo Yii::t('course', '0664'); ?>
                </b>
                <?php echo '(3 ' . Yii::t('module', '0219'); ?>, 3 <?php echo Yii::t('module', '0220') . ')';
            } ?>
        </div>
        <?php
        if($model->status != Course::AVAILABLE) {
            $price = $model->getBasePrice();
            if ($price == 0) {
                echo Yii::t('courses', '0147') . ' '; ?>
                <span class="colorGreen"><?= Yii::t('module', '0421'); ?></span>
                <?php
            } else {
                ?>
                <span class="spoilerLinks"
                      onclick="paymentSpoiler('<?php echo Yii::t('course', '0414'); ?>', '<?php echo Yii::t('course', '0415'); ?>', 'Online')">
        <span id="spoilerClickOnline"><?php echo Yii::t('course', '0414'); ?></span>
        <span id="spoilerTriangleOnline"> &#9660;</span></span>
            <?php }
            if ($price != 0) {
                ?>
                <table class="mainPay">
                    <tr>
                        <td>
                            <table>
                                <tr>
                                    <td>
                                        <div class="numbers" id="numbersFirstOnline">
                                            <span class="coursePriceStatus1"><?php echo $price . " " . Yii::t('courses', '0322') ?>
                                            </span>
                                            &nbsp
                                            <span class="coursePriceStatus2"><?php echo PaymentHelper::discountedPrice($price, 30) . " " . Yii::t('courses', '0322'); ?>
                                            </span>
                                            <span id="discount">
                                                <img style="text-align:right" src="<?php echo StaticFilesHelper::createPath('image', 'course', 'pig.png') ?>"/>
                                                (<?php echo Yii::t('courses', '0144') . ' - 30%)'; ?>
                                            </span>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            <?php }
            $this->renderPartial('_paymentsForm', array('model' => $model));
        }?>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
<script type="text/javascript" src="<?php echo StaticFilesHelper::fullPathTo('js', 'jquery.cookie.js'); ?>"></script>
