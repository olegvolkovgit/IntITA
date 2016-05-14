<?php
/**
 * @var $student StudentReg
 * @var $course Course
 */
$modules = $course->module;

?>

<div class="panel panel-default col-md-9">
    <div class="panel-body">
        <form role="form">
            <div class="form-group">
                <input type="text" hidden="hidden" value="student" id="role">
                <label>Студент:</label>
                <br>
                <input type="text" class="form-control" size="135" value="<?=$student->userNameWithEmail()?>" disabled>
                <input type="number" hidden="hidden" id="user" value="<?=$student->id?>"/>
            </div>
            <div class="form-group">
                <label>Курс:</label>
                <br>
                <input type="text" class="form-control" size="135" value="<?=$course->getTitle()." (".$course->language.")"?>" disabled>
            </div>
            <div>
                <?php if (!empty($modules)) { ?>
                    <ul>
                        <?php foreach ($modules as $module) {
                            ?>
                            <li>
                                <a href="#"
                                   onclick="load('<?= Yii::app()->createUrl("/_teacher/_trainer/trainer/editTeacherModule",
                                       array("id" => $student->id, "idModule" => $module->moduleInCourse->module_ID)); ?>',
                                       '<?= addslashes($student->userName()); ?>');">
                                    <?= $module->moduleInCourse->getTitle() . " (" . $module->moduleInCourse->language . ")"; ?>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                <?php } else { ?>
                    <em>Модулів немає.</em>
                <?php } ?>
            </div>
        </form>
    </div>
</div>
