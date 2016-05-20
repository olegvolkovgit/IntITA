

<div class="col-lg-12">
    <br>
    <ul class="list-inline">
        <li>
            <button class="btn btn-primary"
                    onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_tenant/tenant/renderAddPhrase'
                       ); ?>', 'Створити фразу')">
                Створити фразу
            </button>
        </li>

    </ul>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="dataTable_wrapper">
                <table class="table table-striped table-bordered table-hover" id="allPhrasesTable">
                    <thead>
                    <tr>
                        <th style="width:30%;" >Фраза</th>
                        <th style="width:12%;"></th>
                        <th style="width:12%;"></th>

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
    initAllPhrasesTable();
</script>