<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 12.05.2015
 * Time: 15:20
 */
?>
<script>
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
        <div>
            <?php if(CourseHelper::getLessonsCount($model->course_ID) > 0){?>
            <span id="demo">
                <?php if(isset($_SESSION['lg'])?$lg = $_SESSION['lg']: $lg = 'ua'); ?>
                <a href='<?php echo Config::getBaseUrl(). '/' . StaticFilesHelper::pathToCourseSchema('schema_course_'.$model->course_ID.'_'. $lg  .'.html');
                ?>'><?php echo Yii::t('course', '0662');?></a>
            </span>
            <br>
            <?php }?>
            <span  class="colorP"><?php echo Yii::t('course', '0194'); ?></span>
            <b><?php echo CourseHelper::getLessonsCount($model->course_ID); ?><?php echo ' '.Yii::t('module', '0216'); ?></b>, <?php echo Yii::t('course', '0209'); ?>
            - <b><?php echo ceil(CourseHelper::getLessonsCount($model->course_ID)/ 36); ?> <?php echo Yii::t('course', '0664'); ?></b>
            (3 <?php echo Yii::t('module', '0219'); ?>, 3 <?php echo Yii::t('module', '0220'); ?>)
        </div>
       <?php if($model->status != 0){$this->renderPartial('_paymentsForm', array('model' => $model));}?>
    </div>
</div>

<script type="text/javascript" src="<?php echo Config::getBaseUrl(); ?>/scripts/jquery.cookie.js"></script>

<script>
    $(function() {
        $('input:radio[name="payment"]').filter('[value="1"]').attr('checked', true);
    });
    function redirectToProfile(){
        schema = $('input:radio[name="payment"]:checked').val();
        $.cookie('courseSchema', schema, {'path': "/"});
        $.cookie('openProfileTab', 5, {'path': "/"});
    }
</script>