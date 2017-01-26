<div class="headerScheme">
    <div class="numbers" ng-if="selectedScheme.educForm!='offline'">
        <span ng-if="offlineSchemeData.schemes[0].paymentsCount<12">
            <span ng-if="offlineSchemeData.schemes[0].discount>0 && offlineSchemeData.schemes[0].loan==0" class="coursePriceStatus">{{offlineSchemeData.schemes[0].translates.currencySymbol}}{{offlineSchemeData.schemes[0].fullPrice}}</span>
            <span ng-if="offlineSchemeData.schemes[0].discount>0 && offlineSchemeData.schemes[0].loan==0">&nbsp</span>
            <span ng-class="{coursePriceStatus1: !offlineSchemeData.schemes[0].inCourse, coursePriceStatus: offlineSchemeData.schemes[0].inCourse}">{{offlineSchemeData.schemes[0].translates.currencySymbol}}{{offlineSchemeData.schemes[0].price}}</span>
            <span ng-if="offlineSchemeData.schemes[0].inCourse">({{offlineSchemeData.schemes[0].inCourse}}$ {{offlineSchemeData.translates.inCourse}})</span>
            <span ng-if="offlineSchemeData.schemes[0].paymentsCount!=1">&asymp; {{offlineSchemeData.schemes[0].approxMonthPayment}}{{offlineSchemeData.schemes[0].translates.currencySymbol}} x {{offlineSchemeData.schemes[0].paymentsCount}} {{offlineSchemeData.schemes[0].translates.payment}}</span>
        </span>
        <span ng-if="offlineSchemeData.schemes[0].paymentsCount>=12">
            <span ng-if="offlineSchemeData.schemes[0].discount>0 && offlineSchemeData.schemes[0].loan==0" class="coursePriceStatus">{{offlineSchemeData.schemes[0].translates.currencySymbol}}{{offlineSchemeData.schemes[0].fullPrice}}</span>
            <span ng-if="offlineSchemeData.schemes[0].discount>0 && offlineSchemeData.schemes[0].loan==0">&nbsp</span>
            {{offlineSchemeData.schemes[0].translates.currencySymbol}}{{offlineSchemeData.schemes[0].approxMonthPayment}} / {{offlineSchemeData.schemes[0].translates.month}}  х {{offlineSchemeData.schemes[0].paymentsCount}} {{offlineSchemeData.schemes[0].translate.payment}}
            &asymp; <b>{{offlineSchemeData.schemes[0].price}}{{offlineSchemeData.schemes[0].translates.currencySymbol}}</b>
        </span>
        <span class="discount" ng-if="offlineSchemeData.schemes[0].discount>0">
            <img ng-src="{{schemes.icons.discountIco}}"/>
            <span class="discountColor">({{offlineSchemeData.schemes[0].translates.discount}} - {{offlineSchemeData.schemes[0].discount}}%)</span>
        </span>
    </div>

    <div class="numbers" ng-if="selectedScheme.educForm=='offline'">
        <span ng-if="selectedScheme.paymentsCount<12">
            <span ng-if="selectedScheme.discount>0 && selectedScheme.loan==0" class="coursePriceStatus">{{selectedScheme.translates.currencySymbol}}{{selectedScheme.fullPrice}}</span>
            <span ng-if="selectedScheme.discount>0 && selectedScheme.loan==0">&nbsp</span>
            <span ng-class="{coursePriceStatus1: !selectedScheme.inCourse, coursePriceStatus: selectedScheme.inCourse}">{{selectedScheme.translates.currencySymbol}}{{selectedScheme.price}}</span>
            <span ng-if="selectedScheme.inCourse">({{selectedScheme.inCourse}}$ {{offlineSchemeData.translates.inCourse}})</span>
            <span ng-if="selectedScheme.paymentsCount!=1">&asymp; {{selectedScheme.approxMonthPayment}}{{selectedScheme.translates.currencySymbol}} x {{selectedScheme.paymentsCount}} {{selectedScheme.translates.payment}}</span>
        </span>
        <span ng-if="selectedScheme.paymentsCount>=12">
            <span ng-if="selectedScheme.discount>0 && selectedScheme.loan==0" class="coursePriceStatus">{{selectedScheme.translates.currencySymbol}}{{selectedScheme.fullPrice}}</span>
            <span ng-if="selectedScheme.discount>0 && selectedScheme.loan==0">&nbsp</span>
            {{selectedScheme.translates.currencySymbol}}{{selectedScheme.approxMonthPayment}} / {{selectedScheme.translates.month}}  х {{selectedScheme.paymentsCount}} {{selectedScheme.translate.payment}}
            &asymp; <b>{{selectedScheme.price}}{{selectedScheme.translates.currencySymbol}}</b>
        </span>
        <span class="discount" ng-if="selectedScheme.discount>0">
            <img ng-src="{{schemes.icons.discountIco}}"/>
            <span class="discountColor">({{selectedScheme.translates.discount}} - {{selectedScheme.discount}}%)</span>
        </span>
    </div>
</div>
