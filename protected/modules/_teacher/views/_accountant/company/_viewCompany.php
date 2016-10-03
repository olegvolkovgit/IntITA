<div class="row">
    <ul class="list-inline">
        <li>
            <a type="button" class="btn btn-primary" ng-href="#/accountant/company">Компанії</a>
        </li>
    </ul>
</div>

<div class="panel panel-default">
    <div class="panel-body">
        <!-- Tab panes -->
        <uib-tabset active="0">
            <uib-tab index="0" heading="Головне" id="main">
                <?php $this->renderPartial('_mainTab', array('model' => $model));?>
            </uib-tab>
            <uib-tab index="1" heading="Представники" id="representatives">
                <?php $this->renderPartial('_representativesTab', array('model' => $model));?>
            </uib-tab>
        </uib-tabset>
    </div>
</div>
