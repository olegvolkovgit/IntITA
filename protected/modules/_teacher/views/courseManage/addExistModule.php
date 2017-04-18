<?php
/**
 * @var $course Course
 */
?>
<script>
    course = <?=$course->course_ID;?>;
</script>
<div class="col-md-6">
    <div id="addModuleToCourse">
        <form role="form">
            <fieldset>
                <div class="form-group">
                    <label>Курс: </label>
                    <input type="text" class="form-control" value="<?=$course->getTitle();?>" disabled >
                </div>

                <div class="form-group">
                    <input type="number" hidden="hidden" id="moduleId" value="0"/>
                    <label>Виберіть модуль: </label>
                    <input id="typeaheadModule" type="text" class="form-control" placeholder="Назва модуля"
                           size="135">
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-success" value="Додати модуль"
                           onclick="addExistModule('<?=Yii::app()->createUrl("/_teacher/coursemanage/addModuleToCourse");?>',
                               '<?=$course->course_ID?>','<?=$course->getTitle();?>'); return false;">
                </div>
            </fieldset>
        </form>
    </div>
</div>
<script>
    var modules = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url: basePath + '/_teacher/coursemanage/modulesByQuery?query=%QUERY&course=' + course,
            wildcard: '%QUERY',
            filter: function (modules) {
                return $jq.map(modules.results, function (module) {
                    return {
                        id: module.id,
                        title: module.title
                    };
                });
            }
        }
    });

    modules.initialize();

    $jq('#typeaheadModule').typeahead(null, {
        name: 'modules',
        display: 'title',
        limit: 10,
        source: modules,
        templates: {
            empty: [
                '<div class="empty-message">',
                'модулів з такою назвою немає',
                '</div>'
            ].join('\n'),
            suggestion: Handlebars.compile("<div class='typeahead_wrapper'>{{title}}&nbsp;</div>")
        }
    });

    $jq('#typeaheadModule').on('typeahead:selected', function (e, item) {
        $jq("#moduleId").val(item.id);
    });


    function addExistModule(url, course, title) {
        module = $jq("#moduleId").val();
        if (module == 0) {
            bootbox.alert('Виберіть модуль.');
        } else {
            var posting = $jq.post(url, {
                moduleId: module,
                courseId:course
            });

            posting.done(function (response) {
                    if (response == "success")
                        bootbox.alert("Модуль успішно додано.", function () {
                            load(basePath + '/_teacher/coursemanage/update/id/'+course,'Курс '+title,'','4');
                        });
                    else if(response == 'duplicate error') {
                        bootbox.alert("Даний модуль уже присутній в курсі");
                    }else{
                        bootbox.alert("Операцію не вдалося виконати");
                    }
                })
                .fail(function () {
                    bootbox.alert("Операцію не вдалося виконати2");
                });
        }
    }
</script>
