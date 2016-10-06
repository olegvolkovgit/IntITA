<?php
/**
 * @var $model CorporateRepresentative
 * @var $companies array
 */
?>
<div class="row">
    <ul class="list-inline">
        <li>
            <a type="button" class="btn btn-primary" ng-href="#/accountant/representative">Представники</a>
        </li>
    </ul>
</div>

<div class="panel panel-default">
    <div class="panel-body">
        <uib-tabset active="0">
            <uib-tab index="0" heading="Головне" id="withCompanies">
                <?php $this->renderPartial('_mainTab', array('model' => $model));?>
            </uib-tab>
            <uib-tab index="1" heading="Компанії" id="representatives">
                <?php $this->renderPartial('_companiesTab', array('model' => $model, 'companies' => $companies));?>
            </uib-tab>
        </uib-tabset>
    </div>
</div>


