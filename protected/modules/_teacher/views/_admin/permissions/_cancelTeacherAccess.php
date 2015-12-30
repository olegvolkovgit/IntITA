<div id="cancelTeacherAccess">
    <br>
    <a name="cancelFormTeacher"></a>

    <form action="<?php echo Yii::app()->createUrl('/_admin/permissions/cancelTeacherPermission'); ?>" method="POST"
          name="add-teacher-access">
        <fieldset>
            <legend id="label">Скасувати права автора модуля:</legend>
            Викладач:<br>

            <div class="col-md-4">
                <div class="form-group">
                    <select name="teacher" class="form-control" placeholder="(Виберіть викладача)" autofocus
                            onchange="selectTeacherModules('<?=Yii::app()->createUrl("/_admin/permissions/showTeacherModules");?>');">
                        <?php $users = Teacher::generateTeachersList();
                        $count = count($users);
                        for ($i = 0; $i < $count; $i++) {
                            ?>
                            <option value="<?php echo $users[$i]['id'];?>"><?php echo $users[$i]['alias'];?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>

                <br>
                <br>
                Модуль:<br>

                <div name="teacherModules" class="form-group" style="float:left;"></div>
                <br>
                <br>
                <br>

                <input type="submit" class="btn btn-default" value="Скасувати">
            </div>
    </form>
</div>