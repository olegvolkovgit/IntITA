<?php
/* @var $model StudentReg */
/* @var $teacher Teacher */
?>
<div class="row" id="dashboard">

<?php $this->rolesDashboard($teacher,$model) ?>

</div>

<!--<div class="row" id="dashboard">-->
<!--    <div class="col-lg-3 col-md-6">-->
<!--        <div class="panel panel-primary">-->
<!--            <div class="panel-heading">-->
<!--                <div class="row">-->
<!--                    <div class="col-xs-3">-->
<!--                        <i class="fa fa-comments fa-5x"></i>-->
<!--                    </div>-->
<!--                    <div class="col-xs-9 text-right">-->
<!--                        <div class="huge">26</div>-->
<!--                        <div>Задачі</div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <a href="#">-->
<!--                <div class="panel-footer">-->
<!--                    <span class="pull-left">View Details</span>-->
<!--                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>-->
<!--                    <div class="clearfix"></div>-->
<!--                </div>-->
<!--            </a>-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="col-lg-3 col-md-6">-->
<!--        <div class="panel panel-green">-->
<!--            <div class="panel-heading">-->
<!--                <div class="row">-->
<!--                    <div class="col-xs-3">-->
<!--                        <i class="fa fa-tasks fa-5x"></i>-->
<!--                    </div>-->
<!--                    <div class="col-xs-9 text-right">-->
<!--                        <div class="huge">--><?php //echo count(PlainTask::getPlainTaskAnswersWithoutTrainer());?><!--</div>-->
<!--                        <div>Нові задачі!</div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <a href="#">-->
<!--                <div class="panel-footer">-->
<!--                    <span class="pull-left">Детальніше</span>-->
<!--                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>-->
<!--                    <div class="clearfix"></div>-->
<!--                </div>-->
<!--            </a>-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="col-lg-3 col-md-6">-->
<!--        <div class="panel panel-yellow">-->
<!--            <div class="panel-heading">-->
<!--                <div class="row">-->
<!--                    <div class="col-xs-3">-->
<!--                        <i class="fa fa-shopping-cart fa-5x"></i>-->
<!--                    </div>-->
<!--                    <div class="col-xs-9 text-right">-->
<!--                        <div class="huge">124</div>-->
<!--                        <div>Консультації</div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <a href="#">-->
<!--                <div class="panel-footer">-->
<!--                    <span class="pull-left">Детальніше</span>-->
<!--                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>-->
<!--                    <div class="clearfix"></div>-->
<!--                </div>-->
<!--            </a>-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="col-lg-3 col-md-6">-->
<!--        <div class="panel panel-red">-->
<!--            <div class="panel-heading">-->
<!--                <div class="row">-->
<!--                    <div class="col-xs-3">-->
<!--                        <i class="fa fa-support fa-5x"></i>-->
<!--                    </div>-->
<!--                    <div class="col-xs-9 text-right">-->
<!--                        <div class="huge">13</div>-->
<!--                        <div>Support Tickets!</div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <a href="#">-->
<!--                <div class="panel-footer">-->
<!--                    <span class="pull-left">Детальніше</span>-->
<!--                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>-->
<!--                    <div class="clearfix"></div>-->
<!--                </div>-->
<!--            </a>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->