<?php
/**
 * @var $model Module
 * @var $scenario string
 * @var $item CourseModules
 * @var $courses array
 */
?>
<div class="panel panel-default">
    <div class="panel-body">
        <?php
        if ($scenario == "update") {
            ?>
            <ul class="list-inline">
                <li>
                    <button type="button" class="btn btn-outline btn-primary"
                            onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/module/mandatory', array('id' => $model->module_ID)); ?>',
                                'Додати попередній модуль у курсі')">Додати попередній модуль у курсі
                    </button>
                </li>
                <li>
                    <button type="button" class="btn btn-outline btn-primary"
                            onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/module/coursePrice',
                                array('id' => $model->module_ID)); ?>',
                                'Додати/змінити ціну модуля у курсі')">Додати/змінити ціну модуля у курсі
                    </button>
                </li>
            </ul>
        <?php } ?>
        <div class="col-md-12">
            <div class="row">
                <?php if (!empty($courses)){ ?>
                <div class="dataTable_wrapper">
                    <table class="table table-striped table-bordered table-hover" id="modulesListTable">
                        <thead>
                        <tr>
                            <th>Курс</th>
                            <th width="10%">Порядок</th>
                            <th width="15%">Ціна у курсі</th>
                            <th width="15%">Попередній модуль</th>
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
                                <?= $item->price_in_course; ?>
                            </td>
                            <td>
                                <?= $item->mandatory_modules; ?>
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
