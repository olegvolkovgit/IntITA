<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 12.05.2015
 * Time: 15:20
 */
?>
<script>
        profilePath = "<?php echo Yii::app()->createUrl('studentreg/profile', array('idUser' => Yii::app()->user->getId()));?>";
        course = "<?php echo $model->course_ID;?>";
</script>
<img class="courseImg" style="display: inline-block"
     src="<?php echo StaticFilesHelper::createPath('image', 'course', $model->course_img); ?>"/>
<div class="courseShortInfoTable">
    <table class="courseLevelInfo">
        <tr>
            <td>
                <span class="colorP"><b><?php echo Yii::t('course', '0193'); ?></b></span>&nbsp;
                <span class="courseLevel">
                    <?php echo CourseHelper::translateLevel($model->level); ?>
                </span>
            </td>
            <td class="courseLevel">
                <div>
                    <?php
                    $rate = CourseHelper::getCourseRate($model->level);
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
                </div>
            </td>
        </tr>
    </table>
    <div class="courseDetail">
        <div class="colorP"><?php echo Yii::t('course', '0194'); ?> <a href="#" onclick="showSchema()">Схема курса</a></div>
        <div id="schema"><?php $this->renderPartial('_schema', array('idCourse' => $model->course_ID));?></div>
        <div>
            <b><?php echo CourseHelper::getLessonsCount($model->course_ID); ?><?php echo ' '.Yii::t('module', '0216'); ?></b>, <?php echo Yii::t('course', '0209'); ?>
            - <b><?php echo ceil(CourseHelper::getLessonsCount($model->course_ID)/ 36); ?><?php echo Yii::t('module', '0218'); ?></b>
            (3 <?php echo Yii::t('module', '0219'); ?>, 3 <?php echo Yii::t('module', '0220'); ?>)
        </div>
       <?php $this->renderPartial('_paymentsForm', array('model' => $model));?>
    </div>
</div>

<script type="text/javascript" src="<?php echo Config::getBaseUrl(); ?>/scripts/jquery.cookie.js"></script>

<script>
    $(function() {
        $('input:radio[name="payment"]').filter('[value="1"]').attr('checked', true);
    });
    function redirectToProfile(){
        $.cookie('idCourse', course, {'path': "/"});
        $.cookie('checkedSchemaPay', $("input[name='payment']:checked").val(), {'path': "/"});
        $.cookie('openProfileTab', 5, {'path': "/"});
        document.location.href = profilePath;
    }
</script>