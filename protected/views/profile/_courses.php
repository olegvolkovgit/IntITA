<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 08.05.2015
 * Time: 15:43
 */

?>
<?php $coursesID = TeacherHelper::getCoursesByTeacher($id);
if (!empty($coursesID)){?>
<div class="TeacherProfilecourse">
        <p>
            <?php echo Yii::t('teachers', '0061'); ?>
        </p>
        <div class="teacherCourses">
            <ul>
                <?php
                foreach ($coursesID as $key => $value) {
                    ?>
                    <li>
                        <a href="<?php echo Yii::app()->createUrl('course/index', array('id' => $key));?>"><?php echo $value; ?></a>
                    </li>
                <?php
                }
                ?>
            </ul>
        </div>
</div>
<?php }?>