<?php
/**
 * @var $model Module
 * @var $teachers array
 * @var $item Teacher
 * @var $scenario string
 */
$teachers = $model->teacher;
?>
<div class="panel panel-default">
    <div class="panel-body">
        <?php if ($scenario == "update") { ?>
            <ul class="list-inline">
                <li>
                    <button type="button" class="btn btn-outline btn-primary"
                            onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/module/addTeacher', array('id' => $model->module_ID)); ?>',
                                'Призначити автора модуля')">
                        Призначити автора
                    </button>
                </li>
            </ul>
        <?php } ?>

        <div class="col-md-12">
            <div class="row">
                <?php if (!empty($teachers)){ ?>
                <div class="dataTable_wrapper">
                    <table class="table table-striped table-bordered table-hover" id="modulesListTable">
                        <thead>
                        <tr>
                            <th>Автор</th>
                            <th width="20%">Призначений</th>
                            <th width="20%">Відмінено</th>
                            <?php if ($scenario == 'update') { ?>
                                <th width="10%">Відмінити</th>
                            <?php } ?>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($teachers as $item) { ?>
                        <tr>
                            <td>
                                <a href="<?= Yii::app()->createUrl('profile/index', array('idTeacher' => $item["user_id"])); ?>"
                                   target="_blank">
                                    <?= $item->user->userNameWithEmail(); ?>
                                </a>
                            </td>
                            <td>
                                <?= $item->isPrint; ?>
                            </td>
                            <td>

                            </td>
                            <?php if ($scenario == 'update') { ?>
                                <td>
                                    <?php //todo
                                    //if ($item["end_time"] == '') { ?>
                                    <a href="#"
                                       onclick="cancelModuleAttr('<?= Yii::app()->createUrl("/_teacher/_admin/teachers/unsetTeacherRoleAttribute"); ?>',
                                           '<?= $item->user_id ?>', 'module'); return false;">
                                        скасувати
                                    </a>
                                    <?php //} ?>
                                </td>
                            <?php } ?>
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
    echo "Лекцій у даному модулі ще немає.";
}
?>
