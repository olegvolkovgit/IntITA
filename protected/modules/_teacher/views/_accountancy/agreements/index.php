<?php
/* @var $agreements array
 * @var $agreement UserAgreements
 */
?>
<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="dataTable_wrapper">
                <table class="table table-striped table-bordered table-hover" cellspacing="0" id="agreements">
                    <thead>
                    <tr>
                        <th>Номер</th>
                        <th>Користувач</th>
                        <th>Дата створення</th>
                        <th>Дата підтвердження</th>
                        <th>Підтверджено користувачем</th>
                        <th>Схема оплати</th>
                        <th>Управління</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($agreements as $agreement) {
                        ?>
                        <tr class="odd gradeX">
                            <td onclick="load('<?=Yii::app()->createUrl("/_teacher/_accountancy/agreements/agreement", array("id" => $agreement->id));?>','Договір'); return false;" style="cursor:pointer">
                                <strong><?= $agreement->number; ?></strong></td>
                            <td><?= $agreement->user->userNameWithEmail();?></td>
                            <td><?=($agreement->create_date)? date("d.m.y", strtotime($agreement->create_date)):""; ?></td>
                            <td><?=($agreement->approval_date)? date("d.m.y", strtotime($agreement->approval_date)):""; ?></td>
                            <td><?= ($agreement->approval_user)? $agreement->approvalUser->userNameWithEmail():""; ?></td>
                            <td><?= $agreement->paymentSchema->name;?></td>
                            <td><a href="#" onclick="confirm('<?= Yii::app()->createUrl("/_teacher/_accountancy/agreements/confirm"); ?>',
                                    '<?=$agreement->id;?>');">
                                    <img src="<?=StaticFilesHelper::createPath('image', 'common', 'confirm.png')?>"></a>
                                <a href="#" onclick="cancel('<?= Yii::app()->createUrl("/_teacher/_accountancy/agreements/cancel"); ?>',
                                    '<?=$agreement->id;?>');">
                                    <img src="<?=StaticFilesHelper::createPath('image', 'common', 'cancel.png')?>"></a>
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
        $jq('#agreements').DataTable({
                language: {
                    "url": "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json"
                },
                dom: "<'row'<'col-sm-6'f><'col-sm-6'l>>"
            }
        );
    });
</script>
