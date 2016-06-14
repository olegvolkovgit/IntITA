<?php
/* @var $levels array
 * @var $level Level
 */
?>
<div class="col-lg-12">
    <ul class="list-inline">
        <li>
            <button type="button" class="btn btn-primary"
                    onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/level/offer/index'); ?>',
                        'Публічна оферта')">
                Публічна оферта
            </button>
        </li>
    </ul>
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
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($levels as $level) {
                        ?>
                        <tr class="odd gradeX">
                            <td class="center"><?= $level->id; ?></td>
                            <td class="center">
                                <a href="#" onclick="load('<?= Yii::app()->createUrl("/_teacher/_admin/level/edit",
                                    array("id" => $level->id)) ?>', 'Редагувати рівень <?= $level->title_ua; ?>')">
                                    <?= $level->title_ua ?>
                                </a>
                            </td>
                            <td class="center">
                                <a href="#" onclick="load('<?= Yii::app()->createUrl("/_teacher/_admin/level/edit",
                                    array("id" => $level->id)) ?>', 'Редагувати рівень <?= $level->title_en; ?>')">
                                    <?= $level->title_en ?>
                                </a>
                            </td>
                            <td class="center">
                                <a href="#" onclick="load('<?= Yii::app()->createUrl("/_teacher/_admin/level/edit",
                                    array("id" => $level->id)) ?>', 'Редагувати рівень <?= $level->title_ru; ?>')">
                                    <?= $level->title_ru; ?>
                                </a>
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
                    "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json"
                }
            }
        );
    });
</script>