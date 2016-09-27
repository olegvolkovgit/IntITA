<div class="panel panel-default" ng-controller="consultantCtrl">
    <div class="panel-body">
        <uib-tabset active="1">
            <uib-tab heading="Заплановані консультації" index="0" select="getPlannedConsultations()">
                <?php $this->renderPartial('/_consultant/_plannedConsultations');?>
            </uib-tab>
            <uib-tab heading="Сьогодні" index="1" select="getTodayConsultations()">
                <?php $this->renderPartial('/_consultant/_todayConsultations');?>
            </uib-tab>
            <uib-tab heading="Минулі консультації" index="2" select="getPastConsultations()">
                <?php $this->renderPartial('/_consultant/_pastConsultations');?>
            </uib-tab>
            <uib-tab heading="Скасовані консультації" index="3" select="getCanceledConsultations()">
                <?php $this->renderPartial('/_consultant/_cancelledConsultations');?>
            </uib-tab>
        </uib-tabset>
    </div>
</div>
