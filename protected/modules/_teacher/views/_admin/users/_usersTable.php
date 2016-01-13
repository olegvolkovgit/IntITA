<?php
/* @var $user StudentReg */
/* @var $users array */
?>
<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="dataTable_wrapper">
                <table class="table table-striped table-bordered table-hover" id="usersTable">
                    <thead>
                    <tr>
                        <th>ФІО</th>
                        <th>Email</th>
                        <th>Зареєстровано</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $users = StudentReg::model()->findAll();
                    foreach($users as $user){
                        ?>
                        <tr class="odd gradeX">
                            <td><?=$user->userName();?></td>
                            <td class="center"><?=$user["email"];?></td>
                            <td class="center"></td>
                        </tr>
                    <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>