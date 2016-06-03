<?php
/**
 * @var $model Module
 * @var $schema int
 * @var $type string
 * @var $course int
 * @var $offerScenario string
 */
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
                <?php $this->renderPartial('/_student/agreement/_paymentsModuleForm', array(
                    'scenario' => 'online',
                    'model' => $model,
                    'price' => $model->getBasePrice(),
                    'course' => $course,
                    'offerScenario' => $offerScenario,
                    'educForm' => EducationForm::ONLINE
                )); ?>
            </div>
            <div class="tab-pane fade" id="offline">
                <?php $this->renderPartial('/_student/agreement/_paymentsModuleForm', array(
                    'scenario' => 'online',
                    'model' => $model,
                    'price' => $model->priceOffline(),
                    'course' => $course,
                    'offerScenario' => $offerScenario,
                    'educForm' => EducationForm::OFFLINE
                )); ?>
            </div>
        </div>
    </div>
</div>

