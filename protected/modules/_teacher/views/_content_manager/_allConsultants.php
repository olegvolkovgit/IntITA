<div class="col-lg-12" ng-controller="allConsultantsCtrl">
    <br>
    <ul class="list-inline">
        <li>
            <button class="btn btn-primary"
                    onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_content_manager/contentManager/renderAddForm',
                        array('role' => "consultant")); ?>', 'Призначити консультанта')">
                Призначити консультанта
            </button>
        </li>
        <li>
            <button class="btn btn-primary"
                    onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_content_manager/contentManager/addConsultantModuleForm',
                        array('role' => "consultant")); ?>', 'Призначити модуль для консультанта')">
                Призначити модуль
            </button>
        </li>
    </ul>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="dataTable_wrapper">
                <table class="table table-striped table-bordered table-hover" id="consultantsTable">
                    <thead>
                    <tr>
                        <th>ПІБ</th>
                        <th>Email</th>
                        <th>Призначено</th>
                        <th>Відмінено</th>
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
