<div class="col-lg-12">
    <br>

    <div class="panel panel-default">
        <div class="panel-body">
            <div class="dataTable_wrapper">
                <table class="table table-striped table-bordered table-hover" id="statusOfPartsTable">
                    <thead>
                    <tr>
                        <th style="width:30%;" >Частина заняття</th>
                        <th style="width:12%;">Наявність відео</th>
                        <th style="width:12%;">Наявність тесту</th>
                        <th style="width:12%;">К-ть слів</th>

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
    initPartsListTable(<?=$idLesson?>);
</script>