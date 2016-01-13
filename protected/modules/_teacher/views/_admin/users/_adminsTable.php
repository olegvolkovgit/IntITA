<?php
/* @var $user StudentReg */
/* @var $adminsList array */
?>

<div class="col-lg-12">
    <br>
    <button class="btn btn-primary"
            onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/users/renderAdminForm'); ?>',
                'Додати адміністратора')">
        Додати адміністратора
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
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($adminsList as $user) {
                        ?>
                        <tr class="odd gradeX">
                            <td><?= $user->userName(); ?></td>
                            <td class="center"><?= $user->email; ?></td>
                            <td class="center"></td>
                            <td class="center"></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>