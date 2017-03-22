<?php
/**
 * @var $model Module
 * @var $scenario string
 * @var $item CourseModules
 * @var $courses array
 */
?>
<?php if (!empty($courses)) { ?>
<div class="panel panel-default">
    <div class="panel-body">
        <div class="col-md-12">
            <div class="row">
                <div class="dataTable_wrapper">
                    <table class="table table-striped table-bordered table-hover" id="modulesListTable">
                        <thead>
                        <tr>
                            <th>Курс</th>
                            <th width="10%">Порядок</th>
                            <th width="25%">Попередній модуль</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($courses as $item) { ?>
                        <tr>
                            <td>
                                <a href="<?= Yii::app()->createUrl('course/index', array('id' => $item->id_course)); ?>"
                                   target="_blank">
                                    <?= $item->course->getTitle(); ?>
                                </a>
                            </td>
                            <td>
                                <?= $item->order; ?>
                            </td>
                            <td>
                                <?php if ($scenario == "update") { ?>
                                    <a href="#/module/mandatory/id/<?= $item->moduleInCourse->module_ID ?>/course/<?= $item->id_course ?>">
                                        <?= ($item->mandatory_modules != null) ? $item->mandatory->getTitle() . " (ред.)" : "редагувати"; ?>
                                    </a>
                                <?php } else {
                                    echo ($item->mandatory_modules != null) ? $item->mandatory->getTitle() : "";
                                } ?>
                            </td>
                            <?php
                            } ?>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
} else {
    echo "Модуль не входить до жодного курсу.";
}
?>