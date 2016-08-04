<div ng-controller="companyCtrl" >
<div class="row">
    <ul class="list-inline">
        <li>
            <button type="button" class="btn btn-primary"
                    onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_accountant/company/renderAddForm'); ?>',
                        'Додати компанію')">
                Додати компанію
            </button>
        </li>
        <li>
            <button type="button" class="btn btn-primary"
                    onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_accountant/representative/index'); ?>',
                        'Представники')">
                Представники
            </button>
        </li>
    </ul>

    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="dataTable_wrapper">
                    <table class="table table-striped table-bordered table-hover" id="companiesTable"
                           style="width:100%">
                        <thead>
                        <tr>
                            <th>Назва</th>
                            <th>ЄДРПОУ</th>
                            <th>Юридична адреса</th>
                            <th>Фактична адреса</th>
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
</div>