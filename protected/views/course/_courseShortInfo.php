<?php
/* @var $model Course */
$lessonsCount = Course::getLessonsCount($model->course_ID); ?>
<script>
    course = "<?php echo $model->course_ID;?>";
</script>
<img class="courseImg" src="<?php echo StaticFilesHelper::createPath('image', 'course', $model->course_img); ?>"/>
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

    <!--назва організації ++ -->
    <div>
        <span class="colorP"><?php echo Yii::t('profile', '0966'); ?></span>
        <?php echo $model->organization->name; ?>
    </div>

    <div class="courseDetail">
        <div>
            <span class="colorP"><?php echo Yii::t('course', '0194'); ?></span>
            <b><?php echo $lessonsCount . ' ' . Yii::t('module', '0216'); ?></b>
            <?php if ($lessonsCount != 0) {
                echo ', ' . Yii::t('course', '0209'); ?>
                -<b>
                    <?php echo $model->getApproximatelyDurationInMonths(); ?><?php echo Yii::t('course', '0664'); ?>
                </b>
                <?php
            } ?>
        </div>
        <?php $this->renderPartial('_paymentsForm', array('model' => $model)); ?>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
<script type="text/javascript" src="<?php echo StaticFilesHelper::fullPathTo('js', 'jquery.cookie.js'); ?>"></script>
