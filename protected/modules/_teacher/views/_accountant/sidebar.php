<li ng-controller="mainAccountantCtrl">
    <a ng-href="#/accountant" class="show_elem">
        <i class="fa fa-money fa-fw"></i> Бухгалтер
        <span ng-cloak class="label label-success" ng-if="countOfActualSchemesRequests > 0">{{countOfActualSchemesRequests}}</span>
        <span ng-cloak class="label label-primary" ng-if="countOfActualWrittenAgreementRequests > 0">{{countOfActualWrittenAgreementRequests}}</span>
        <span ng-cloak class="label label-info" ng-if="countOfActualWrittenAgreements > 0">{{countOfActualWrittenAgreements}}</span>
    </a>
    <a ng-href="#/accountant" uib-tooltip="Бухгалтер" tooltip-placement="right" class="hid" style="display: none">
        <i class="fa fa-money fa-fw"></i>
        <span ng-cloak class="label label-success" ng-if="countOfActualSchemesRequests > 0">{{countOfActualSchemesRequests}}</span>
        <span ng-cloak class="label label-primary" ng-if="countOfActualWrittenAgreementRequests > 0">{{countOfActualWrittenAgreementRequests}}</span>
        <span ng-cloak class="label label-info" ng-if="countOfActualWrittenAgreements > 0">{{countOfActualWrittenAgreements}}</span>
    </a>
</li>