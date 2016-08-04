<?php
/**
 * @var $course Course
 * @var $type string
 * @var $offerScenario string
 */
$model = $course;
$price = $model->getBasePrice();
?>
<div class="panel panel-default">
    <div class="panel-body">
        <ul class="nav nav-tabs">
            <li <?php if($type == 'Online') echo 'class="active"'; ?>><a href="#online" data-toggle="tab">Навчання онлайн</a>
            </li>
            <li <?php if($type == 'Offline') echo 'class="active"'; ?>><a href="#offline" data-toggle="tab">Навчання офлайн</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade <?php if($type == 'Online') echo 'in active'; ?>" id="online">
                <?php $this->renderPartial('/_student/agreement/_payCourseSchemas', array(
                    'scenario' => 'online',
                    'model' => $model,
                    'isSelected' => ($type == 'Online')?true:false,
                    'price' => $model->getBasePrice(),
                    'offerScenario' => $offerScenario,
                    'educForm' => EducationForm::ONLINE
                )); ?>
            </div>
            <div class="tab-pane fade <?php if($type == 'Offline') echo 'in active'; ?>" id="offline">
                <?php $this->renderPartial('/_student/agreement/_payCourseSchemas', array(
                    'scenario' => 'offline',
                    'model' => $model,
                    'isSelected' => ($type == 'Offline')?true:false,
                    'price' => $model->priceOffline(),
                    'offerScenario' => $offerScenario,
                    'educForm' => EducationForm::OFFLINE
                )); ?>
            </div>
        </div>
    </div>
</div>


