<?php
/**
 * @var $data PayCourses
 * @var $course Course
 */
$course = $data->course;
?>
<div class="courseData">
    <a class="coursename" href="<?php echo Yii::app()->createUrl('course/index', array('id' => $course->course_ID)); ?>">
        <?php echo $course->getTitle(); ?>
    </a>
    <p class="courseLevLang"><?php echo Yii::t('courses', '0068'); ?> <span class="colorP"><?php echo $course->level(); ?></span></p>
    <p class="courseLevLang"><?php echo Yii::t('courses', '0069'); ?> <span class="colorP"><?php echo $course->language; ?></span></p>
</div>