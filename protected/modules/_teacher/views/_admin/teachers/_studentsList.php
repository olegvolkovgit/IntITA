<?php
/* @var $attribute array
 * @var $user integer
 * @var $role string
 */
?>
<br>
<div class="col-md-12">
    <div class="row">
        <form>
            <input type="number" hidden="hidden" value="<?= $model->id; ?>" id="user">
            <input type="text" hidden="hidden" value="<?= (string)$role; ?>" id="role">
            <div class="col col-md-6">
                <input type="number" hidden="hidden" id="student" value="0"/>
                <input id="typeahead" type="text" class="form-control" name="student" placeholder="Студент"
                       size="65" required autofocus>
            </div>
            <div class="col col-md-2">
                <button type="button" class="btn btn-success"
                        onclick="addTeacherAttr('<?php echo Yii::app()->createUrl('/_teacher/_admin/teachers/setTeacherRoleAttribute'); ?>',
                            '<?= $attribute["key"] ?>', '#student')">
                    Додати студента
                </button>
            </div>
        </form>
    </div>
    <br>
    <div>
        <b><?php echo 'Викладач: '.$model->firstName.' '.$model->secondName.' '.'('.$model->email.')'?></b>
    </div>
    <br>
    <div class="dataTable_wrapper">
        <table class="table table-striped table-bordered table-hover" id="modulesListTable">
            <thead>
            <tr>
                <th>Студент</th>
                <th width="20%">Призначено</th>
                <th width="20%">Відмінено</th>
                <th width="10%">Видалити</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($attribute["value"] as $item) { ?>
            <tr>
                <td>
                    <?= (($item["title"]) == null)?$item["title"]:$item["email"]; ?>
                    <a href="<?= Yii::app()->createUrl('studentreg/profile', array('idUser' => $item["id"])); ?>"
                       target="_blank">
                        (профіль)
                    </a>
                </td>
                <td>
                    <?= $item["start_date"]; ?>
                </td>
                <td>
                    <?= $item["end_date"]; ?>
                </td>
                <td>
                    <?php if ($item["end_date"] == '') { ?>
                        <a href="#"
                           onclick="cancelModuleAttr('<?= Yii::app()->createUrl("/_teacher/_admin/teachers/unsetTeacherRoleAttribute"); ?>',
                               '<?= $item["id"] ?>', '<?= $attribute["key"] ?>'); return false;">
                            скасувати
                        </a>
                    <?php } ?>
                </td>
                <?php
                } ?>
            </tr>
            </tbody>
        </table>
    </div>
</div>
<br>
<script>
    var users = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url: basePath + '/_teacher/_admin/teachers/usersByQuery?query=%QUERY',
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

    users.initialize();

    $jq('#typeahead').typeahead(null, {
        name: 'users',
        display: 'email',
        limit: 10,
        source: users,
        templates: {
            empty: [
                '<div class="empty-message">',
                'немає користувачів з таким іменем або email\`ом',
                '</div>'
            ].join('\n'),
            suggestion: Handlebars.compile("<div class='typeahead_wrapper'><img class='typeahead_photo' src='{{url}}'/> <div class='typeahead_labels'><div class='typeahead_primary'>{{name}}&nbsp;</div><div class='typeahead_secondary'>{{email}}</div></div></div>")
        }
    });

    $jq('#typeahead').on('typeahead:selected', function (e, item) {
        $jq("#student").val(item.id);
    });
</script>