<?php
/* @var $user array */
/* @var $adminsList array */
?>
<div class="col-lg-12">
    <br>
    <button class="btn btn-primary"
            onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/users/renderAdminForm'); ?>',
                'Призначити адміністратора')">
        Призначити адміністратора
    </button>
    <br>
    <br>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="dataTable_wrapper">
                <table class="table table-striped table-bordered table-hover" id="adminsTable">
                    <thead>
                    <tr>
                        <th>ФІО</th>
                        <th>Email</th>
                        <th>Призначено</th>
                        <th>Відмінено</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($adminsList as $user) {
                        ?>
                        <tr class="odd gradeX">
                            <td><?= $user["secondName"] . " " . $user["firstName"]; ?></td>
                            <td class="center"><?= $user["email"]; ?></td>
                            <td class="center"><?= date("d-m-Y", strtotime($user["start_date"])); ?></td>
                            <td class="center"><?= ($user["end_date"]) ? date("d-m-Y", strtotime($user["end_date"])) : ""; ?></td>
                            <td class="center"><a href="#" title="Відмінити" onclick="cancelAdmin(
                                    '<?= Yii::app()->createUrl('/_teacher/_admin/users/cancelAdmin'); ?>',
                                    '<?= $user["id"]; ?>',
                                    '<?= $user["secondName"] . " " . $user["firstName"] . " <" . $user["email"] . ">"; ?>');"><i
                                        class="fa fa-trash-o fa-fw"></i></a></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
