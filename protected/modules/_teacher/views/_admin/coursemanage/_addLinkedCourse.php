<?php
/**
 * @var $model CourseLanguages
 * @var $course Course
 * @var $lang string
 */
?>
<div class="col-md-6">
    <form role="form">
        <fieldset>
            <div class="form-group">
                <label>Виберіть курс:</label>
                <input type="number" hidden="hidden" id="course" value="0"/>
                <input id="typeaheadCourse" type="text" size="135" class="form-control" placeholder="додати курс">
                <br>
            </div>
            <br>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Редагувати"
                       onclick="addLinkedCourses('<?= Yii::app()->createUrl("/_teacher/_admin/coursemanage/changeLinkedCourses"); ?>'
                           ,'<?= ($model->getIsNewRecord()) ? 0 : $model->id; ?>',
                           '<?= $course->course_ID ?>',
                           '<?=$lang?>',
                           '<?= "Курс " . $course->getTitle() ?>'
                           )">
            </div>
        </fieldset>
    </form>
</div>
<script>
    initCoursesTypeahead('<?=$lang?>');
</script>

