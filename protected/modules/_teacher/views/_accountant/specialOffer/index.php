<div ng-controller="paymentsSchemaCtrl">
    <div class="row m-b-20">
        <a href="#/accountant/paymentSchemas/add/{{schemeType}}" class="btn btn-primary">Додати</a>
    </div>
    <div ng-switch="schemeType">
        <div class="row" ng-switch-when="user">
            <user-special-offer-table></user-special-offer-table>
        </div>
        <div class="row" ng-switch-when="course">
            <course-special-offer-table></course-special-offer-table>
        </div>
        <div class="row" ng-switch-when="module">
            <module-special-offer-table></module-special-offer-table>
        </div>
        <div class="row" ng-switch-default="">
            <default-schemas-table></default-schemas-table>
        </div>
    </div>
</div>