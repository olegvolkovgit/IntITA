<ul class="list-inline">
    <li>
        <button type="button" class="btn btn-primary"
                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/permissions/index'); ?>')">
            Права доступу</button>
    </li>
    <li>
        <button type="button" class="btn btn-primary"
                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/permissions/showAddAccessForm'); ?>')">
            Додати запис</button>
    </li>
    <li>
        <button type="button" class="btn btn-primary"
                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/permissions/showAddTeacherAccess'); ?>')">
            Призначити автора модуля</button>
    </li>
    <li>
        <button type="button" class="btn btn-primary"
                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/permissions/UserStatus'); ?>')">
            Змінити статус користувача</button>
    </li>
</ul>

<div id="cancelTeacherAccess">
    <br>
    <a name="cancelFormTeacher"></a>

    <form name="add-teacher-access"
          onsubmit="cancelTeacherAccess('<?php echo Yii::app()->createUrl('/_teacher/_admin/permissions/cancelTeacherPermission'); ?>');
              return false;"
          >
        <fieldset>
            <legend id="label">Скасувати права автора модуля:</legend>
            Викладач:<br>

            <div class="col-md-4">
                <div class="form-group">
                    <select name="teacher" class="form-control" placeholder="(Виберіть викладача)" autofocus required="true"
                            onchange="selectTeacherModules('<?=Yii::app()->createUrl("/_teacher/_admin/permissions/showTeacherModules");?>');">
                        <?php
                        foreach($users as $user){
                            ?>
                            <option value="<?php echo $user['id'];?>"><?php echo $user['alias'];?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>

                <br>
                <br>
                Модуль:<br>

                <div name="teacherModules" class="form-group" ></div>
                <br>
                <br>
                <br>

                <input type="submit" class="btn btn-default" value="Скасувати">
            </div>
    </form>
</div>
<script src="<?php echo StaticFilesHelper::fullPathTo('css', '/bower_components/bootstrap/dist/js/bootstrap.min.js');?>"></script>