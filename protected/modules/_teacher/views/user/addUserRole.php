<?php
/**
 * @var $model RegisteredUser
 * @var $user StudentReg
 * @var $roles array
 * @var $role UserRoles
 */
$user = $model->registrationData;
?>
<ul class="list-inline">
    <li>
        <button type="button" class="btn btn-primary"
                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/users/index'); ?>',
                    'Користувачі')">Користувачі
        </button>
    </li>
    <li>
        <button type="button" class="btn btn-primary"
                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/user/index', array('id' => $user->id)); ?>',
                    'Переглянути інформацію про користувача')">
            Переглянути інформацію про користувача
        </button>
    </li>
</ul>
<div class="col-md-8">
    <div id="addTeacherRole">
        <form name="add-access">
            <fieldset>
                <legend>Користувач: <em>
                        <?php echo $user->secondName . " " . $user->firstName . " " . $user->middleName; ?></em>
                </legend>
                <input type="number" hidden="hidden" value="<?= $user->id; ?>" id="user">
                Роль:<br>
                <div class="form-group">
                    <select name="role" class="form-control" placeholder="(Виберіть роль)">
                        <optgroup label="Виберіть роль">
                            <?php
                            foreach ($roles as $role) {
                                ?>
                                <option value="<?php echo $role; ?>"><?php echo $role; ?></option>
                                <?php
                            }
                            ?>
                    </select>
                </div>
                <br>
                <input class="btn btn-default" type="submit"
                       onclick="setRole('<?php echo Yii::app()->createUrl('/_teacher/user/setUserRole'); ?>'); return false"
                       value="Призначити роль">
            </fieldset>
        </form>
    </div>
</div>
<script>
    function setRole(){
        var role = $jq("select[name=role] option:selected").val();
        var user = $jq("#user").val();
        $jq.ajax({
            url: url,
            type: 'post',
            async: true,
            data: {role: role, user: user},
            success: function (response) {
                if (response == "success") {
                    bootbox.confirm("Операцію успішно виконано.", function () {
                        load(basePath + "/_teacher/user/index/id/" + teacher, '');
                    });
                } else {
                    showDialog("Операцію не вдалося виконати.");
                }
            },
            error: function () {
                showDialog("Операцію не вдалося виконати.");
            }
        });
    }
</script>

