<div ng-controller="operationCtrl">
    <div class="row m-t-20 m-b-20">
        <button class="btn btn-primary" ng-click="createOperation()">Нова проплата</button>
    </div>

    <div class="row m-t-20">
        <uib-tabset type="pills" justified="true" active="activeTab">
            <uib-tab index="0" heading="Зовнішні надходження" classes="p-b-20">
                <external-payments-table></external-payments-table>
            </uib-tab>
            <uib-tab index="1" heading="Внутрішні платежі" classes="p-b-20">
                <internal-payments-table></internal-payments-table>
            </uib-tab>
        </uib-tabset>
    </div>

</div>
