<?php
/**
 * @var $model CourseModules
 */
?>

<form
    onsubmit="addCoursePrice('<?php echo Yii::app()->createUrl('/_teacher/_admin/module/addCoursePrice'); ?>',
        'Модуль <?php echo $model->moduleInCourse->getTitle() ?>');return false;"
    name="add-accessModule">
    <div class="col-md-8">
        <div class="form-group">
            <label>Модуль:
                <input type="text" class="form-control" size="135" value="<?= $model->moduleInCourse->getTitle(); ?>"
                       disabled>
            </label>
            <input type="hidden" class="form-control" size="135" value="<?= $model->moduleInCourse->module_ID; ?>"
                   id="module">
        </div>

        <div class="form-group">
            <label>Курс:
                <input type="text" class="form-control" value="<?= $model->course->getTitle(); ?>" size="135"
                       disabled>
            </label>
            <input type="hidden" class="form-control" value="<?= $model->course->course_ID; ?>"
                   id="course">
        </div>

        <div class="form-group">
            <label for="price">Поточна ціна: </label>
            <input type="number" class="form-control" value="<?php
            if ($model->price_in_course != null) {
                echo $model->price_in_course;
            } else {
                if ($model->moduleInCourse->module_price) {
                    echo $model->moduleInCourse->module_price;
                } else {
                    echo "безкоштовно";
                }
            }
            ?>" required disabled />
        </div>

        <div class="form-group">
            <label for="price">Нова ціна: </label>
            <input type="number" id="price" class="form-control" required min="0"/>
        </div>
        <br>
        <input class="btn btn-primary" type="submit" value="Зберегти ціну модуля">
    </div>
</form>

