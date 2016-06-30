<div class="panel panel-default">
    <div class="panel-body">
        <!-- Nav tabs -->
        <ul id="userTabs" class="nav nav-tabs">
            <li><a href="#planned" data-toggle="tab">Заплановані консультації</a>
            </li>
            <li class="active"><a href="#today" data-toggle="tab">Сьогодні</a>
            </li>
            <li><a href="#past" data-toggle="tab">Минулі консультації</a>
            </li>
            <li><a href="#cancel" data-toggle="tab">Скасовані консультації</a>
            </li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane fade" id="planned">
                <?php $this->renderPartial('/_student/consultations/_plannedConsultations');?>
            </div>
            <div class="tab-pane fade in active" id="today">
                <?php $this->renderPartial('/_student/consultations/_todayConsultations');?>
            </div>
            <div class="tab-pane fade" id="past">
                <?php $this->renderPartial('/_student/consultations/_pastConsultations');?>
            </div>
            <div class="tab-pane fade" id="cancel">
                <?php $this->renderPartial('/_student/consultations/_cancelledConsultations');?>
            </div>
        </div>
    </div>
</div>

<script>
    $jq(document).ready(function () {
        initTodayConsultationsTable();
        initPlannedConsultationsTable();
        initPastConsultationsTable();
        initCancelConsultationsTable();
    });
</script>