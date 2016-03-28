<?php
/* @var $model Translate */
?>
<div class="col-lg-12">
    <button class="btn btn-primary" onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/translate/create');?>',
        'Додати повідомлення')">
        Додати повідомлення
    </button>
    <br>
    <br>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="dataTable_wrapper">
                <table class="table table-striped table-bordered table-hover" id="translatesTable" style="width:100%">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Мова</th>
                        <th>Категорія</th>
                        <th>Переклад</th>
                        <th>Коментар</th>
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
    $jq(document).ready(function () {
        initTranslatesList();
    });
</script>
