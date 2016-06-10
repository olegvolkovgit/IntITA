<div class="row">
    <ul class="list-inline">
        <li>
            <button type="button" class="btn btn-primary"
                    onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_accountant/representative/renderAddForm'); ?>',
                        'Додати представника')">
                Додати представника
            </button>
        </li>
    </ul>

    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="dataTable_wrapper">
                    <table class="table table-striped table-bordered table-hover" id="representativesTable"
                           style="width:100%">
                        <thead>
                        <tr>
                            <th>Повне ім'я</th>
                            <th>Посада</th>
                            <th>Компанія</th>
                            <th>Номер</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $jq(document).ready(function () {
        initRepresentatives();
    });
</script>