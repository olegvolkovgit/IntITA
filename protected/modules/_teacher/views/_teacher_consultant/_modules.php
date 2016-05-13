<?php
/**
 * @var $modules array
 * @var $module Module
 */
?>
<div class="col-md-12">
    <div class="dataTable_wrapper">
        <table class="table table-striped table-bordered table-hover" id="teacherModulesTable">
            <thead>
            <tr>
                <th>Модуль</th>
                <th width="20%">Призначено</th>
            </tr>
            </thead>
            <tbody>
            <?php if (!empty($modules)) {
                foreach ($modules as $module) { ?>
                    <tr>
                        <td>
                            <a href="<?= Yii::app()->createUrl("module/index", array("idModule" => $module["id"])); ?>"
                               target="_blank">
                                <?= $module["title"] . " (" . $module["lang"] . ")"; ?>
                            </a>
                        </td>
                        <td>
                            <?= date("d.m.Y", strtotime($module["start_date"])); ?>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                echo "Модулів для викладача не призначено.";
            } ?>
            </tbody>
    </table>
</div>
</div>
<script>
    $jq(document).ready(function () {
        $jq('#teacherModulesTable').DataTable({
                "autoWidth": false,
                language: {
                    "url": "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json"
                }
            }
        );
    });
</script>
