<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 05.10.2015
 * Time: 17:26
 */
$modules = CourseModules::model()->findAllByAttributes(array('id_course' => $idCourse));
?>
<table>
    <tr>
        <td>місяці</td>
        <?php for($i = 0, $count = count($modules); $i < $count; $i++){?>
            <td><?php echo $i;?></td>
        <?php }?>
    </tr>

    <tr>
        <td colspan="<?php echo $count+1;?>">
        <?php echo CourseHelper::getCourseName($idCourse);?>
        </td>
    </tr>

    <?php for($i = 0, $count = count($modules); $i < $count; $i++){?>
    <tr>
        <td><?php echo ModuleHelper::getModuleName($modules[$i]['id_module']);?></td>
        <?php for($j = 0; $j < $count; $j++){?>
            <td>8</td>
        <?php }?>
    </tr>
    <?php }?>

    <tr>
    <td></td>
    <?php for($i = 0, $count = count($modules); $i < $count; $i++){?>
        <td><?php echo $i;?></td>
    <?php }?>
    </tr>
</table>

