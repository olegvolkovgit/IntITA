<?php
/* @var $user StudentReg*/
/* @var $users array */
/* @var $adminsList array */
/* @var $accountants array */
/* @var $teachers array */
?>
<div class="panel panel-default">
    <div class="panel-body">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs">
            <li><a href="#admin" data-toggle="tab">Адміністратори (<?=count($adminsList);?>)</a>
            </li>
            <li><a href="#accountant" data-toggle="tab">Бухгалтери (<?=count($accountants);?>)</a>
            </li>
            <li><a href="#teacher" data-toggle="tab">Викладачі (<?=count($teachers);?>)</a>
            </li>
            <li><a href="#register" data-toggle="tab">Зареєстровані користувачі (<?=count($users);?>)</a>
            </li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane fade in active" id="admin">
                <?php $this->renderPartial('_adminsTable', array('adminsList' => $adminsList));?>
            </div>
            <div class="tab-pane fade" id="accountant">
                <?php $this->renderPartial('_accountantsTable', array('accountants' => $accountants));?>
            </div>
            <div class="tab-pane fade" id="teacher">
                <?php $this->renderPartial('_teachersTable', array('teachers' => $teachers));?>
            </div>
            <div class="tab-pane fade" id="register">
                <?php $this->renderPartial('_usersTable', array('users' => $users));?>
            </div>
        </div>
    </div>
</div>
<script>
    $jq(document).ready(function () {
        $jq('#adminsTable, #accountantsTable, #usersTable, #teachersTable').DataTable({
                language: {
                    "url": "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json"
                }
            }
        );
    });
</script>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', '_admin/usersManage.js'); ?>"></script>




