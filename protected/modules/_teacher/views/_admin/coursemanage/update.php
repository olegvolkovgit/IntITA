<?php
/* @var $this CoursemanageController *
 * @var $model Course
 * @var $levels array
 * @var $modules array
 */
?>
<ul class="list-inline">
    <li>
        <button type="button" class="btn btn-primary"
                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/coursemanage/index'); ?>')">
            <?php echo Yii::t("coursemanage", "0510"); ?></button>
    </li>
    <li>
        <button type="button" class="btn btn-primary"
                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/coursemanage/view',
                    array('id' => $model->course_ID)); ?>')">
            Переглянути курс
        </button>
    </li>
    <li>
        <button type="button" class="btn btn-primary"
                onclick="setCourseStatus('<?php echo Yii::app()->createUrl("/_teacher/_admin/coursemanage/changeStatus",
                    array("id" => $model->course_ID)); ?>', '<?= ($model->isActive()) ? 'Видалити курс?' : 'Відновити курс?'; ?>')">
            <?= ($model->isActive()) ? 'Видалити' : 'Відновити'; ?></button>
    </li>
    <li>
        <button type="button" class="btn btn-success"
                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/coursemanage/schema',
                    array('idCourse' => $model->course_ID)); ?>', 'Згенерувати схему курса')">
            Згенерувати схему курса
        </button>
    </li>
</ul>

<div class="panel panel-default">
    <div class="panel-body">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs">
            <li class="active"><a href="#main" data-toggle="tab">Головне</a>
            </li>
            <li><a href="#ua" data-toggle="tab">Українською</a>
            </li>
            <li><a href="#ru" data-toggle="tab">Російською</a>
            </li>
            <li><a href="#en" data-toggle="tab">Англійською</a>
            </li>
            <li><a href="#modules" data-toggle="tab">Модулі</a>
            </li>
            <li><a href="#other" data-toggle="tab">На інших мовах</a>
            </li>
        </ul>
        <!-- Tab panes -->
        <form class="form-horizontal" role="form" name="courseForm" id="courseForm" method="post"
              onclick="validateCourseForm('<?= Yii::app()->createUrl("/_teacher/_admin/coursemanage/newCourse"); ?>',
                  '<?= $model->course_ID ?>');" novalidate>
            <div class="tab-content">
                <div class="tab-pane fade in active" id="main">
                    <?php $this->renderPartial('_mainEditTab', array('model' => $model, 'levels' => $levels, 'scenario' => 'update')); ?>
                </div>
                <div class="tab-pane fade" id="ua">
                    <?php $this->renderPartial('_uaEditTab', array('model' => $model, 'scenario' => 'update')); ?>
                </div>
                <div class="tab-pane fade" id="ru">
                    <?php $this->renderPartial('_ruEditTab', array('model' => $model, 'scenario' => 'update')); ?>
                </div>
                <div class="tab-pane fade" id="en">
                    <?php $this->renderPartial('_enEditTab', array('model' => $model, 'scenario' => 'update')); ?>
                </div>
                <div class="tab-pane fade" id="modules">
                    <?php $this->renderPartial('_modulesTab', array(
                        'model' => $model,
                        'modules' => $modules,
                        'scenario' => 'update'
                    )); ?>
                </div>
                <div class="tab-pane fade" id="other">
                    <?php $this->renderPartial('_otherTab', array(
                        'model' => $model,
                        'scenario' => 'update'
                    )); ?>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    function validateCourseForm(url, id) {
        $jq("form[name=courseForm]").validate({
            highlight: function (label) {
                $jq(label).closest('.form-group').addClass('has-error');
                var tab_content = $jq(label).parent().parent().parent().parent().parent().parent().parent();
                if ($jq(tab_content).find("fieldset.tab-pane.active:has(div.has-error)").length == 0) {
                    $jq(tab_content).find("fieldset.tab-pane:has(div.has-error)").each(function (index, tab) {
                        var id = $jq(tab).attr("id");
                        $jq('a[href="#' + id + '"]').tab('show');
                    });
                }
            },
            ignore: [],
            rules: {
                alias: {
                    required: true
                },
                num: {
                    required: true
                }
            }
        });
        $jq.ajax({
            url: url,
            type: "POST",
            success: function (respond) {
                bootbox.alert("Операцію успішно виконано.", function () {
                    load(basePath + "/_teacher/_admin/coursemanage/view/id/" + id);
                });
            },
            error: function () {
                showDialog("Операцію не вдалося виконати.");
            }
        });

    }
</script>

