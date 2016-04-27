<div class="panel panel-default">
    <div class="panel-body">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs">
            <li class="active"><a href="#courses" data-toggle="tab">Проплачені курси</a>
            </li>
            <li><a href="#modules" data-toggle="tab">Проплачені модулі</a>
            </li>
            <li><a href="#agreements" data-toggle="tab">Договори</a>
            </li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane fade in active" id="courses">
                <?php $this->renderPartial('/_student/_payCoursesTable');?>
            </div>
            <div class="tab-pane fade" id="modules">
                <?php $this->renderPartial('/_student/_payModulesTable');?>
            </div>
            <div class="tab-pane fade" id="agreements">
                <?php $this->renderPartial('/_student/_agreementsTable');?>
            </div>
        </div>
    </div>
</div>

<script>
    $jq(document).ready(function () {
        initPayCoursesList();
        initPayModulesTable();
        initAgreementsTable();
    });
</script>




