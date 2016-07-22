<div ng-controller="representativeCtrl">
<div class="row">
    <ul class="list-inline">
        <li>
            <button type="button" class="btn btn-primary"
                    onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_accountant/representative/renderAddForm'); ?>',
                        'Додати представника')">
                Додати представника
            </button>
        </li>
        <li>
            <button type="button" class="btn btn-primary"
                    onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_accountant/company/index'); ?>',
                        'Компанії')">
                Компанії
            </button>
        </li>
    </ul>

    <div class="panel panel-default">
        <div class="panel-body">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#withCompanies" data-toggle="tab">Представники компаній</a>
                </li>
                <li><a href="#representatives" data-toggle="tab">Всі представники</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade in active" id="withCompanies">
                    <?php $this->renderPartial('_companyRepresentativesTable', array(), false, true);?>
                </div>
                <div class="tab-pane fade" id="representatives">
                    <?php $this->renderPartial('_representativesTable', array(), false, true);?>
                </div>
            </div>
        </div>
    </div>
</div>
</div>