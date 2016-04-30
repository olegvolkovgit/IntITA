<div class="col-lg-12">
    <br>
    <button class="btn btn-primary"
            onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/users/renderAddRoleForm',
                array('role'=>"tenant"));?>', 'Призначити tenant')">
        Призначити tenant
    </button>
    <br>
    <br>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="dataTable_wrapper">
                <table class="table table-striped table-bordered table-hover" id="tenantsTable">
                    <thead>
                    <tr>
                        <th>ПІБ</th>
                        <th>Email</th>
                        <th>Призначено</th>
                        <th>Відмінено</th>
                        <th></th>
                        <th></th>
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