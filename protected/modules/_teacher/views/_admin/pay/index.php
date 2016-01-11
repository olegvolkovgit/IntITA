<link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'access.css'); ?>" />
<?php
/* @var $this PayController */
?>
<?php if(!empty($cancelMode)) {
    $moduleAction = 'cancelModule';
    $courseAction = 'cancelCourse';
    $buttonModuleName = 'Скасувати доступ до модуля';
    $buttonCourseName = 'Скасувати доступ до курсу';
    $headerName = 'Скасувати доступ до курсу/модуля';
    $fieldsetModule = $buttonModuleName;
    $fieldsetCourse = $buttonCourseName;
}
    else
    {
        $moduleAction = 'payModule';
        $courseAction = 'payCourse';
        $buttonModuleName = Yii::t('payments', '0599');
        $buttonCourseName = Yii::t('payments', '0604');
        $headerName = 'Автоматична оплата курса/модуля';
        $fieldsetModule = Yii::t('payments', '0593');
        $fieldsetCourse = Yii::t('payments', '0600');
    }
 ?>
<div class="page-header">
<h4><?php echo $headerName?></h4>
</div>
<div class="col-md-4">
    <div id="addAccessModule">
    <br>
    <div id="findModule" class="form-group">
        <form name = 'findUsers' method="POST">
            <input type="text" id = 'find' name = "find" class="form-control" placeholder="Введіть e-mail користувача">
            <br>
            <input type="button" class="btn btn-default" value="Знайти користувача"
                   onclick = "findUserByEmail('<?php echo Yii::app()->createUrl('/_teacher/_admin/permissions/showUsers') ?>')" >
        </form>
    </div>

    <select name="user" id="user" class="form-control" placeholder="(<?php echo Yii::t('payments', '0594'); ?>)"
            autofocus required="true">
        <?php
        foreach($users as $user)
        {
            ?>
            <option value="<?php echo $user['id'];?>"><?php echo $user['alias'];?></option>
        <?php
        }
        ?>
    </select>

    <form  method="POST" name="add-accessModule"
          onsubmit="checkModuleField('<?php echo Yii::app()->createUrl('/_teacher/_admin/pay/'.$moduleAction);?>');return false;">
        <fieldset>
            <legend id="label"><?php echo $fieldsetModule ?>:</legend>
            <div class="form-group">
            </div>
            <br>
            <div class="form-group">
            <?php echo Yii::t('payments', '0605'); ?>:
            <select id="moduleCourseList" name="course"  class="form-control" placeholder="(<?php echo Yii::t('payments', '0603'); ?>)"
                    onchange="selectModule('<?php echo Yii::app()->createUrl('/_teacher/_admin/permissions/showModules') ?>');"
                required="true">

                <option value=""><?php echo Yii::t('payments', '0596'); ?></option>
                <optgroup label="<?php echo Yii::t('payments', '0597'); ?>">
                    <?php
                    foreach($courses as $course){
                        ?>
                        <option value="<?php echo $course['id'];?>"><?php echo $course['alias'].' ('.
                                $course['language'].')'?></option>
                    <?php
                    }
                    ?>
            </select>
                </div>
            <br>
            <br>
            <?php echo Yii::t('payments', '0598'); ?>:<br>
            <div name="selectModule" class="form-group" ></div>
            <br>


            <div class="form-group">
            <input type="submit" class="btn btn-primary" value="<?php echo $buttonModuleName ?>">
            </div>
    </form>
</div>

<div id="addAccessModule">
    <br>
    <a name="form"></a>
    <form  method="POST" name="add-accessCourse"
           onsubmit="checkCourseField('<?php echo Yii::app()->createUrl('/_teacher/_admin/pay/'.$courseAction);?>');return false;">
        <fieldset>
            <legend id="label"><?php echo $fieldsetCourse ?>:</legend>

            <div class="form-group">
            <?php echo Yii::t('payments', '0605'); ?>:<br>
            <select id="courseList" class="form-control"  name="course"
                    placeholder="(<?php echo Yii::t('payments', '0603'); ?>)" required="true">

                <option value=""><?php echo Yii::t('payments', '0602'); ?></option>
                <optgroup label="<?php echo Yii::t('payments', '0603'); ?>">
                    <?php
                    foreach($courses as $course){
                        ?>
                        <option value="<?php echo $course['id'];?>"><?php echo $course['alias'];?></option>
                    <?php
                    }
                    ?>
            </select>
                </div>
            <br>

            <input type="submit" class="btn btn-primary" value="<?php echo $buttonCourseName ?>">
    </form>

</div>
</div>
<br>
<script src="<?php echo StaticFilesHelper::fullPathTo('css', '/bower_components/bootstrap/dist/js/bootstrap.min.js');?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'pay.js'); ?>"></script>
