<?php if (Yii::app()->user->model->isAccountant()) { ?>
<a type="button" class="btn btn-primary" ng-href="#/accountant/agreements">
    Список договорів
</a>
<?php } ?>
<div ng-controller="agreementDetailCtrl">
    <h3>Детальна інформація про договір №{{agreementData.number}}</h3>
    <agreement-detailed data-agreement-id="{{agreementId}}"></agreement-detailed>
    <h3>Рахунки до договору</h3>
    <invoice-table data-agreement-id="{{agreementId}}"></invoice-table>
</div>
<br>
<br>
<br>
<div class="row">
<span style="background-color: rgba(92,184,92,.6);">Проплачений повністю</span><br>
<span style="background-color: #f0b370">Збігає термін проплати</span><br>
<span style="background-color: rgba(217,82,82,.6)">Термін проплати збіг або не оплачений жодний рахунок договору</span><br>
</div>