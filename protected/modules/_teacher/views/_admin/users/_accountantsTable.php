<?php
/* @var $user StudentReg */
/* @var $accountants array */
?>
<div class="col-lg-12">
    <br>
    <button class="btn btn-primary"
            onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/users/renderAccountantForm'); ?>',
                'Призначити бухгалтера')">
        Призначити бухгалтера
    </button>
    <br>
    <br>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="dataTable_wrapper">
                <table class="table table-striped table-bordered table-hover" id="accountantsTable">
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
                    foreach ($accountants as $user) {
                        ?>
                        <tr class="odd gradeX">
                            <td><?= $user["secondName"]." ".$user["firstName"]; ?></td>
                            <td class="center"><?= $user["email"]; ?></td>
                            <td class="center"><?=date("d-m-Y", strtotime($user["start_date"])); ?></td>
                            <td class="center"><?=($user["end_date"])?date("d-m-Y", strtotime($user["end_date"])):""; ?></td>
                            <td class="center"><a href="#" title="Відмінити"  onclick="cancelAccountant(
                                    '<?=Yii::app()->createUrl('/_teacher/_admin/users/cancelAccountant');?>',
                                    '<?=$user["id"];?>',
                                    '<?=$user["secondName"]." ".$user["firstName"]." <".$user['email'].">"; ?>');"><i class="fa fa-trash-o fa-fw"></i></a></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    function cancelAccountant(url, id, name) {
        var posting = $.post(url, {user: id});

        posting.done(function (response) {
                if (response == 1)
                    bootbox.alert("Права бухгалтера для користувача " + name + " відмінені.", function () {
                        location.href = window.location.pathname;
                    });
                else {
                    bootbox.alert("Права бухгалтера для користувача " + name + " не вдалося відмінити. Спробуйте повторити " +
                        "операцію пізніше або напишіть на адресу antongriadchenko@gmail.com.", function () {
                        location.href = window.location.pathname;
                    });
                }
            })
            .fail(function () {
                bootbox.alert("Права бухгалтера для користувача " + name + " не вдалося відмінити. Спробуйте повторити " +
                    "операцію пізніше або напишіть на адресу antongriadchenko@gmail.com.", function () {
                    location.href = window.location.pathname;
                });
            });
    }
</script>