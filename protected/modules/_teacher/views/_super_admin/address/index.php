<div class="panel panel-default" ng-controller="addressCtrl">
    <div class="panel-body">
        <uib-tabset active="0" >
            <uib-tab  index="0" heading="Країни">
                <?php $this->renderPartial('_countriesTable');?>
            </uib-tab>
            <uib-tab  index="1" heading="Міста">
                <?php $this->renderPartial('_citiesTable');?>
            </uib-tab>
        </uib-tabset>
    </div>
</div>



