<?php
?>
<head>
    <meta charset="UTF-8">
</head>
<link rel="stylesheet" type="text/css" href="<?php echo Config::getBaseUrl() . '/css/courseSchema.css';?>"/>

<div id="courseSchema">
<br>
    <?php if(isset($messages)?$message = $messages:$message=null);?>
<h3><?php   echo CourseHelper::printTitle($idCourse,$message); ?></h3>
<br>
<table id="schema">
    <tr>
        <td class="monthTitle"><?php echo CourseHelper::getMessage($message,'months')?></td>
        <?php for($i = 0; $i < $courseDuration; $i++){?>
            <td class="monthsCell"><?php echo $i + 1;?></td>
        <?php }?>
    </tr>

    <tr>
        <td class="monthTitle"><?php echo CourseHelper::getMessage($message,'months') ?></td>
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
            <td class="examCell" title=<?php echo CourseHelper::getMessage($message,'exam') ?>>E</td>
            <?php
            if(Course::getCourseDuration($tableCells) == $j){
                ?>
                <td class="trainee" colspan="4"><?php echo CourseHelper::getMessage($message,'trainee'); ?></td>
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
    <td class="monthTitle"><?php echo CourseHelper::getMessage($message,'months'); ?></td>
    <?php for($i = 0; $i < $courseDuration; $i++){?>
        <td class="monthsCell"><?php echo $i + 1;?></td>
    <?php }?>
    </tr>
</table>
    <?php if(!$save){?>
    <br>
    <br>
    <button id="saveButton" onclick="alert('Ваша схема збережена!!!')"><a href="<?php echo Yii::app()->createUrl('/_admin/coursemanage/saveSchema',
            array('idCourse' => $idCourse)
        );?>"  ><?php echo CourseHelper::getMessage($message,'save'); ?></a></button>
<br>
<br>
    <br>
    <?php }?>
    </div>


