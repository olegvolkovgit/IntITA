<?php
?>
<link rel="stylesheet" type="text/css" href="<?php echo Config::getBaseUrl().'/css/courseSchema.css';?>"/>

<div id="courseSchema">
<br>
<h3>Схема проходження курса <?php echo CourseHelper::getCourseName($idCourse);?></h3>
<br>
<table id="schema">
    <tr>
        <td class="monthTitle">місяці</td>
        <?php for($i = 0; $i < $courseDuration; $i++){?>
            <td class="monthsCell"><?php echo $i + 1;?></td>
        <?php }?>
    </tr>

    <tr>
        <td class="monthTitle">модулі</td>
        <td class="monthTitle" colspan="<?php echo $courseDuration - 5;?>"></td>
        <td colspan="5" id="courseName">
        <?php echo CourseHelper::getCourseName($idCourse);?>
        </td>
    </tr>

    <?php for($i = 0, $count = count($modules); $i < $count; $i++){?>
    <tr>
        <td class="hours"><?php echo ModuleHelper::getModuleName($modules[$i]['id_module']);?></td>
        <?php
        $countCells = count($tableCells[$i]) - 1;
        for($j = 0; $j < $countCells; $j++){
            if ($tableCells[$i][$j] == 0){
            ?>
            <td class="emptyMonthsCell"></td>
        <?php } else {
                ?>
                <td class="fullMonthsCell">
                    <?php echo $tableCells[$i][$j];?></td>
                <?php
            }
        }
        ?>
    </tr>
    <?php }?>

    <tr>
    <td class="monthTitle">місяці</td>
    <?php for($i = 0; $i < $courseDuration; $i++){?>
        <td class="monthsCell"><?php echo $i + 1;?></td>
    <?php }?>
    </tr>
</table>
<br>
<br>
    </div>
