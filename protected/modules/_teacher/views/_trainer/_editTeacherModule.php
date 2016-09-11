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
                    <button type="button" class="btn btn-warning"
                            onclick="cancelTeacherConsultantForStudent('<?php echo Yii::app()->createUrl('/_teacher/_trainer/trainer/cancelTeacherForStudent'); ?>',
                                '<?= $student->id ?>', '<?= $module->module_ID; ?>')">
                        Скасувати викладача
                    </button>
                </div>
            <?php } else { ?>
                <div class="form-group">
                    <label>
                        <strong>Викладач-консультант:</strong>
                    </label>
                    <input type="number" hidden="hidden" id="teacherId" value="0"/>
                    <input id="typeaheadTeacher" type="text" class="form-control" placeholder="виберіть викладача"
                           size="135" required autofocus>
                </div>
                <div class="form-group">
                    <input type="text" size="135" ng-model="teacherSelected" ng-model-options="{ debounce: 1000 }" placeholder="Викладач" uib-typeahead="item.email for item in getTeachers($viewValue,'<?= $module->module_ID; ?>') | limitTo : 10" typeahead-no-results="noResultsConsultant"  typeahead-template-url="customTemplate.html" typeahead-on-select="onSelect($item)" class="form-control" />
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
            <a href="#" onclick="load('<?= Yii::app()->createUrl("/_teacher/_admin/module/addConsultantModule",
                array("idModule" => $module->module_ID)) ?>',
                'Додати викладача консультанта для модуля'); return false;"
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

<script>
    var teachers = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url: basePath + '/_teacher/_trainer/trainer/teacherConsultantsByQuery?query=%QUERY&module=' + module,
            wildcard: '%QUERY',
            filter: function (users) {
                return $jq.map(users.results, function (user) {
                    return {
                        id: user.id,
                        name: user.name,
                        email: user.email,
                        url: user.url
                    };
                });
            }
        }
    });

    teachers.initialize();

    $jq('#typeaheadTeacher').typeahead(null, {
        name: 'teachers',
        display: 'email',
        limit: 10,
        source: teachers,
        templates: {
            empty: [
                '<div class="empty-message">',
                'немає викладачів з таким іменем або email\`ом',
                '</div>'
            ].join('\n'),
            suggestion: Handlebars.compile("<div class='typeahead_wrapper'><img class='typeahead_photo' src='{{url}}'/> <div class='typeahead_labels'><div class='typeahead_primary'>{{name}}&nbsp;</div><div class='typeahead_secondary'>{{email}}</div></div></div>")
        }
    });

    $jq('#typeaheadTeacher').on('typeahead:selected', function (e, item) {
        $jq("#teacherId").val(item.id);
    });
</script>