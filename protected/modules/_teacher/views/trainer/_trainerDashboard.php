<?php
/**
 * Created by PhpStorm.
 * User: Quicks
 * Date: 10.12.2015
 * Time: 17:39
 */
$countPlainTasks = PlainTask::countPlainTaskAnswersWithoutTrainer();
?>
<div class="row">
    <div class="col-lg-12">
        Тренер
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
                        <div class="huge"><?php echo $countPlainTasks; ?></div>
                        <div>Нові задачі!</div>
                    </div>
                </div>
            </div>
            <a href="#" <?php if ($countPlainTasks > 0){?>
               onclick="showPlainTaskWithoutTrainer('<?php echo Yii::app()->createUrl('/_teacher/teacher/showPlainTaskList') ?>')"
                <?php }?>>
                <div class="panel-footer">
                    <span class="pull-left">Детальніше</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>

