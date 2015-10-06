<?php
?>
<link rel="stylesheet" type="text/css" href="<?php echo Config::getBaseUrl().'/css/courseSchema.css';?>"/>

<div id="courseSchema">
<br>
<h3>Схема проходження курса <?php echo CourseHelper::getCourseName($idCourse);?></h3>
<br>
<table id="schema">
    <tr>
        <td id="monthTitle">місяці</td>
        <?php for($i = 0, $count = count($modules); $i < $count; $i++){?>
            <td><?php echo $i + 1;?></td>
        <?php }?>
    </tr>

    <tr>
        <td colspan="<?php echo $count+1;?>" id="courseName">
        <?php echo CourseHelper::getCourseName($idCourse);?>
        </td>
    </tr>

    <?php for($i = 0, $count = count($modules); $i < $count; $i++){?>
    <tr>
        <td class="hours"><?php echo ModuleHelper::getModuleName($modules[$i]['id_module']);?></td>
        <?php for($j = 0; $j < $count; $j++){?>
            <td>8</td>
        <?php }?>
    </tr>
    <?php }?>

    <tr>
    <td id="monthTitle">місяці</td>
    <?php for($i = 0, $count = count($modules); $i < $count; $i++){?>
        <td><?php echo $i + 1;?></td>
    <?php }?>
    </tr>
</table>
<br>
<br>
    </div>
