<div class="col-lg-12" ng-controller="allAuchtorsCtrl">
    <br>
    <ul class="list-inline">
        <li>
            <button class="btn btn-primary"
                    onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_content_manager/contentManager/addTeacherModuleForm',
                        array('role' => "author")); ?>', 'Призначити автора модуля')">
                Призначити модуль
            </button>
        </li>
    </ul>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="dataTable_wrapper">
                <table class="table table-striped table-bordered table-hover" id="authorsTable">
                    <thead>
                    <tr>
                        <th>ПІБ</th>
                        <th>Email</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>