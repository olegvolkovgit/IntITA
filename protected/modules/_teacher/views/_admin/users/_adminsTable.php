<?php
/* @var $user StudentReg */
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
                            <td><?= $user->userName(); ?></td>
                            <td class="center"><?= $user->email; ?></td>
                            <td class="center"></td>
                            <td class="center"></td>
                            <td class="center"><a href="#" title="Відмінити" onclick="cancelAdmin(
                                    '<?=Yii::app()->createUrl('/_teacher/_admin/users/cancelAdmin');?>',
                                    '<?=$user->id;?>');"><i class="fa fa-trash-o fa-fw"></i></a></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    function cancelAdmin(url, id) {
        var posting = $.post(url, {user: id});

        posting.done(function (response) {
                if (response == 1)
                    showDialog("Права адміністратора для користувача " + id + " відмінені.");
                else {
                    showDialog("Права адміністратора для користувача " + id + " не вдалося відмінити. Спробуйте повторити " +
                        "операцію пізніше або напишіть на адресу antongriadchenko@gmail.com.");
                }
            })
            .fail(function () {
                showDialog("Права адміністратора для користувача " + id + " не вдалося відмінити. Спробуйте повторити " +
                    "операцію пізніше або напишіть на адресу antongriadchenko@gmail.com.");
            })
            .always(function () {
                //location.href = window.location.pathname;
            });
    }
</script>