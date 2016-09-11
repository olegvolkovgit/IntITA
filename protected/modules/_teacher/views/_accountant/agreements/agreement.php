<div ng-controller="agreementDetailCtrl">
    <h3>Детальна інформація про договір №{{agreementData.number}}</h3>
    <agreement-detailed data-agreement-id="{{agreementId}}"></agreement-detailed>
    <h3>Рахунки до договору</h3>
    <invoice-table data-agreement-id="{{agreementId}}"></invoice-table>
</div>