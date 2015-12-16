<?php
/**
 * Created by PhpStorm.
 * User: Quicks
 * Date: 10.12.2015
 * Time: 17:39
 */
?>
<div class="row">
    <div class="col-lg-12">
        <h3>Тренер</h3>
    </div>
</div>
<hr>
<div class="row" id="dashboard">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-tasks fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo PlainTask::countPlainTaskAnswersWithoutTrainer(); ?></div>
                        <div>Нові задачі!</div>
                    </div>
                </div>
            </div>
            <a href="#"
               onclick="showPlainTaskWithoutTrainer('<?php echo Yii::app()->createUrl('/_teacher/teacher/showPlainTaskList') ?>')">
                <div class="panel-footer">
                    <span class="pull-left">Детальніше</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-tasks fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">cons</div>
                        <div>консультанти</div>
                    </div>
                </div>
            </div>
            <a href="#" onclick="manageConsult('<?php echo Yii::app()->createUrl("/_teacher/teacher/manageConsult"); ?>')">
            <div class="panel-footer">
                <span class="pull-left">Перейти</span>
                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                <div class="clearfix"></div>
                </a>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', '/_teachers/newPlainTask.js'); ?>"></script>
