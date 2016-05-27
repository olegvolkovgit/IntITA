<?php
/**
 * @var $course Course
 * @var $schema int
 * @var $type string
 * @var $offerScenario string
 */
$model = $course;
$price = $model->getBasePrice();
?>
<div class="panel panel-default">
    <div class="panel-body">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#online" data-toggle="tab">Навчання онлайн</a>
            </li>
            <li><a href="#offline" data-toggle="tab">Навчання офлайн</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade in active" id="online">
                <?php $this->renderPartial('/_student/agreement/_payCourseSchemas', array(
                    'scenario' => 'online',
                    'model' => $model,
                    'price' => $model->getBasePrice(),
                    'offerScenario' => $offerScenario
                )); ?>
            </div>
            <div class="tab-pane fade" id="offline">
                <?php $this->renderPartial('/_student/agreement/_payCourseSchemas', array(
                    'scenario' => 'offline',
                    'model' => $model,
                    'price' => $model->priceOffline(),
                    'offerScenario' => $offerScenario
                )); ?>
            </div>
        </div>
    </div>
</div>

