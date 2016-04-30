<?php
/**
 * @var $module Module
 */
?>
<script>
    module = '<?=$module->module_ID;?>';
</script>
<div class="panel panel-default col-md-7">
    <div class="panel-body">
        <form role="form">
            <div class="form-group">
                <label>Модуль:</label>
                <br>
                <input type="text" class="form-control" size="135" value="<?=$module->getTitle()?>" disabled>
                <input type="number" hidden="hidden" id="module" value="<?=$module->module_ID?>"/>
            </div>
            <div class="form-group">
                <label>
                    <strong>Викладач-консультант:</strong>
                </label>
                <input type="number" hidden="hidden" id="userId" value="0"/>
                <input id="typeaheadTeacher" type="text" class="form-control" placeholder="виберіть викладача"
                       size="135" required autofocus>
            </div>
            <br>
            <div class="form-group">
                <button type="button" class="btn btn-success"
                        onclick="assignTeacherConsultantModule('<?php echo Yii::app()->createUrl("/_teacher/_teacher_consultant/teacherConsultant/assignModule"); ?>',
                            '<?=$module->module_ID?>'); return false;">Призначити викладача-консультанта</button>
            </div>
        </form>
    </div>
</div>

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
        $jq("#userId").val(item.id);
    });
</script>