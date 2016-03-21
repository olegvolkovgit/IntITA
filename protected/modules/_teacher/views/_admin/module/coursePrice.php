<?php
/**
 * @var $courses array
 * @var course Course
 */
?>
<ul class="list-inline">
    <li>
        <button type="button" class="btn btn-primary"
                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/module/index'); ?>')">
            Список модулів</button>
    </li>
</ul>

<form onsubmit="addCoursePrice('<?php echo Yii::app()->createUrl('/_teacher/_admin/module/addCoursePrice'); ?>');return false;"
      name="add-accessModule">
    <fieldset>
        <div class="col-md-4">
            <legend id="label">Задати ціну модуля у курсі:</legend>
            Виберіть курс:<br>

            <input type="hidden" value="<?php echo $id; ?>" id="module">

            <div class="form-group">
                <select name="course" id="courseList" class="form-control" required>
                    <optgroup label="Курси">
                        <option value="">Виберіть курс</option>
                    <?php foreach($courses as $course){?>
                            <option value="<?php echo $course->course_ID;?>"><?php echo $course->alias;
                            if ($course->getBasePrice() > 0) {
                                echo '  - поточна ціна ' . $course->getBasePrice() . '$'; ?></option>
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
                <input type="number" id="price" class="form-control" required/>
            </div>
            <br>
            <br>
            <input class="btn btn-default" type="submit" value="Зберегти ціну модуля">
            <br>
            <br>
        </div>
</form>
