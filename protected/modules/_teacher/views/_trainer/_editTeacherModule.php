<?php
/**
 * @var $student StudentReg
 * @var $module Module
 * @var $isTeacherDefined int
 * @var $teacher StudentReg
 */
?>
<script>
    module = <?=$module->module_ID?>;
</script>
<div class="panel panel-default col-md-7" ng-controller="teacherConsultantCtrl">
    <div class="panel-body">
        <form role="form">
            <div class="form-group">
                <input type="text" hidden="hidden" value="teacher_consultant" id="role">
                <label>Студент:</label>
                <br>
                <input type="text" class="form-control" size="135" value="<?= $student->userNameWithEmail() ?>"
                       disabled>
            </div>
            <div class="form-group">
                <label>Модуль:</label>
                <br>
                <input type="text" class="form-control" size="135" value="<?= $module->getTitle() ?>" disabled>
            </div>
            <?php if ($isTeacherDefined) { ?>
                <div class="form-group">
                    <label>
                        <strong>Викладач-консультант:</strong>
                    </label>
                    <input type="text" hidden="hidden" value="<?=$teacher->id?>" id="teacherId">
                    <input type="text" class="form-control" size="135" value="<?= $teacher->userNameWithEmail(); ?>" disabled>
                </div>
                <br>
                <div class="form-group">
                    <button type="button" class="btn btn-warning" ng-click="cancelTeacher('<?=$teacher->id?>', '<?=$module->module_ID?>', '<?= $student->id ?>')">
                        Скасувати викладача
                    </button>
                </div>
            <?php } else { ?>
                <div class="form-group">
                    <label>
                        <strong>Викладач-консультант:</strong>
                    </label>
                    <input type="text" size="135" ng-model="teacherSelected" ng-model-options="{ debounce: 1000 }" placeholder="виберіть викладача" uib-typeahead="item.email for item in getTeachers($viewValue,'<?= $module->module_ID; ?>') | limitTo : 10" typeahead-no-results="noResultsConsultant"  typeahead-template-url="customTemplate.html" typeahead-on-select="onSelect($item)" class="form-control" />
                    <i ng-show="loadingTeachers" class="glyphicon glyphicon-refresh"></i>
                    <div ng-show="noResultsConsultant">
                        <i class="glyphicon glyphicon-remove"></i> Викладача не знайдено
                    </div>
                <br>
                <div class="form-group">
                    <button type="button" class="btn btn-success" ng-click="assignTeacher('<?= $student->id ?>','<?= $module->module_ID?>')">Призначити викладача
                    </button>
                </div>
                </div>
            <?php } ?>
        </form>
        <div class="alert alert-info">
        <?php if(Yii::app()->user->model->isAdmin()){?>
            Призначити викладача-консультанта для даного модуля можна на сторінці
            <a href="javascript:void(0)" ng-click="changeView('trainer/addConsultantModule/<?=$module->module_ID?>')"
               class="alert-link">Призначити викладача</a>.
        <?php } else {?>
            Якщо в списку немає потрібного викладача-консультанта, можна надіслати запит для призначення консультанта
            <a href="#" onclick="load('<?= Yii::app()->createUrl("/_teacher/_trainer/trainer/sendResponseConsultantModule",
                array("idModule" => $module->module_ID)) ?>',
                'Запит на призначення викладача-консультанта для модуля'); return false;"
               class="alert-link">Надіслати запит</a>.
        <?php }?>
        </div>
    </div>
</div>

<script type="text/ng-template" id="customTemplate.html">
    <a>
        <div class="typeahead_wrapper  tt-selectable">
            <img class="typeahead_photo" ng-src="{{match.model.url}}" width="36">
            <div class="typeahead_labels">
                <div ng-bind="match.model.name" class="typeahead_primary"></div>
                <div ng-bind="match.model.email" class="typeahead_secondary"></div>
            </div>
        </div>


    </a>
</script>