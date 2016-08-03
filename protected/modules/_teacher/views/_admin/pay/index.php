<?php
/* @var $this PayController */
?>
<?php if (!empty($cancelMode)) {
    $moduleAction = 'cancelModule';
    $courseAction = 'cancelCourse';
    $buttonModuleName = 'Скасувати доступ до модуля';
    $buttonCourseName = 'Скасувати доступ до курсу';
    $fieldsetModule = $buttonModuleName;
    $fieldsetCourse = $buttonCourseName;
} else {
    $moduleAction = 'payModule';
    $courseAction = 'payCourse';
    $buttonModuleName = Yii::t('payments', '0599');
    $buttonCourseName = Yii::t('payments', '0604');
    $fieldsetModule = Yii::t('payments', '0593');
    $fieldsetCourse = Yii::t('payments', '0600');
}
?>
<div ng-controller="payCtrl">
<div class="panel panel-default col-md-7">
    <div class="panel-body">
        <div id="addAccessModule">
            <div id="findModule" class="form-group">
                <form name='findUsers' method="POST">
                    <div>
                        <label>Користувач:</label>
                        <br>
                        <input id="typeahead" type="text" class="form-control" name="receiver" placeholder="Користувач"
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
        <form role="form" name="add-accessModule">
            <fieldset>
                <label>
                    <strong><?php echo $fieldsetModule; ?>:</strong>
                </label>

                <div class="form-group">
                    <input type="number" hidden="hidden" id="moduleId" value="0"/>
                    <input id="typeaheadModule" type="text" class="form-control" placeholder="Назва модуля"
                           size="135">
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="<?php echo $buttonModuleName; ?>"
                           onclick="checkModuleField('<?php echo Yii::app()->createUrl('/_teacher/_admin/pay/' . $moduleAction); ?>'); return false;">
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
                  onsubmit="checkCourseField('<?php echo Yii::app()->createUrl('/_teacher/_admin/pay/' . $courseAction); ?>'); return false;">
                <fieldset>
                    <label>
                        <strong><?php echo $fieldsetCourse ?>:</strong>
                    </label>

                    <div class="form-group">
                        <input type="number" hidden="hidden" id="courseId" value="0"/>
                        <input id="typeaheadCourse" type="text" class="form-control" placeholder="Назва курса"
                               size="135">
                    </div>
                    <input type="submit" class="btn btn-primary" value="<?php echo $buttonCourseName; ?>">
                </fieldset>
            </form>
        </div>
    </div>
</div>
</div>
<br>
<script>

</script>
