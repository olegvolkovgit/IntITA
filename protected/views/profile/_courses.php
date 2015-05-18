<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 08.05.2015
 * Time: 15:43
 */

?>
<div class="TeacherProfilecourse">
    <ul>
    <?php
        for ($i = count($courses)-1; $i >= 0; $i--) {
            ?>
        <li>
            <a href="<?php echo Yii::app()->createUrl('course/index', array('id' => $courses[$i]['course'])); ?>"><?php echo $titles[$i]['title']; ?></a>
        </li>
        <?php
        }
    ?>
    </ul>
</div>