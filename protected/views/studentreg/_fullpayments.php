<?php
/**
 * Created by PhpStorm.
 * User: Wizlight
 * Date: 04.07.2015
 * Time: 19:00
 */
$user = Yii::app()->user->getId();
?>
<a class="coursename" href="<?php echo Yii::app()->createUrl('course/index', array('id' => Course::model()->findByPk($data['id_course'])->course_ID)); ?>">
   <?php echo Course::getCourseName($data['id_course'])."   ".
        Course::getAgreementLink($data['id_course'], $user); ?>
</a>
<p class="price">
    <?php
        echo Yii::t('profile', '0258').' ';
        echo Course::model()->findByPk($data['id_course'])->course_price;
        echo ' '.Yii::t('profile', '0259');
    ?>
</p>