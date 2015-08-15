<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 08.05.2015
 * Time: 15:43
 */

?>
<?php $modules = TeacherHelper::getModulesByTeacher($id);

if (!empty($modules)){?>
    <p>
        <?php echo Yii::t('teachers', '0061'); ?>
    </p>
<div class="TeacherProfilecourse">

        <div class="teacherCourses">
            <ul>
                <?php
                $count = count($modules);
                for ($i = 0; $i < $count; $i++) {
                    ?>
                    <li>
                        <a href="<?php echo Yii::app()->createUrl('module/index', array('idModule' =>$modules[$i]["idModule"], 'idCourse'=>$modules[$i]["idCourse"]));?>"><?php echo $modules[$i]["title"]; ?></a>
                    </li>
                <?php
                }
                ?>
            </ul>
        </div>
</div>
<?php }?>