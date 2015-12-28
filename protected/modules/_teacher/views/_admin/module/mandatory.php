<?php
/* @var $course Course*/
?>
<ul class="list-inline">
    <li>
        <button type="button" class="btn btn-primary"
                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/module/index'); ?>')">
            Список модулів</button>
    </li>
</ul>

<div class="page-header">
    <h4>Модуль #<?php echo $id . " " . Module::getModuleName($id); ?></h4>
</div>
<br>
<form onsubmit="addMandatory('<?php echo Yii::app()->createUrl('/_admin/module/addMandatoryModule'); ?>');return false;"
      name="add-accessModule">
    <fieldset>
        <div class="col-md-4">
            <legend id="label">Задати попередній модуль у курсі:</legend>
            <div class="form-group">
                Виберіть курс:<br>

                <input type="hidden" value="<?php echo $id; ?>" id="module">

                <select name="course" class="form-control" id="courseList"
                        onchange="selectModule('<?php echo Yii::app()->createUrl('/_teacher/_admin/module/getModuleByCourse');?>')">
                    <option value="">Виберіть курс</option>
                    <optgroup label="Курси">
                        <?php $courses = Course::generateModuleCoursesList($id);
                        foreach ($courses as $course) {
                            ?>
                            <option value="<?php echo $course->course_ID;?>"><?php echo $course->getTitle();
                            $mandatory = $course->mandatoryModule($id);
                            if ($mandatory != 0) {
                                ?>
                                - попередній модуль
                                #<?php echo Module::getModuleName($mandatory); ?></option>
                            <?php
                            }
                        }
                        ?>
                </select>
            </div>
            <br>
            <br>

            <div class="form-group">
                Попередній модуль:<br>

                <div name="selectModule">
                    <?php $this->renderPartial('_ajaxModule', array('modules' => '')); ?>
                </div>
            </div>
            <br>
            <br>
            <input class="btn btn-default" type="submit" value="Задати попередній модуль">

        </div>
        <br>
        <br>
</form>
<div class="col-lg-6">
    <div class="panel panel-default">
        <div class="panel-heading">
            Modals
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
            <!-- Button trigger modal -->
            <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
                Launch Demo Modal
            </button>
            <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                        </div>
                        <div class="modal-body">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
        </div>
        <!-- .panel-body -->
    </div>
    <!-- /.panel -->
</div>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'ajaxModule.js'); ?>"></script>
