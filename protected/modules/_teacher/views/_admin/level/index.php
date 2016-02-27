<?php
/* @var $levels array
 * @var $level Level
 */
?>
<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="dataTable_wrapper">
                <table class="table table-striped table-bordered table-hover" id="levelsTable">
                    <thead>
                    <tr>
                        <th>Рівень (рейтинг)</th>
                        <th>Назва українською</th>
                        <th>Назва англійською</th>
                        <th>Назва російською</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($levels as $level) {
                        ?>
                        <tr class="odd gradeX">
                            <td class="center"><?=$level->id;?></td>
                            <td class="center"><?=$level->title_ua?></td>
                            <td class="center"><?=$level->title_en?></td>
                            <td class="center"><?=$level->title_ru; ?></td>
                            <td class="center">
                                <a href="#" onclick="load('<?=Yii::app()->createUrl("/_teacher/_admin/level/edit",
                                    array("id" => $level->id))?>',
                                    'Редагувати рівень <?=$level->title_en;?>')" title="Редагувати назви"><i class="fa  fa-pencil fa-fw"></i></a>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    $jq(document).ready(function () {
        $jq('#levelsTable').DataTable({
                language: {
                    "url": "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json"
                },
                dom: "<'row'<'col-sm-6'f><'col-sm-6'l>>"
            }
        );
    });
</script>