<ul class="list-inline">
    <li>
        <button type="button" class="btn btn-primary"
                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_accountant/representative/index'); ?>',
                    'Представники')">
            Представники
        </button>
    </li>
</ul>
<div class="panel panel-default">
    <div class="panel-body">
        <div class="formMargin">
            <form>
                <div class="col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a data-toggle="collapse" href="#new">
                                Новий представник
                            </a>
                        </div>
                        <div id="new" class="panel-collapse collapse in">
                            <div class="panel-body">
                                <div class="form-group">
                                    <label>Прізвище, ім'я, по-батькові</label>
                                    <input type="text" name="full_name" class="form-control" maxlength="255"
                                           size="50">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a data-toggle="collapse" href="#exist">
                                Вибрати існуючого представника
                            </a>
                        </div>
                        <div id="exist" class="panel-collapse collapse">
                            <div class="panel-body">
                                <div class="form-group">
                                    <label>Представник</label>
                                    <input id="typeaheadRepresentative" type="text" class="typeahead form-control"
                                           placeholder="виберіть представника" size="90">
                                    <input type="number" hidden="hidden" id="representative" value="0"/>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Компанія</label>
                        <input id="typeaheadCompany" type="text" class="typeahead form-control" name="company"
                               placeholder="виберіть компанію" size="90">
                        <input type="number" hidden="hidden" id="companyId" value="0"/>
                    </div>

                    <div class="form-group">
                        <label>Посада</label>
                        <input type="text" name="position" class="form-control" maxlength="100">
                    </div>

                    <div class="form-group">
                        <label>Порядок</label>
                        <input type="number" name="order" class="form-control" max="99" min="1">
                    </div>

                    <input type="number" hidden="hidden" id="scenario" value="new"/>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"
                                onclick="addRepresentative('<?php echo Yii::app()->createUrl('/_teacher/_accountant/representative/newRepresentative') ?>');
                                    return false;">Зберегти
                        </button>
                        <button type="reset" class="btn btn-outline btn-default"
                                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_accountant/representative/index'); ?>',
                                    'Представники')">Скасувати
                        </button>
                    </div>
            </form>

            <div class="alert alert-info">
                Якщо немає потрібної компанії, потрібно спочатку додати її у формі:
                <a href="#" class="alert-link"
                   onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_accountant/company/renderAddForm'); ?>',
                       'Додати компанію')">Додати компанію</a>.
                <br>
                Список усіх компаній:
                <a href="#" class="alert-link"
                   onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_accountant/company/index'); ?>',
                       'Компанії')">Усі компанії</a>.
            </div>
        </div>
    </div>
</div>

<script>
    var representatives = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url: basePath + '/_teacher/_accountant/representative/representativeByQuery?query=%QUERY',
            wildcard: '%QUERY',
            filter: function (users) {
                return $jq.map(users.results, function (user) {
                    return {
                        id: user.id,
                        name: user.name
                    };
                });
            }
        }
    });

    representatives.initialize();

    $jq('#typeaheadRepresentative').on('typeahead:selected', function (e, item) {
        $jq("#representative").val(item.id);
    });

    $jq('#typeaheadRepresentative').typeahead(null, {
        name: 'representatives',
        display: 'name',
        limit: 10,
        source: representatives,
        templates: {
            empty: [
                '<div class="empty-message">',
                'немає представників з таким іменем',
                '</div>'
            ].join('\n'),
            suggestion: Handlebars.compile("<div class='typeahead_wrapper'><div class='typeahead_labels'><div class='typeahead_primary'>{{name}}&nbsp;</div></div></div>")
        }
    });

    var companies = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url: basePath + '/_teacher/_accountant/company/companiesByQuery?query=%QUERY',
            wildcard: '%QUERY',
            filter: function (companies) {
                return $jq.map(companies.results, function (company) {
                    return {
                        id: company.id,
                        title: company.title,
                        edpnou: company.edpnou
                    };
                });
            }
        }
    });

    companies.initialize();

    $jq('#typeaheadCompany').on('typeahead:selected', function (e, item) {
        $jq("#companyId").val(item.id);
    });

    $jq('#typeaheadCompany').typeahead(null, {
        name: 'companies',
        display: 'title',
        limit: 10,
        source: companies,
        templates: {
            empty: [
                '<div class="empty-message">',
                'немає компаній з такою назвою або ЄДРПОУ',
                '</div>'
            ].join('\n'),
            suggestion: Handlebars.compile("<div class='typeahead_wrapper'><div class='typeahead_labels'><div class='typeahead_primary'>{{title}}&nbsp;</div><div class='typeahead_secondary'>ЄДРПОУ: {{edpnou}}</div></div></div>")
        }
    });
</script>

