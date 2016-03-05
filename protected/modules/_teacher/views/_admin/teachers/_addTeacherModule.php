<form action="#" name="add-teacher-access" class="col col-md-9">

    <div class="form-group">
        <br>
        <label>Модуль</label>
        <input id="typeahead" type="text" class="form-control" placeholder="Модуль"
               size="85" autofocus>
    </div>
    <input type="submit" class="btn btn-success"
           onclick="addTeacherAccess('<?php echo Yii::app()->createUrl('/_teacher/_admin/permissions/newTeacherPermission'); ?>');return false;"
           value="Додати">
</form>