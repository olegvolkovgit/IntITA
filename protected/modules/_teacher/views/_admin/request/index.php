<div class="panel panel-default">
    <div class="panel-body">
        <!-- Nav tabs -->
        <ul id="userTabs" class="nav nav-tabs">
            <li class="active"><a href="#active" data-toggle="tab">Очікують підтвердження</a>
            </li>
            <li><a href="#approved" data-toggle="tab">Підтверджені</a>
            </li>
            <li><a href="#deleted" data-toggle="tab">Відхилені</a>
            </li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane fade in active" id="active">
                <?php $this->renderPartial('_activeRequests');?>
            </div>
            <div class="tab-pane fade" id="approved">
                <?php $this->renderPartial('_approvedRequests');?>
            </div>
            <div class="tab-pane fade" id="deleted">
                <?php $this->renderPartial('_deletedRequests');?>
            </div>
        </div>
    </div>
</div>

<script>
    $jq(document).ready(function () {
        initActiveRequestsTable();
        initApprovedRequestsTable();
        initDeletedRequestsTable();
    });
</script>