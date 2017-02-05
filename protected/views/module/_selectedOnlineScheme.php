<div class="headerScheme">
    <div class="numbers" ng-if="selectedScheme.educForm!='online'">
        <span ng-if="onlineSchemeData.schemes[0].paymentsCount<12">
            <span ng-if="onlineSchemeData.schemes[0].discount>0 && onlineSchemeData.schemes[0].loan==0" class="coursePriceStatus">{{onlineSchemeData.schemes[0].translates.currencySymbol}}{{onlineSchemeData.schemes[0].fullPrice}}</span>
            <span ng-if="onlineSchemeData.schemes[0].discount>0 && onlineSchemeData.schemes[0].loan==0">&nbsp</span>
            <span ng-class="{coursePriceStatus1: !onlineSchemeData.schemes[0].inCourse, coursePriceStatus: onlineSchemeData.schemes[0].inCourse}">{{onlineSchemeData.schemes[0].translates.currencySymbol}}{{onlineSchemeData.schemes[0].price}}</span>
            <span ng-if="onlineSchemeData.schemes[0].inCourse">({{onlineSchemeData.schemes[0].inCourse}}$ {{onlineSchemeData.translates.inCourse}})</span>
            <span ng-if="onlineSchemeData.schemes[0].paymentsCount!=1">&asymp; {{onlineSchemeData.schemes[0].approxMonthPayment}}{{onlineSchemeData.schemes[0].translates.currencySymbol}} x {{onlineSchemeData.schemes[0].paymentsCount}} {{onlineSchemeData.schemes[0].translates.payment}}</span>
        </span>
        <span ng-if="onlineSchemeData.schemes[0].paymentsCount>=12">
            <span ng-if="onlineSchemeData.schemes[0].discount>0 && onlineSchemeData.schemes[0].loan==0" class="coursePriceStatus">{{onlineSchemeData.schemes[0].translates.currencySymbol}}{{onlineSchemeData.schemes[0].fullPrice}}</span>
            <span ng-if="onlineSchemeData.schemes[0].discount>0 && onlineSchemeData.schemes[0].loan==0">&nbsp</span>
            {{onlineSchemeData.schemes[0].translates.currencySymbol}}{{onlineSchemeData.schemes[0].approxMonthPayment}} / {{onlineSchemeData.schemes[0].translates.month}}  х {{onlineSchemeData.schemes[0].paymentsCount}} {{onlineSchemeData.schemes[0].translate.payment}}
            &asymp; <b>{{onlineSchemeData.schemes[0].price}}{{onlineSchemeData.schemes[0].translates.currencySymbol}}</b>
        </span>
        <span class="discount" ng-if="onlineSchemeData.schemes[0].discount>0">
            <img ng-src="{{schemes.icons.discountIco}}"/>
            <span class="discountColor">({{onlineSchemeData.schemes[0].translates.discount}} - {{onlineSchemeData.schemes[0].discount}}%)</span>
        </span>
    </div>

    <div class="numbers" ng-if="selectedScheme.educForm=='online'">
        <span ng-if="selectedScheme.paymentsCount<12">
            <span ng-if="selectedScheme.discount>0 && selectedScheme.loan==0" class="coursePriceStatus">{{selectedScheme.translates.currencySymbol}}{{selectedScheme.fullPrice}}</span>
            <span ng-if="selectedScheme.discount>0 && selectedScheme.loan==0">&nbsp</span>
            <span ng-class="{coursePriceStatus1: !selectedScheme.inCourse, coursePriceStatus: selectedScheme.inCourse}">{{selectedScheme.translates.currencySymbol}}{{selectedScheme.price}}</span>
            <span ng-if="selectedScheme.inCourse">({{selectedScheme.inCourse}}$ {{onlineSchemeData.translates.inCourse}})</span>
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
