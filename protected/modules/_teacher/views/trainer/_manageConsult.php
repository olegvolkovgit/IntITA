<?php
/**
 * @var $tasks array
 * @var $plainTaskAnswers array
 */
?>
<div class="panel panel-default">
    <div class="panel-body">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#new" data-toggle="tab">Нові задачі (<?=count($plainTaskAnswers);?>)</a>
            </li>
            <li><a href="#appointed" data-toggle="tab">Призначено консультантів (<?=count($tasks);?>)</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade in active" id="new">
                <?php $this->renderPartial('/trainer/_newPlainTask', array('plainTasksAnswers' => $plainTaskAnswers), false, true); ?>
            </div>
            <div class="tab-pane fade" id="appointed">
                <?php $this->renderPartial('/trainer/_plainWithTrainer', array('tasks' => $tasks), false, true); ?>
            </div>
        </div>
    </div>
</div>

