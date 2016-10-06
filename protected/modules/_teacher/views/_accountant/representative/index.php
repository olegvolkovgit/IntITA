<div class="row">
    <ul class="list-inline">
        <li>
            <a type="button" class="btn btn-primary" ng-href="#/accountant/addRepresentative">Додати представника</a>
        </li>
        <li>
            <a type="button" class="btn btn-primary" ng-href="#/accountant/company">Компанії</a>
        </li>
    </ul>

    <div class="panel panel-default">
        <div class="panel-body">
            <uib-tabset active="0">
                <uib-tab index="0" heading="Представники компаній" id="withCompanies">
                    <?php $this->renderPartial('_companyRepresentativesTable', array(), false, true);?>
                </uib-tab>
                <uib-tab index="1" heading="Всі представники" id="representatives">
                    <?php $this->renderPartial('_representativesTable', array(), false, true);?>
                </uib-tab>
            </uib-tabset>
        </div>
    </div>
</div>