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
<div class="panel panel-default col-md-7">
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
                <br>
                <div class="form-group">
                    <button type="button" class="btn btn-success"
                            onclick="assignTeacherConsultantForStudent('<?php echo Yii::app()->createUrl('/_teacher/_trainer/trainer/assignTeacherForStudent'); ?>',
                                '<?= $student->id ?>', '<?= $module->module_ID; ?>')">Призначити викладача
                    </button>
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

<script>
    var teachers = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url: basePath + '/_teacher/_trainer/trainer/teachersByQuery?query=%QUERY&module=' + module,
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