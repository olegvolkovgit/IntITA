<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="<?php echo StaticFilesHelper::fullPathTo('css', 'images/favicon.ico'); ?>"/>
    <link rel="stylesheet" href="<?=Config::getBaseUrl()?>/css/courseSchema.css"/>
</head>

<div id="courseSchema" ng-controller="coursemanageCtrl">
    <br>
    <?php if (isset($messages) ? $message = $messages : $message = null) ; ?>
    <h3><?php echo Course::printTitle($idCourse, $message); ?></h3>
    <br>
    <table id="schema">
        <tr>
            <td class="monthTitle"><?php echo Course::getMessage($message, 'months') ?></td>
            <?php for ($i = 0; $i < $courseDuration; $i++) { ?>
                <td class="monthsCell"><?php echo $i + 1; ?></td>
            <?php } ?>
        </tr>
        <tr>
            <td class="monthTitle"><?php echo Course::getMessage($message, 'module') ?></td>
            <td class="monthTitle" colspan="<?php echo $courseDuration - 5; ?>"></td>
            <td colspan="5" id="courseName">
                <?php echo Course::getCourseName($idCourse); ?>
            </td>
        </tr>
        <?php for ($i = 0, $count = count($modules); $i < $count; $i++) {
            if (Module::getLessonsCount($modules[$i]['id_module']) > 0) {
                ?>
                <tr>
                <td class="hours"><?php echo Module::getModuleName($modules[$i]['id_module']); ?></td>
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
                <td class="examCell" title=<?php echo Course::getMessage($message, 'exam') ?>>E</td>
                <?php
                if (Course::getCourseDuration($tableCells) == $j) {
                    ?>
                    <td class="trainee" colspan="4"><?php echo Course::getMessage($message, 'trainee'); ?></td>
                <?php
                } else {
                    for (; $j < $courseDuration - 1; $j++) {
                        ?>
                        <td class="lastCell"></td>
                    <?php
                    }
                }
            }
            ?>
            </tr>
        <?php } ?>
        <tr>
            <td class="monthTitle"><?php echo Course::getMessage($message, 'months'); ?></td>
            <?php for ($i = 0; $i < $courseDuration; $i++) { ?>
                <td class="monthsCell"><?php echo $i + 1; ?></td>
            <?php } ?>
        </tr>
    </table>
    <?php if (!$save) { ?>
        <br>
        <br>
        <button id="saveButton" ng-click="saveSchema('<?php echo $idCourse ?>')"><?php echo Course::getMessage($message, 'save'); ?></button>
        <br>
        <br>
        <br>
    <?php } ?>
</div>

<script src="<?php echo StaticFilesHelper::fullPathTo('css', 'bower_components/bootstrap/dist/js/bootstrap.min.js');?>"></script>

