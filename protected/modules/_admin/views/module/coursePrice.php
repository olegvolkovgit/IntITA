<br>
    <a href="<?php echo Yii::app()->createUrl('/_admin/module/index'); ?>">Список модулів</a>
<br>
<div class="page-header">
    <h2>Модуль #<?php echo $id . " " . Module::getModuleName($id); ?></h2>
</div>
<br>
<form action="<?php echo Yii::app()->createUrl('/_admin/module/addCoursePrice'); ?>" method="POST"
      name="add-accessModule">
    <fieldset>
        <div class="col-md-4">
            <legend id="label">Задати ціну модуля у курсі:</legend>
            Виберіть курс:<br>

            <input type="hidden" value="<?php echo $id; ?>" name="module">

            <div class="form-group">
                <select name="course" id="courseList" class="form-control" required>
                    <option value="">Виберіть курс</option>
                    <optgroup label="Курси">
                        <?php $courses = Course::generateModuleCoursesList($id);
                        $count = count($courses);
                        for ($i = 0; $i < $count; $i++) {
                            ?>
                            <option value="<?php echo $courses[$i]['id'];?>"><?php echo $courses[$i]['alias'];
                            if ($courses[$i]["price"] > 0) {
                                echo '  - поточна ціна ' . $courses[$i]["price"] . '$'; ?></option>
                            <?php
                            }
                        }
                        ?>
                </select>
            </div>
            <br>
            <br>

            <div class="form-group">
                <label for="price">Нова ціна: </label>
                <input type="number" name="price" class="form-control" required/>
            </div>

            <br>
            <br>
            <input class="btn btn-default" type="submit" value="Зберегти ціну модуля">
            <br>
            <br>
        </div>
</form>
