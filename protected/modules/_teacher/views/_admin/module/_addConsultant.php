<?php
/**
 * @var $module Module
 */
?>
<div class="col-md-9">
    <div class="row">
        <form>
            <input type="number" hidden="hidden" value="<?= $module->module_ID; ?>" id="module">
            <input type="text" hidden="hidden" value="<?= UserRoles::CONSULTANT; ?>" id="role">
            <div class="col col-md-9">
                <div class="form-group">
                    <label>Модуль:
                        <input type="text" class="form-control" placeholder="Модуль" size="135"
                               value="<?= $module->getTitle()." (".$module->language.")"; ?>" disabled>
                    </label>
                </div>
                <div class="form-group">
                    <input type="number" hidden="hidden" id="user" value="0"/>
                    <label>Виберіть викладача:</label>
                    <input id="typeaheadConsultant" type="text" class="form-control" placeholder="Викладач"
                           size="135" required autofocus>
                </div>
                <div class="form-group">
                    <button type="button" class="btn btn-success"
                            onclick="addTeacherAttr('<?php echo Yii::app()->createUrl('/_teacher/_admin/teachers/setTeacherRoleAttribute'); ?>',
                                'module', '#module','','Модуль <?php echo $module->getTitle() ?>','editModule')">
                        Призначити консультанта
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    var teachers = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url: basePath + '/_teacher/_admin/module/teachersByQuery?query=%QUERY',
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

    $jq('#typeaheadConsultant').typeahead(null, {
            name: 'teachers',
            display: 'email',
            limit: 10,
            source: teachers,
            templates: {
                empty: [
                    '<div class="empty-message">',
                    'немає користувачів з таким іменем або email\`ом',
                    '</div>'
                ].join('\n'),
                suggestion: Handlebars.compile("<div class='typeahead_wrapper'><img class='typeahead_photo' src='{{url}}'/> <div class='typeahead_labels'><div class='typeahead_primary'>{{name}}&nbsp;</div><div class='typeahead_secondary'>{{email}}</div></div></div>")
            }
        }
    );

    $jq('#typeaheadConsultant').on('typeahead:selected', function (e, item) {
        $jq("#user").val(item.id);
    });
</script>
