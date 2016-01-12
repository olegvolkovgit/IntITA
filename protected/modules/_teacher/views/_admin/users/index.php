<div class="panel panel-default">
    <div class="panel-heading">
        Користувачі
    </div>
    <div class="panel-body">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs">
            <li><a href="#admin" data-toggle="tab">Адміністратори</a>
            </li>
            <li><a href="#accountant" data-toggle="tab">Бухгалтери</a>
            </li>
            <li><a href="#teacher" data-toggle="tab">Викладачі</a>
            </li>
            <li><a href="#register" data-toggle="tab">Зареєстровані користувачі</a>
            </li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane fade in active" id="admin">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="adminsTable">
                                    <thead>
                                    <tr>
                                        <th>Прізвище</th>
                                        <th>Ім'я</th>
                                        <th>По-батькові</th>
                                        <th>Email</th>
                                        <th>Призначено</th>
                                        <th>Відмінено</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $adminsList = StudentReg::adminsList();
                                        foreach($adminsList as $admin){
                                    ?>
                                    <tr class="odd gradeX">
                                        <td><?=$admin["id_user"];?></td>
                                        <td>Internet Explorer 4.0</td>
                                        <td>Win 95+</td>
                                        <td class="center"></td>
                                        <td class="center"><?=$admin["start_date"];?></td>
                                        <td class="center"><?=$admin["end_date"];?></td>
                                    </tr>
                                    <?php }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="accountant">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="accountantsTable">
                                    <thead>
                                    <tr>
                                        <th>Прізвище</th>
                                        <th>Ім'я</th>
                                        <th>По-батькові</th>
                                        <th>Email</th>
                                        <th>Призначено</th>
                                        <th>Відмінено</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $accountants = StudentReg::accountantsList();
                                    foreach($accountants as $user){
                                        ?>
                                        <tr class="odd gradeX">
                                            <td><?=$user["id_user"];?></td>
                                            <td>Internet Explorer 4.0</td>
                                            <td>Win 95+</td>
                                            <td class="center"></td>
                                            <td class="center"><?=$user["start_date"];?></td>
                                            <td class="center"><?=$user["end_date"];?></td>
                                        </tr>
                                    <?php }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="teacher">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="teachersTable">
                                    <thead>
                                    <tr>
                                        <th>Прізвище</th>
                                        <th>Ім'я</th>
                                        <th>По-батькові</th>
                                        <th>Email</th>
                                        <th>Призначено</th>
                                        <th>Відмінено</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $accountants = StudentReg::accountantsList();
                                    foreach($accountants as $user){
                                        ?>
                                        <tr class="odd gradeX">
                                            <td><?=$user["id_user"];?></td>
                                            <td>Internet Explorer 4.0</td>
                                            <td>Win 95+</td>
                                            <td class="center"></td>
                                            <td class="center"><?=$user["start_date"];?></td>
                                            <td class="center"><?=$user["end_date"];?></td>
                                        </tr>
                                    <?php }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="register">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="usersTable">
                                    <thead>
                                    <tr>
                                        <th>Прізвище</th>
                                        <th>Ім'я</th>
                                        <th>По-батькові</th>
                                        <th>Email</th>
                                        <th>Зареєстровано</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $users = StudentReg::allUsers();
                                    foreach($users as $user){
                                        ?>
                                        <tr class="odd gradeX">
                                            <td><?=$user["secondName"];?></td>
                                            <td><?=$user["firstName"];?></td>
                                            <td><?=$user["middleName"];?></td>
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
            </div>
        </div>
    </div>
</div>
<!-- DataTables JavaScript -->
<script
    src="<?php echo StaticFilesHelper::fullPathTo('css', 'bower_components/datatables/media/js/jquery.dataTables.min.js'); ?>"></script>
<script
    src="<?php echo StaticFilesHelper::fullPathTo('css', 'bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js'); ?>"></script>
<script>
    $(document).ready(function () {
        $('#adminsTable, #accountantsTable, #usersTable, #teachersTable').DataTable({
                language: {
                    "url": "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json"
                }
            }
        );
    });
</script>




