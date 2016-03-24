<?php
/**
 * @var $module Module
 * @var $course Course
 * @var $price integer
 */
?>

<form
    onsubmit="addCoursePrice('<?php echo Yii::app()->createUrl('/_teacher/_admin/module/addCoursePrice'); ?>');return false;"
    name="add-accessModule">
    <div class="col-md-8">
        <div class="form-group">
            <label>Модуль:
                <input type="text" class="form-control" size="135"
                       value="<?= $module->getTitle(); ?>" disabled>
            </label>
            <input type="hidden" class="form-control" size="135" value="<?= $module->module_ID; ?>"
                   id="module">
        </div>

        <div class="form-group">
            <label>Курс:
                <input type="text" class="form-control" size="135"
                       value="<?= $course->getTitle(); ?>" disabled>
            </label>
            <input type="hidden" class="form-control" size="135" value="<?= $course->course_ID; ?>"
                   id="course">
        </div>

<!--        <div class="form-group">-->
<!--            <label for="price">Поточна ціна: </label>-->
<!--            <input type="number" class="form-control" value="--><?//=$price;?><!--" required disabled />-->
<!--        </div>-->

        <div class="form-group">
            <label for="price">Нова ціна: </label>
            <input type="number" id="price" class="form-control" required min="0"/>
        </div>
        <br>
        <input class="btn btn-primary" type="submit" value="Зберегти ціну модуля">
    </div>
</form>

