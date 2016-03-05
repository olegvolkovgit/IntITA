<?php
/**
 * Created by PhpStorm.
 * User: Wizlight
 * Date: 11.02.2016
 * Time: 13:31
 */
?>
<div class="courseData">
    <a class="coursename" href="<?php echo Yii::app()->createUrl('course/index', array('id' => Course::model()->findByPk($data['id_course'])->course_ID)); ?>">
        <?php echo Course::getCourseName($data['id_course']); ?>
    </a>
    <p class="courseLevLang"><?php echo Yii::t('courses', '0068'); ?> <span class="colorP"><?php echo Course::getCourseLevel($data['id_course']); ?></span></p>
    <p class="courseLevLang"><?php echo Yii::t('courses', '0069'); ?> <span class="colorP"><?php echo Course::getCourseLang($data['id_course']); ?></span></p>
</div>