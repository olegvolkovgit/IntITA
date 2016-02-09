<?php
/**
 * @var $tasks array
 * @var $plainTaskAnswers array
 */
?>
<div class="panel panel-default">
    <div class="panel-body">
        <ul class="nav nav-tabs">
            <li><a href="#new" data-toggle="tab">Нові задачі (<?=count($plainTaskAnswers);?>)</a>
            </li>
            <li><a href="#appointed" data-toggle="tab">Призначено консультантів (<?=count($tasks);?>)</a>
            </li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane fade in active" id="new">
                <?php $this->renderPartial('/trainer/_newPlainTask', array('plainTasksAnswers' => $plainTaskAnswers)); ?>
            </div>
            <div class="tab-pane fade" id="appointed">
                <?php $this->renderPartial('/trainer/_plainWithTrainer', array('tasks' => $tasks)); ?>
            </div>
        </div>
    </div>
</div>
<script>
    $jq(document).ready(function () {
        $jq('#newTasksTable, #consultTasksTable').DataTable({
                language: {
                    "url": "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json"
                }
            }
        );
    });
</script>
