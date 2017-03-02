<div ng-controller="invoiceDetailCtrl">
    <h3>Детальна інформація про рахунок №{{invoiceData.number}}</h3>
    <invoice-detailed data-invoice-id="{{invoiceId}}"></invoice-detailed>
    <a type="button" class="btn btn-default" ng-click='back()'>
        Назад
    </a>
</div>