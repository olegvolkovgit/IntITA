<?php
/* @var $this PayController */
?>
<?php if (!empty($cancelMode)) {
    $moduleAction = 'cancelModule';
    $courseAction = 'cancelCourse';
    $buttonModuleName = 'Скасувати доступ до модуля';
    $buttonCourseName = 'Скасувати доступ до курсу';
    $headerName = 'Скасувати доступ до курсу/модуля';
    $fieldsetModule = $buttonModuleName;
    $fieldsetCourse = $buttonCourseName;
} else {
    $moduleAction = 'payModule';
    $courseAction = 'payCourse';
    $buttonModuleName = Yii::t('payments', '0599');
    $buttonCourseName = Yii::t('payments', '0604');
    $headerName = 'Автоматична оплата курса/модуля';
    $fieldsetModule = Yii::t('payments', '0593');
    $fieldsetCourse = Yii::t('payments', '0600');
}
?>
<div class="page-header well col-md-7">
    <h4><?php echo $headerName ?></h4>
</div>

<div class="panel panel-default col-md-7">
    <div class="panel-body">
        <div id="addAccessModule">
            <div id="findModule" class="form-group">
                <form name='findUsers' method="POST">
                    <div>
                        <label>Кому</label>
                        <br>
                        <input id="typeahead" type="text" class="form-control" name="receiver" placeholder="Отримувач"
                               size="135" required autofocus>
                        <input type="number" hidden="hidden" id="user" value="0"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="panel panel-default col-md-7">
    <div class="panel-body">
        <form method="POST" name="add-accessModule"
              onsubmit="checkModuleField('<?php echo Yii::app()->createUrl('/_teacher/_admin/pay/' . $moduleAction); ?>');return false;">
            <fieldset>
                <label id="label"><?php echo $fieldsetModule; ?>:</label>

                <div class="form-group">
                    <label><?php echo Yii::t('payments', '0605'); ?>:</label>
                    <select id="moduleCourseList" name="course" style="max-width: 496px;" class="form-control"
                            placeholder="(<?php echo Yii::t('payments', '0603'); ?>)"
                            onchange="selectModule('<?php echo Yii::app()->createUrl('/_teacher/_admin/permissions/showModules') ?>');"
                            required>

                        <option value=""><?php echo Yii::t('payments', '0596'); ?></option>
                        <optgroup label="<?php echo Yii::t('payments', '0597'); ?>">
                            <?php
                            foreach ($courses as $course) {
                                ?>
                                <option value="<?php echo $course['id']; ?>"><?php echo $course['alias'] . ' (' .
                                        $course['language'] . ')' ?></option>
                                <?php
                            }
                            ?>
                    </select>
                </div>
                <br>
                <label><?php echo Yii::t('payments', '0598'); ?>:</label>
                <div name="selectModule" class="form-group" style="max-width: 496px;"></div>
                <br>

                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="<?php echo $buttonModuleName ?>">
                </div>
            </fieldset>
        </form>
    </div>
</div>

<div class="panel panel-default col-md-7">
    <div class="panel-body">
        <div id="addAccessModule">
            <a name="form"></a>
            <form method="POST" name="add-accessCourse"
                  onsubmit="checkCourseField('<?php echo Yii::app()->createUrl('/_teacher/_admin/pay/' . $courseAction); ?>');return false;">
                <fieldset>
                    <label id="label"><?php echo $fieldsetCourse ?>:</label>

                    <div class="form-group">
                        <label><?php echo Yii::t('payments', '0605'); ?>:</label>
                        <select id="courseList" class="form-control" style="max-width: 496px;" name="course"
                                placeholder="(<?php echo Yii::t('payments', '0603'); ?>)" required>

                            <option value=""><?php echo Yii::t('payments', '0602'); ?></option>
                            <optgroup label="<?php echo Yii::t('payments', '0603'); ?>">
                                <?php
                                foreach ($courses as $course) {
                                    ?>
                                    <option
                                        value="<?php echo $course['id']; ?>"><?php echo $course['alias'] . " (" . $course['language'] . ")"; ?></option>
                                    <?php
                                }
                                ?>
                        </select>
                    </div>
                    <br>
                    <input type="submit" class="btn btn-primary" value="<?php echo $buttonCourseName; ?>">
                </fieldset>
            </form>
        </div>
    </div>
</div>
<br>
<script>
    var users = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url: basePath + '/_teacher/cabinet/usersByQuery?query=%QUERY',
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
        $jq("#user").val(item.id);
    });
</script>