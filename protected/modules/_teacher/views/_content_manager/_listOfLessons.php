<div class="col-lg-12">
    <br>

    <div class="panel panel-default">
        <div class="panel-body">
            <div class="dataTable_wrapper">
                <table class="table table-striped table-bordered table-hover" id="statusOfLessonsTable">
                    <thead>
                    <tr>
                        <th style="width:30%;" >Назва заняття</th>
                        <th style="width:12%;">Середня к-ть слів</th>
                        <th style="width:12%;">К-ть відео</th>
                        <th style="width:12%;">К-ть тестів</th>
                        <th style="width:12%;">К-ть частин</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    initLessonsListTable(<?=$idModule?>);
</script>