<?php
?>
<head>
    <meta charset="UTF-8">
</head>
<link rel="stylesheet" type="text/css" href="<?php echo Config::getBaseUrl().'/css/courseSchema.css';?>"/>

<div id="courseSchema">
<br>
<h3>Схема проходження курса
    <?php echo CourseHelper::getCourseName($idCourse).", ".CourseHelper::getCourseLevel($idCourse);?></h3>
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

    <?php for($i = 0, $count = count($modules); $i < $count; $i++){
        if(LectureHelper::getLessonsCount($modules[$i]['id_module']) > 0) {
            ?>
            <tr>
            <td class="hours"><?php echo ModuleHelper::getModuleName($modules[$i]['id_module']); ?></td>
            <?php
            $countCells = count($tableCells[$i]) - 1;
            for ($j = 0; $j < $countCells; $j++) {
                if ($tableCells[$i][$j] == 0) {
                    ?>
                    <td class="emptyMonthsCell"></td>
                <?php } else {
                    ?>
                    <td class="fullMonthsCell">
                        <?php echo $tableCells[$i][$j]; ?></td>
                    <?php
                }
            }
            ?>
            <td class="examCell">E</td>
            <?php
            if(CourseModules::getCourseDuration($tableCells) == $j){
                ?>
                <td class="trainee" colspan="4">Стажування</td>
                <?php
            } else {
                for(; $j < $courseDuration - 1;$j++){?>
                    <td class="lastCell"></td>
                <?php
                }
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
    <?php if(!$save){?>
    <br>
    <br>
    <button id="saveButton"><a href="<?php echo Yii::app()->createUrl('/_admin/coursemanage/saveSchema',
            array('idCourse' => $idCourse)
        );?>">Зберегти cхему</a></button>
<br>
<br>
    <br>
    <?php }?>
    </div>


