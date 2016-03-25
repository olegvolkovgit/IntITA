<div class="col-lg-12">
    <br>
    <button class="btn btn-primary"
            onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/teachers/create'); ?>',
                'Додати викладача')">
        Додати викладача
    </button>
    <br>
    <br>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="dataTable_wrapper">
                <table class="table table-striped table-bordered table-hover" id="teachersTable">
                    <thead>
                    <tr>
                        <th>ПІБ</th>
                        <th>Email</th>
                        <th>Персональна сторінка</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>