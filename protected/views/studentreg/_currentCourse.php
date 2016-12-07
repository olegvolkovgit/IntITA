<?php
/* @var $level string
 * @var $title string
 */
?>
<?php foreach ($courses as $course){ ?>
<div class="courseData">
    <a class="coursename" href="<?php echo Yii::app()->createUrl('course/index', array('id' => $course['id'])); ?>">
        <?php echo CHtml::encode($course[$title]); ?>
    </a>
    <p class="courseLevLang"><?php echo Yii::t('courses', '0068'); ?> <span class="colorP"><?php echo $course[$level]; ?></span></p>
    <p class="courseLevLang"><?php echo Yii::t('courses', '0069'); ?> <span class="colorP"><?php echo $course['lang']; ?></span></p>
</div>
<?php } ?>