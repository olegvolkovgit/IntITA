<?php
/**
 * @var $data PayCourses
 */
?>
<a class="coursename" href="<?php echo Yii::app()->createUrl('course/index', array('id' => $data->id_course)); ?>">
    <?php echo $data->course->getTitle(); ?>
</a>
<a href="<?= Yii::app()->createUrl('payments/agreement', array('user' => $data->id_user, 'course' => $data->id_course)); ?>">
    договір
</a>

<p class="price">
    <?php
    if(($price = $data->course->getBasePrice()) > 0) {
        echo Yii::t('profile', '0258') . ' ';
        echo $price;
        echo ' $';
    }
    ?>
</p>