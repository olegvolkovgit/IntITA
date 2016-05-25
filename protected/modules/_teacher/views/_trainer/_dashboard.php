<?php
/**
 * @var $user StudentReg
 * @var $newModulesCount int
 */
$newModulesCount = count(UserTrainer::modulesWithoutConsult($user));
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
                        <div class="huge"><?php echo $newModulesCount; ?></div>
                        <div>Нові модулі!</div>
                    </div>
                </div>
            </div>
            <a href="#" <?php if ($newModulesCount > 0){?>
               onclick="load('<?php echo Yii::app()->createUrl("/_teacher/_trainer/trainer/students", array(
                   "id"=>$user->id,
                   "filter" => "new"
               )); ?>', 'Нові студенти')"
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

