<div class="panel panel-default">
    <div class="panel-body">
        <uib-tabset active="0" >
            <uib-tab  index="0" heading="Текст українською">
                <?php $this->renderPartial('_offerText', array('lang' => 'ua')); ?>
            </uib-tab>
            <uib-tab index="1" heading="Текст російською">
                <?php $this->renderPartial('_offerText', array('lang' => 'ru')); ?>
            </uib-tab>
            <uib-tab  index="2" heading="Текст англійською">
                <?php $this->renderPartial('_offerText', array('lang' => 'en')); ?>
            </uib-tab>
        </uib-tabset>
    </div>
</div>
