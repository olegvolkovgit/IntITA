<?php
/**
 * @var $course Course
 * @var $module Module
 * @var $item Module
 * @var $modules array
*/
$modules = CourseModules::availableMandatoryModules($course->course_ID, $module->module_ID);
?>
<form ng-controller="mandatoryModulesCtrl" ng-submit="addMandatory('<?php echo Yii::app()->createUrl('/_teacher/_admin/module/addMandatoryModule'); ?>')"
    name="add-accessModule">
    <fieldset>
        <div class="col-md-8">
            <div class="form-group">
                <label>Модуль:
                    <input type="text" class="form-control" size="135"
                           value="<?= $module->getTitle(); ?>" disabled>
                </label>
                <input type="hidden" class="form-control" size="135" value="<?= $module->module_ID; ?>"
                       name="module">
            </div>
            <div class="form-group">
                <label>Курс:
                    <input type="text" class="form-control" size="135"
                           value="<?= $course->getTitle(); ?>" disabled>
                </label>
                <input type="hidden" class="form-control" size="135" value="<?= $course->course_ID; ?>"
                       name="course">
            </div>

            <div class="form-group">
                Доступний після завершення модуля:<br>
                <select name="mandatory" id="moduleList" class="form-control">
                    <option value="0">Не задано</option>
                        <?php foreach ($modules as $item) {
                            ?>
                            <option
                                value="<?php echo $item->module_ID; ?>"><?php echo $item->getTitle(); ?></option>
                        <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <input class="btn btn-primary" type="submit" value="Задати попередній модуль">
                <a type="button" class="btn btn-default" ng-click='back()'>
                    Назад
                </a>
            </div>
        </div>
</form>

