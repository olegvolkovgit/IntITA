<form action="" name="add-teacher-access">
    <fieldset>
        <legend>Надати права автора модуля:</legend>
                <div class="form-group">
                    <br>
                        <label>Викладач:</label>
                        <input id="typeahead" type="text" class="form-control" placeholder="Користувач"
                               size="135" autofocus>
                </div>

            <br>
            <br>
            Курс:<br>
            <div class="form-group">

            </div>
            <input type="submit" class="btn btn-success"
                   onclick="addTeacherAccess('<?php echo Yii::app()->createUrl('/_teacher/_admin/permissions/newTeacherPermission');?>');return false;"
                   value="Додати">

    </fieldset>

</form>